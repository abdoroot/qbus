<?php

namespace App\Http\Controllers\User;

use App\Repositories\TripRepository;
use App\Http\Requests\CreateTripOrderRequest;
use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Trip;
use App\Models\City;
use App\Models\TripOrder;
use App\Models\Notification;
use App\Models\Additional;
use App\Models\Review;
use App\Models\Coupon;
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

        //cartController::removeTrip(38);
        ///Session::forget("cart") ;
        ///Session::put("cart.trip_id",20) ;
        // dd(Session::all());
        // $query = "type=" . ($type = $request->type) .
        //         ($type != 'one-way' ? '&prev_trip_order_id='.($prevTripOrderId = $request->prev_trip_order_id) : null);
        if(($type = $request->type) == 'multi' && 
            isset($request->destination) && 
            is_array($destination = $request->destination)) {
                // $i = 0;
                // if(!is_null($prevTripOrder = TripOrder::find($request->prev_trip_order_id))) {
                //     $i = $prevTripOrder->nextMultiIndex();
                // }
                $i = count(Session::get('cart') ?? []);

                if($request->skip) {
                    if(isset($destination['from_city_id'][$i+1])) $i+=$request->skip;
                }

                if(isset($destination['from_city_id']) && isset($destination['from_city_id'][$i])) {
                    $request->request->add(['from_city_id' => $destination['from_city_id'][$i]]);
                }
                if(isset($destination['to_city_id']) && isset($destination['to_city_id'][$i])) {
                    $request->request->add(['to_city_id' => $destination['to_city_id'][$i]]);
                }
                if(isset($destination['date_from']) && isset($destination['date_from'][$i])) {
                    $request->request->add(['date_from' => $destination['date_from'][$i]]);
                }
                if(isset($destination['code']) && isset($destination['code'][$i])) {
                    $request->request->add(['code' => $destination['code'][$i]]);
                }
        }

        $limit = 6;
        $today = Carbon::now();

        $paginator = Trip::where(function ($query) use ($today) {
            $query->where('date_from', '>', $today->toDateString())
                ->orWhere(function ($query) use ($today)
                {
                    $query->where('date_from', '>=', $today->toDateString())
                        ->where('time_from', '>=', $today->toTimeString());
                }) ;
        });

        if(!is_null($search = $request->search)) {
            // $query .= "&search={$request->search}";
            $paginator = $paginator->where('description', 'like', "%$search%");
        }

        if(!empty($additional = $request->additional ?? [])) {
            $paginator = $paginator->when($additional , function($query) use ($additional) {
                $query->where(function ($query) use ($additional) {
                    foreach($additional as $addition) {
                        //$query->whereJsonContains('additional', ['id' => $addition]);
                        $query->where('additional', 'LIKE', '%"id":"' . $addition . '"%');
                    }
                });
            });
        }

        if(!is_null($date_from = $request->date_from)) {
            // $query .= "&date_from={$request->date_from}";
            $paginator = $paginator->where('date_from', '>=', $date_from);
        }

        if(!is_null($date_to = $request->date_to)) {
            // $query .= "&date_to={$request->date_to}";
            $paginator = $paginator->where('date_to', '<=', $date_to);
        }

        if(!is_null($time_from = $request->time_from)) {
            // $query .= "&time_from={$request->time_from}";
            $paginator = $paginator->where('time_from', '>=', $time_from);
        }
        if(!is_null($time_to = $request->time_to)) {
            // $query .= "&time_to={$request->time_to}";
            $paginator = $paginator->where('time_to', '<=', $time_to);
        }

        $from_city_id = $request->from_city_id;
        $to_city_id = $request->to_city_id;
        if(!is_null($from_city_id) || !is_null($to_city_id)) {
            $paginator = $paginator->join('destinations', 'destinations.id', '=', 'trips.destination_id');
            if(!is_null($from_city_id)) {
                // $query .= "&from_city_id={$request->from_city_id}";
                $paginator = $paginator->where('from_city_id', $from_city_id);
            }
            if(!is_null($to_city_id)) {
                // $query .= "&to_city_id={$request->to_city_id}";
                $paginator = $paginator->where('to_city_id', $to_city_id);
            }
        }

        if(!is_null($code = $request->code)) {
            // $query .= "&code={$request->code}";
            $provider_id = null;
            $coupon = Coupon::where(['code' => $request->code, 'status' => 'approved'])
                ->where('date_from', '<=', $today = Carbon::now()->toDateString())
                ->where('date_to', '>=', $today)
                ->first();
            if(!is_null($coupon)) $provider_id = $coupon->provider_id;

            $paginator = $paginator->where('trips.provider_id', $provider_id);
        }

        $paginator = $paginator->select('trips.*')->paginate($limit);

        //dd($paginator->items());

        $cities = City::pluck('name', 'id');
        $additionals = Additional::get();

        return view('guest.trips.index')
            ->with('paginator', $paginator)
            ->with('cities', $cities)
            ->with('additionals', $additionals)
            // ->with('query', $query)
            ->with('search', $search)
            ->with('additional', $additional)
            ->with('date_from', $date_from)
            ->with('date_to', $date_to)
            ->with('time_from', $time_from)
            ->with('time_to', $time_to)
            ->with('from_city_id', $from_city_id)
            ->with('to_city_id', $to_city_id)
            ->with('code', $code)
            ->with('type', $type);
    }

    /**
     * Display the specified Trip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Request $request)
    {
        $trip = $this->tripRepository->find($id);
        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('trips.index'));
        }

        //$moreTrips = Trip::where('id', '!=', $id)->take(4)->get();
        $reviews = Review::where(['trip_id' => $id, 'publish' => 1])->take(3)->get();
        $additionals = Additional::get();
        $tax = (!is_null($provider = $trip->provider) ? $provider->tax : 0);

        $type = ($request->type ?? 'one-way');

        return view('guest.trips.show')
            ->with('trip', $trip)
            //->with('moreTrips', $moreTrips)
            ->with('reviews', $reviews)
            ->with('additionals', $additionals)
            ->with('tax', $tax)
            ->with('type', $type);

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
