<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Terminal;
use App\Models\Coupon;
use App\Models\Account;
use App\Models\Bus;
use App\Models\Destination;
use App\Models\BusOrder;
use App\Models\TripOrder;
use App\Models\PackageOrder;
use App\Models\BusDatetime;
use App\Models\Trip;
use App\Models\Package;
use Carbon\Carbon;use Auth;
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
        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('provider')->user()->role == 'driver') {
            $today = Carbon::now()->format('Y-m-d');
            $account_id = Auth::guard('provider')->user()->id;
            $statistics = [
                [
                    'name'  => __('models/busOrders.plural'), 
                    'value' => BusOrder::where('bus_orders.provider_id', $this->provider_id)
                        ->join('buses', 'buses.id', '=', 'bus_orders.bus_id')
                        ->where('buses.account_id', $account_id)
                        ->select('bus_orders.*')
                        ->count(),
                    'icon'  => 'ti-truck',
                    'color' => 'success',
                ],
                [
                    'name'  => __('models/tripOrders.plural'),
                    'value' => TripOrder::where('trip_orders.provider_id', $this->provider_id)
                        ->join('trips', 'trips.id', '=', 'trip_orders.trip_id')
                        ->join('buses', 'buses.id', '=', 'trips.bus_id')
                        ->where('buses.account_id', $account_id)
                        ->select('trip_orders.*')
                        ->count(),
                    'icon'  => 'ti-direction',
                    'color' => 'info',
                ],
                [
                    'name'  => __('models/packageOrders.plural'),
                    'value' => PackageOrder::where('provider_id', $this->provider_id)->count(),
                    'icon'  => 'ti-package',
                    'color' => 'purple',
                ],
                [
                    'name'  => 'today_orders',
                    'value' => 
                        BusOrder::where('bus_orders.provider_id', $this->provider_id)
                            ->join('buses', 'buses.id', '=', 'bus_orders.bus_id')
                            ->where('buses.account_id', $account_id)
                            ->select('bus_orders.*')
                            ->whereDate('bus_orders.created_at', $today)
                            ->count() + 
                        TripOrder::where('trip_orders.provider_id', $this->provider_id)
                            ->join('trips', 'trips.id', '=', 'trip_orders.trip_id')
                            ->join('buses', 'buses.id', '=', 'trips.bus_id')
                            ->where('buses.account_id', $account_id)
                            ->select('trip_orders.*')
                            ->whereDate('trip_orders.created_at', $today)->count() + 
                        PackageOrder::where('provider_id', $this->provider_id)
                            ->whereDate('created_at', $today)
                            ->count(),
                    'icon'  => 'ti-shopping-cart',
                    'color' => 'danger',
                ]
            ];

            $orders = [];
            $month = Carbon::now()->format('M');
            $m = Carbon::now()->format('m');
            $y = Carbon::now()->format('Y');

            for ($d=1; $d <= Carbon::now()->endOfMonth()->format('d'); $d++) {
                $orders[] = [
                    'day' => "$d $month",
                    'busOrders' => BusOrder::where('bus_orders.provider_id', $this->provider_id)
                        ->join('buses', 'buses.id', '=', 'bus_orders.bus_id')
                        ->where('buses.account_id', $account_id)
                        ->select('bus_orders.*')
                        ->whereDate('bus_orders.created_at', "$y-$m-$d")->count(),
                    'tripOrders' => TripOrder::where('trip_orders.provider_id', $this->provider_id)
                        ->join('trips', 'trips.id', '=', 'trip_orders.trip_id')
                        ->join('buses', 'buses.id', '=', 'trips.bus_id')
                        ->where('buses.account_id', $account_id)
                        ->select('trip_orders.*')
                        ->whereDate('trip_orders.created_at', "$y-$m-$d")->count(),
                    'backageOrders' => PackageOrder::where('provider_id', $this->provider_id)
                        ->whereDate('created_at', "$y-$m-$d")->count(),
                ];
            }

            return view('provider.driver.home')
                ->with('statistics', $statistics)
                ->with('orders', $orders);
        }

        $today = Carbon::now()->format('Y-m-d');
        $statistics = [
            [
                'name'  => 'terminals', 
                'value' => Terminal::where('provider_id', $this->provider_id)->count(),
                'icon'  => 'icon-people',
                'color' => 'success',
            ],
            [
                'name'  => 'destinations',
                'value' => Destination::where('provider_id', $this->provider_id)->count(),
                'icon'  => 'ti-direction',
                'color' => 'info',
            ],
            [
                'name'  => 'coupons',
                'value' => Coupon::where('provider_id', $this->provider_id)->count(),
                'icon'  => 'ti-truck',
                'color' => 'purple',
            ],
            [
                'name'  => 'today_orders',
                'value' => BusOrder::where('provider_id', $this->provider_id)->whereDate('created_at', $today)->count() + 
                    TripOrder::where('provider_id', $this->provider_id)->whereDate('created_at', $today)->count() + 
                    PackageOrder::where('provider_id', $this->provider_id)->whereDate('created_at', $today)->count(),
                'icon'  => 'ti-shopping-cart',
                'color' => 'danger',
            ]
        ];

        $data = [
            [
                'name'  => __('models/accounts.plural'), 
                'value' => Account::where('provider_id', $this->provider_id)->count(),
                'icon'  => 'icon-people',
                'color' => 'info',
                'link'  => route('provider.accounts.index'),
            ],
            [
                'name'  => __('models/buses.plural'),
                'value' => Bus::where('provider_id', $this->provider_id)->count(),
                'icon'  => 'ti-truck',
                'color' => 'purple',
                'link'  => route('provider.buses.index'),
            ],
            [
                'name'  => __('models/packages.plural'),
                'value' => Package::where('provider_id', $this->provider_id)->count(),
                'icon'  => 'ti-package',
                'color' => 'primary',
                'link'  => route('provider.packages.index'),
            ],
            [
                'name'  => __('models/trips.plural'),
                'value' => Trip::where('provider_id', $this->provider_id)->count(),
                'icon'  => 'ti-direction-alt',
                'color' => 'success',
                'link'  => route('provider.trips.index'),
            ]
        ];

        $orders = [];
        $month = Carbon::now()->format('M');
        $m = Carbon::now()->format('m');
        $y = Carbon::now()->format('Y');

        for ($d=1; $d <= Carbon::now()->endOfMonth()->format('d'); $d++) {
            $orders[] = [
                'day' => "$d $month",
                'busOrders' => BusOrder::where('provider_id', $this->provider_id)->whereDate('created_at', "$y-$m-$d")->count(),
                'tripOrders' => TripOrder::where('provider_id', $this->provider_id)->whereDate('created_at', "$y-$m-$d")->count(),
                'backageOrders' => PackageOrder::where('provider_id', $this->provider_id)->whereDate('created_at', "$y-$m-$d")->count(),
            ];
        }

        $amount = BusOrder::sum('total') + 
            TripOrder::where('provider_id', $this->provider_id)->sum('total') + 
            PackageOrder::where('provider_id', $this->provider_id)->sum('total');

        $count = ($busOrderCount = BusOrder::where('provider_id', $this->provider_id)->count()) + 
            ($tripOrderCount = TripOrder::where('provider_id', $this->provider_id)->count()) + 
            ($packageOrderCount = PackageOrder::where('provider_id', $this->provider_id)->count());

        $dates = [];
        if(!is_null($busOrder = BusOrder::where('provider_id', $this->provider_id)->orderBy('id', 'desc')->first())) $dates[] = $busOrder->created_at;
        if(!is_null($tripOrder = BusOrder::where('provider_id', $this->provider_id)->orderBy('id', 'desc')->first())) $dates[] = $tripOrder->created_at;
        if(!is_null($packageOrder = BusOrder::where('provider_id', $this->provider_id)->orderBy('id', 'desc')->first())) $dates[] = $packageOrder->created_at;
        
        $date = (!empty($dates) ? carbon::parse(min($dates))->format('M Y') : null);
        $orderTotals = [
            BusOrder::where('provider_id', $this->provider_id)->sum('total'),
            TripOrder::where('provider_id', $this->provider_id)->sum('total'),
            PackageOrder::where('provider_id', $this->provider_id)->sum('total'),
        ];

        return view('provider.home.index')
            ->with('statistics', $statistics)
            ->with('data', $data)
            ->with('orders', $orders)
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
            ->where('buses.provider_id', $this->provider_id);

        if(Auth::guard('provider')->user()->role == 'driver') {
            $datetimes = $datetimes->where('buses.account_id', Auth::guard('provider')->user()->id);
        }
        $datetimes = $datetimes->select('buses.*', 
                DB::raw("CONCAT(date,' ',time_from) AS start"), 
                DB::raw("CONCAT(date,' ',time_to) AS end")
            )->get()->toArray();

        return view('provider.calender.index')
            ->with('datetimes', $datetimes);
    }

    public function tax_report(Request $request)
    {
        $provider_id = $this->provider_id;

        $start_date = $request->start_date ?? Carbon::parse(new Carbon('first day of this month'))->format('Y-m-d');
        $end_date = $request->end_date ?? Carbon::parse(new Carbon('last day of this month'))->format('Y-m-d');

        $busOrders = BusOrder::whereIn('status', ['approved', 'paid', 'complete'])
            ->where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->select('id', 'tax', 'total', 'user_id', 'provider_id', 'status', 'created_at')
            ->where('provider_id', $provider_id)->get();

        $tripOrders = TripOrder::whereIn('status', ['approved', 'paid'])
            ->where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->select('id', 'tax', 'total', 'user_id', 'provider_id', 'status', 'created_at')
            ->where('provider_id', $provider_id)->get();
            
        $packageOrders = PackageOrder::whereIn('status', ['approved', 'paid'])
            ->where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->select('id', 'tax', 'total', 'user_id', 'provider_id', 'status', 'created_at')
            ->where('provider_id', $provider_id)->get();

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
            $bus = BusOrder::whereIn('status', ['approved', 'paid', 'complete'])
                ->whereDate('created_at', $date)
                ->where('provider_id', $provider_id)
                ->sum('tax');

            $trip = TripOrder::whereIn('status', ['approved', 'paid'])
                ->whereDate('created_at', $date)
                ->where('provider_id', $provider_id)
                ->sum('tax');
            $package = PackageOrder::whereIn('status', ['approved', 'paid'])
                ->whereDate('created_at', $date)
                ->where('provider_id', $provider_id)
                ->sum('tax');

            $chart[] = [
                'day' => Carbon::parse($date)->format('d M'),
                'busOrders' => $bus,
                'tripOrders' => $trip,
                'backageOrders' => $package,
            ];

            $date = Carbon::parse($date)->addDay();
        }

        return view('provider.tax_report.index')
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
