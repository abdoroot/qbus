<?php

namespace App\Http\Controllers\User;

use App\Repositories\PackageRepository;
use App\Http\Requests\CreatePackageOrderRequest;
use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\City;
use App\Models\PackageOrder;
use App\Models\Notification;
use App\Models\Additional;
use App\Models\Review;
use App\Models\Coupon;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;
use DB;

class PackageController extends AppBaseController
{
    /** @var PackageRepository $packageRepository*/
    private $packageRepository;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepository = $packageRepo;
        $this->middleware(function ($request, $next) {
            $this->id = Auth::check() ? Auth::user()->id : null;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the Package.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = "";
        $limit = 6;
        $today = Carbon::now();
        $paginator = new Package;

        if(!is_null($search = $request->search)) {
            $query .= "&search={$request->search}";
            $paginator = $paginator->where('description', 'like', "%$search%");
        }
        
        if(!empty($additional = $request->additional ?? [])) {
            $query .= "&additional[]=" . implode("&additional[]=", $additional);
            $paginator = $paginator->when($additional , function($query) use ($additional) {
                $query->where(function ($query) use ($additional) {
                    foreach($additional as $addition) {
                        $query->whereJsonContains('additional', ['id' => $addition]);
                    }
                });
            });
        }

        if(!is_null($date_from = $request->date_from)) {
            $query .= "&date_from={$request->date_from}";
            $paginator = $paginator->where('date_from', '<=', $date_from);
        }
        if(!is_null($time_from = $request->time_from)) {
            $query .= "&time_from={$request->time_from}";
            $paginator = $paginator->where('time_from', '>=', $time_from);
        }
        if(!is_null($starting_city_id = $request->starting_city_id)) {
            $query .= "&starting_city_id={$request->starting_city_id}";
            $paginator = $paginator->where('starting_city_id', $starting_city_id);
        }

        if(!is_null($code = $request->code)) {
            $query .= "&code={$request->code}";
            $provider_id = null;
            $coupon = Coupon::where(['code' => $request->code, 'status' => 'approved'])
                ->where('date_from', '<=', $today = Carbon::now()->toDateString())
                ->where('date_to', '>=', $today)
                ->first();
            if(!is_null($coupon)) $provider_id = $coupon->provider_id;

            $paginator = $paginator->where('packages.provider_id', $provider_id);
        }

        $paginator = $paginator->select('packages.*')->paginate($limit);

        $cities = City::pluck('name', 'id');
        $additionals = Additional::get();

        return view('guest.packages.index')
            ->with('paginator', $paginator)
            ->with('cities', $cities)
            ->with('additionals', $additionals)
            ->with('query', $query)
            ->with('search', $search)
            ->with('additional', $additional)
            ->with('date_from', $date_from)
            ->with('time_from', $time_from)
            ->with('starting_city_id', $starting_city_id)
            ->with('code', $code);
    }

    /**
     * Display the specified Package.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Request $request)
    {
        $package = $this->packageRepository->find($id);
        if (empty($package)) {
            Flash::error(__('messages.not_found', ['model' => __('models/packages.singular')]));
            return redirect(route('packages.index'));
        }

        //$morePackages = Package::where('id', '!=', $id)->take(4)->get();
        $reviews = Review::where(['package_id' => $id, 'publish' => 1])->take(3)->get();
        $additionals = Additional::get();
        $tax = (!is_null($provider = $package->provider) ? $provider->tax : 0);

        return view('guest.packages.show')
            ->with('package', $package)
            //->with('morePackages', $morePackages)
            ->with('reviews', $reviews)
            ->with('additionals', $additionals)
            ->with('tax', $tax);
    }

    public function review(CreateReviewRequest $request)
    {
        $package = $this->packageRepository->find($request->package_id);
        if (empty($package)) {
            Flash::error(__('messages.not_found', ['model' => __('models/packages.singular')]));
            return redirect(route('packages.index'));
        }

        DB::beginTransaction();

        $input = array_merge($request->all(), [
            'user_id' => $this->id,
            'provider_id' => $package->provider_id,
        ]);

        $review = Review::create($input);

        $package = $this->packageRepository->update([
            'rate' => $package->reviews->sum('rate') / $package->reviews->count()
        ], $request->package_id);

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
