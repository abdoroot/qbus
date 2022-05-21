<?php

namespace App\Http\Controllers\User;

use App\Repositories\TripRepository;
use App\Http\Requests\CreateTripOrderRequest;
use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\City;
use App\Models\TripOrder;
use App\Models\Notification;
use App\Models\Additional;
use App\Models\Review;
use Flash;
use Response;
use Auth;
use DB;
use Carbon\Carbon;

class TripController extends AppBaseController
{
    /** @var TripRepository $tripRepository*/
    private $tripRepository;

    public function __construct(TripRepository $tripRepo)
    {
        $this->tripRepository = $tripRepo;
        $this->middleware(function ($request, $next) {
            $this->id = Auth::check() ? Auth::user()->id : null;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the Trip.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = '';
        $limit = 6;
        $paginator = new Trip;
        $today = Carbon::now();
        if(!is_null($search = $request->search)) {
            $query .= "&search={$request->search}";
            $paginator = $paginator->where('description', 'like', "%$search%");
        }
        
        if(!empty($additional = $request->additional ?? [])) {
            $query .= "&additional[]=" . implode("&additional[]=", $additional);
            $paginator = $paginator->when($additional , function($query) use ($additional) {
                $query->where(function ($query) use ($additional) {
                    foreach($additional as $addition) {
                        $query->orWhereJsonContains('additional', ['id' => $addition]);
                    }
                });
            });
        }

        if(!is_null($date_from = $request->date_from)) {
            $query .= "&date_from={$request->date_from}";
            $paginator = $paginator->where('date_from', '>=', $date_from);
        }
        if(!is_null($date_to = $request->date_to)) {
            $query .= "&date_to={$request->date_to}";
            $paginator = $paginator->where('date_to', '<=', $date_to);
        }
        if(!is_null($time_from = $request->time_from)) {
            $query .= "&time_from={$request->time_from}";
            $paginator = $paginator->where('time_from', '>=', $time_from);
        }
        if(!is_null($time_to = $request->time_to)) {
            $query .= "&time_to={$request->time_to}";
            $paginator = $paginator->where('time_to', '<=', $time_to);
        }
        if(!is_null($type = $request->type)) {
            $query .= "&type={$request->type}";
            $paginator = $paginator->where('type', '=', $type);
        }
        if(!is_null($city_id = $request->city_id)) {
            $query .= "&city_id={$request->city_id}";
            $paginator = $paginator->join('destinations', 'destinations.id', '=', 'trips.destination_id')
                ->where(function ($query) use($city_id) {
                    $query->where('from_city_id', $city_id)
                        ->orWhere('to_city_id', $city_id);
                });
        }


        $paginator = $paginator->where('date_from', '>=', $today->toDateString());

        $paginator = $paginator->where('time_from', '>=', $today->toTimeString());

        $paginator = $paginator->select('trips.*')->paginate($limit);

        $cities = City::pluck('name', 'id');
        $additionals = Additional::get();

        return view('guest.trips.index')
            ->with('paginator', $paginator)
            ->with('cities', $cities)
            ->with('additionals', $additionals)
            ->with('query', $query)
            ->with('search', $search)
            ->with('additional', $additional)
            ->with('date_from', $date_from)
            ->with('date_to', $date_to)
            ->with('time_from', $time_from)
            ->with('time_to', $time_to)
            ->with('type', $type)
            ->with('city_id', $city_id);
    }

    /**
     * Display the specified Trip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $trip = $this->tripRepository->find($id);
        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('trips.index'));
        }

        $moreTrips = Trip::where('id', '!=', $id)->take(4)->get();
        $reviews = Review::where(['trip_id' => $id, 'publish' => 1])->take(3)->get();
        $additionals = Additional::get();
        $tax = (!is_null($provider = $trip->provider) ? $provider->tax : 0);

        return view('guest.trips.show')
            ->with('trip', $trip)
            ->with('moreTrips', $moreTrips)
            ->with('reviews', $reviews)
            ->with('additionals', $additionals)
            ->with('tax', $tax);
    }

    public function store(CreateTripOrderRequest $request)
    {
        $trip = Trip::find($request->trip_id);

        DB::beginTransaction();

        $input = array_merge($request->only('trip_id', 'count'), [
            'user_id' => $this->id,
            'provider_id' => $trip->provider_id,
            'total' => $trip->fees * $request->count,
            'status' => $trip->auto_approve ? 'approved' : 'pending',
        ]);

        $tripOrder = TripOrder::create($input);

        // Notify Provider
        $providerNotif = Notification::create([
            'title' => 'Trip Order #' . $tripOrder->id,
            'text' => "New reservation is ordered for trip #{$trip->id} : {$trip->name}, please click to check more details.",
            'url' => route('provider.tripOrders.show', $tripOrder->id),
            'icon' => 'ti-shopping-cart',
            'type' => ($tripOrder->status == 'pending' ? 'warning' : 'info'),
            'to' => 'provider',
            'provider_id' => $tripOrder->provider_id
        ]);

        // Notify User
        $userNotif = Notification::create([
            'title' => 'Trip Order #' . $tripOrder->id,
            'text' => "Your order is created successfully for trip #{$trip->id} : {$trip->name}, please click to check more details.",
            'url' => route('tripOrders.show', $tripOrder->id),
            'icon' => 'ti-shopping-cart',
            'type' => 'info',
            'to' => 'user',
            'user_id' => $tripOrder->user_id
        ]);

        // store order Tickets (only if approved)
        if($tripOrder->status == 'approved') {
            $apiRequest = new CreateTicketAPIRequest;
            $apiRequest->replace(['trip_order_id' => $tripOrder->id]);
            $storeTickets = app('App\Http\Controllers\API\TicketAPIController')->store($apiRequest);
            $response     = $storeTickets->getData();
            if(!$response->success) {
                Flash::error($response->message);
                return redirect()->back()->withInput();
            }
        }

        DB::commit();

        $message = __('messages.saved', ['model' => __('models/tripOrders.singular')]);

        if($tripOrder->status == 'approved') {
            $message .= ', ' . __('msg.please_do_the_payment_and_complete_the_order');
            $request->session()->flash('payment', $message);
            return redirect()->route('trips.payment', $tripOrder->id);
        }

        $message .= ', ' . __('msg.please_wait_for_provider_approval_to_do_the_payment_and_complete_the_order');
        $request->session()->flash('trip', $message);
        
        return redirect()->back();
    }

    public function payment($id, Request $request)
    {
        $tripOrder = $this->tripOrderRepository->find($id);
        if (empty($tripOrder) || $tripOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('tripOrders.index'));
        }
        if($tripOrder->status != 'approved') {
            Flash::error(__('msg.the_payment_link_is_not_valid'));
            return redirect(route('tripOrders.index'));
        }

        return('redirect to the payment gateway ...');
    }

    public function review(CreateReviewRequest $request)
    {
        $trip = $this->tripRepository->find($request->trip_id);
        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('trips.index'));
        }

        DB::beginTransaction();

        $input = array_merge($request->all(), [
            'user_id' => $this->id,
            'provider_id' => $trip->provider_id,
        ]);

        $review = Review::create($input);

        $trip = $this->tripRepository->update([
            'rate' => $trip->reviews->sum('rate') / $trip->reviews->count()
        ], $request->trip_id);

        if(!is_null($provider = $review->provider)) {
            $provider->update([
                'rate' => $provider->reviews->sum('rate') / $provider->reviews->count()
            ]);
        }
        
        DB::commit();

        $request->session()->flash('review', __('messages.saved', ['model' => __('models/reviews.singular')]));
        return redirect()->back();
    }
}
