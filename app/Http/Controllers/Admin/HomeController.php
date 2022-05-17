<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Models\Provider;
use App\Models\Destination;
use App\Models\BusOrder;
use App\Models\TripOrder;
use App\Models\PackageOrder;
use App\Models\BusDatetime;
use App\Models\Trip;
use App\Models\Package;
use Carbon\Carbon;
use DB;

class HomeController extends AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $statistics = [
            [
                'name'  => 'new_users', 
                'value' => User::whereDate('created_at', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))->count(),
                'icon'  => 'icon-people',
                'color' => 'success',
            ],
            [
                'name'  => 'new_providers',
                'value' => Provider::whereDate('created_at', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))->count(),
                'icon'  => 'ti-truck',
                'color' => 'purple',
            ],
            [
                'name'  => 'destinations',
                'value' => Destination::count(),
                'icon'  => 'ti-direction',
                'color' => 'info',
            ],
            [
                'name'  => 'today_orders',
                'value' => BusOrder::whereDate('created_at', $today)->count() + 
                    tripOrder::whereDate('created_at', $today)->count() + 
                    PackageOrder::whereDate('created_at', $today)->count(),
                'icon'  => 'ti-shopping-cart',
                'color' => 'danger',
            ]
        ];

        $data = [
            [
                'name'  => __('models/users.plural'), 
                'value' => User::count(),
                'icon'  => 'icon-people',
                'color' => 'info',
                'link'  => route('admin.users.index'),
            ],
            [
                'name'  => __('models/providers.plural'),
                'value' => Provider::count(),
                'icon'  => 'ti-truck',
                'color' => 'purple',
                'link'  => route('admin.providers.index'),
            ],
            [
                'name'  => __('models/packages.plural'),
                'value' => Package::count(),
                'icon'  => 'ti-package',
                'color' => 'primary',
                'link'  => route('admin.packages.index'),
            ],
            [
                'name'  => __('models/trips.plural'),
                'value' => Trip::count(),
                'icon'  => 'ti-direction-alt',
                'color' => 'success',
                'link'  => route('admin.trips.index'),
            ]
        ];

        $orders = [];
        $users = [];
        $month = Carbon::now()->format('M');
        $m = Carbon::now()->format('m');
        $y = Carbon::now()->format('Y');

        for ($d=1; $d <= Carbon::now()->endOfMonth()->format('d'); $d++) {
            $orders[] = [
                'day' => "$d $month",
                'busOrders' => BusOrder::whereDate('created_at', "$y-$m-$d")->count(),
                'tripOrders' => TripOrder::whereDate('created_at', "$y-$m-$d")->count(),
                'backageOrders' => PackageOrder::whereDate('created_at', "$y-$m-$d")->count(),
            ];
        }

        for ($i=1; $i <= 12; $i++) {             
            $userCount = User::whereDate('created_at', '>=', "$y-$i-01")->whereDate('created_at', '<=', "$y-$i-31")->count();
            $providerCount = Provider::whereDate('created_at', '>=', "$y-$i-01")->whereDate('created_at', '<=', "$y-$i-31")->count();

            $users[] = [
                'day' => Carbon::parse("$y-$i-01")->format('M'),
                'users' => $userCount,
                'providers' => $providerCount,
            ];
        }

        $packages = Package::orderBy('id', 'desc')->take(3)->get();

        $amount = BusOrder::sum('total') + 
            tripOrder::sum('total') + 
            PackageOrder::sum('total');

        $count = ($busOrderCount = BusOrder::count()) + 
            ($tripOrderCount = tripOrder::count()) + 
            ($packageOrderCount = PackageOrder::count());

        $dates = [];
        if(!is_null($busOrder = BusOrder::orderBy('id', 'desc')->first())) $dates[] = $busOrder->created_at;
        if(!is_null($tripOrder = BusOrder::orderBy('id', 'desc')->first())) $dates[] = $tripOrder->created_at;
        if(!is_null($packageOrder = BusOrder::orderBy('id', 'desc')->first())) $dates[] = $packageOrder->created_at;
        
        $date = (!empty($dates) ? carbon::parse(min($dates))->format('M Y') : null);
        $orderTotals = [
            BusOrder::sum('total'),
            TripOrder::sum('total'),
            PackageOrder::sum('total'),
        ];

        return view('admin.home.index')
            ->with('statistics', $statistics)
            ->with('data', $data)
            ->with('orders', $orders)
            ->with('users', $users)
            ->with('packages', $packages)
            ->with('amount', $amount)
            ->with('count', $count)
            ->with('date', $date)
            ->with('orderTotals', $orderTotals)
            ->with('busOrderCount', $busOrderCount)
            ->with('tripOrderCount', $tripOrderCount)
            ->with('packageOrderCount', $packageOrderCount);
    }

    public function calender()
    {
        $datetimes = BusDatetime::join('buses', 'buses.id', '=', 'bus_datetimes.bus_id')
            ->select('buses.*', 
                DB::raw("CONCAT(date,' ',time_from) AS start"), 
                DB::raw("CONCAT(date,' ',time_to) AS end")
            )->get()->toArray();

        return view('admin.calender.index')
            ->with('datetimes', $datetimes);
    }

    public function translation()
    {
        return view('admin.translation');
    }

    public function tax_report(Request $request)
    {
        $providers = Provider::pluck('name', 'id');
        $provider_id = $request->provider_id;

        $start_date = $request->start_date ?? Carbon::parse(new Carbon('first day of this month'))->format('Y-m-d');
        $end_date = $request->end_date ?? Carbon::parse(new Carbon('last day of this month'))->format('Y-m-d');

        $busOrders = BusOrder::whereIn('status', ['approved', 'paid', 'complete'])
            ->where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->select('id', 'tax', 'total', 'user_id', 'provider_id', 'status', 'created_at');
            
        if(!is_null($provider_id)) {
            $busOrders = $busOrders->where('provider_id', $provider_id);
        }

        $busOrders = $busOrders->get();

        $tripOrders = TripOrder::whereIn('status', ['approved', 'paid'])
            ->where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->select('id', 'tax', 'total', 'user_id', 'provider_id', 'status', 'created_at');
            
        if(!is_null($provider_id)) {
            $tripOrders = $tripOrders->where('provider_id', $provider_id);
        }

        $tripOrders = $tripOrders->get();
            
        $packageOrders = PackageOrder::whereIn('status', ['approved', 'paid'])
            ->where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->select('id', 'tax', 'total', 'user_id', 'provider_id', 'status', 'created_at');
            
        if(!is_null($provider_id)) {
            $packageOrders = $packageOrders->where('provider_id', $provider_id);
        }

        $packageOrders = $packageOrders->get();

        $orders = $busOrders->concat($tripOrders)->concat($packageOrders)->sortBy('created_at');

        $statistics = [
            [
                'name'  => __('models/busOrders.plural'), 
                'value' => $busOrders->sum('tax'),
                'icon'  => 'ti-truck',
                'color' => 'primary',
            ],
            [
                'name'  => __('models/tripOrders.plural'),
                'value' => $tripOrders->sum('tax'),
                'icon'  => 'ti-direction',
                'color' => 'cyan',
            ],
            [
                'name'  => __('models/packageOrders.plural'),
                'value' => $packageOrders->sum('tax'),
                'icon'  => 'ti-package',
                'color' => 'purple',
            ],
            [
                'name'  => __('msg.total_tax'),
                'value' => $orders->sum('tax'),
                'icon'  => 'ti-shopping-cart',
                'color' => 'danger',
            ]
        ];

        $chart = [];
        $date = $start_date;
        $end = Carbon::parse($end_date);

        while (Carbon::parse($date)->lte($end)) {
            $bus = BusOrder::whereIn('status', ['approved', 'paid', 'complete'])->whereDate('created_at', $date);
            if(!is_null($provider_id)) $bus = $bus->where('provider_id', $provider_id);
            
            $trip = TripOrder::whereIn('status', ['approved', 'paid'])->whereDate('created_at', $date);
            if(!is_null($provider_id)) $trip = $trip->where('provider_id', $provider_id);
            
            $package = PackageOrder::whereIn('status', ['approved', 'paid'])->whereDate('created_at', $date);
            if(!is_null($provider_id)) $package = $package->where('provider_id', $provider_id);

            $chart[] = [
                'day' => Carbon::parse($date)->format('d M'),
                'busOrders' => $bus->sum('tax'),
                'tripOrders' => $trip->sum('tax'),
                'backageOrders' => $package->sum('tax'),
            ];

            $date = Carbon::parse($date)->addDay();
        }

        return view('admin.tax_report.index')
            ->with('providers', $providers)
            ->with('provider_id', $provider_id)
            ->with('start_date', $start_date)
            ->with('end_date', $end_date)
            ->with('busOrders', $busOrders)
            ->with('tripOrders', $tripOrders)
            ->with('packageOrders', $packageOrders)
            ->with('orders', $orders)
            ->with('statistics', $statistics)
            ->with('chart', $chart);
    }
}
