@extends('admin.layouts.app')

@section('title', __('msg.dashboard'))

@push('third_party_stylesheets')
    <!-- This page CSS -->
    <link href="{{ asset('elite/assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
@endpush

@push('page-css')
    <!-- Dashboard 31 Page CSS -->
    <link href="{{ asset('elite/horizontal/dist/css/pages/dashboard3.css') }}" rel="stylesheet">
@endpush

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('msg.dashboard')</li>
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Info box -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($statistics as $i =>$statistic)
                        <div class="col-lg-3 col-md-6 m-b-30 text-center"> <small>@lang('msg.'.$statistic['name'])</small>
                            <h2><i class="{{ $statistic['icon'] }} text-{{ $statistic['color'] }}"></i> {{ $statistic['value'] }}</h2>
                            <div id="sparklinedash{{ $i == 0 ? null : $i+1 }}"></div>
                        </div>
                        @endforeach
                    </div>
                    <ul class="list-inline font-12 text-center">
                        <li><i class="fa fa-circle text-primary"></i> @lang('models/busOrders.plural')</li>
                        <li><i class="fa fa-circle text-cyan"></i> @lang('models/tripOrders.plural')</li>
                        <li><i class="fa fa-circle text-purple"></i> @lang('models/packageOrders.plural')</li>
                    </ul>
                    <div id="morris-area-chart" style="height: 340px;"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- ============================================================== -->
    <!-- Campaign -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                @foreach($data as $d)
                <!-- column -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $d['name'] }}</h5>
                            <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                                <span class="display-5 text-{{ $d['color'] }}"><i class="{{ $d['icon'] }}"></i></span>
                                <a href="{{ $d['link'] }}" class="link display-5 ml-auto">{{ $d['value'] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-6">
            <div class="news-slide m-b-15">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        @foreach($packages as $i => $package)
                        <div class="{{ $i == 0 ? 'active' : null }} carousel-item">
                            <div class="overlaybg"><img src="{{ asset(asset('images/packages/'.$package->image)) }}" class="img-fluid" /></div>
                            <div class="news-content carousel-caption"><span class="label label-primary label-rounded">{{ $package->name }}</span>
                                <h4>{{ substr($package->description, 0, 100) }}</h4> 
                                <a href="{{ route('admin.packages.show', $package->id) }}">@lang('msg.read_more')</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Campaign -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- End Info box -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Today's Schedule and sales overview -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-40 align-items-center no-block">
                        <h5 class="card-title ">@lang('msg.year_users_chart')</h5>
                        <div class="ml-auto">
                            <ul class="list-inline font-12">
                                <li><i class="fa fa-circle text-cyan"></i> @lang('models/users.plural')</li>
                                <li><i class="fa fa-circle text-primary"></i> @lang('models/providers.plural')</li>
                            </ul>
                        </div>
                    </div>
                    <div id="morris-area-chart2" style="height: 340px;"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-4 col-md-12">
            <div class="row">
                <!-- Column -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('msg.orders_income')</h5>
                            <div class="row">
                                <div class="col-12">
                                    <div id="sales1" class="text-center"></div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="ml-auto mt-3">
                                        <h1 class="text-primary" title="@lang('msg.orders_total_income')">${{ $amount }}</h1>
                                        <p class="text-muted" title="@lang('msg.last_order_date')">{{ $date }}</p>
                                        <b title="@lang('msg.all_orders')">({{ $count . ' ' . __('msg.orders') }})</b> 
                                        <ul class="list-style-none font-12 mt-2">
                                            <li><i class="fa fa-circle text-cyan"></i> @lang('models/busOrders.plural') ( {{ $busOrderCount }} )</li>
                                            <li><i class="fa fa-circle text-warning"></i> @lang('models/tripOrders.plural') ( {{ $tripOrderCount }} )</li>
                                            <li><i class="fa fa-circle text-primary"></i> @lang('models/packageOrders.plural') ( {{ $packageOrderCount }} )</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales Chart and browser state-->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
@endsection

@push('third_party_scripts')
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/morrisjs/morris.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
@endpush

@push('page_scripts')
    @include('admin.home.script')
@endpush