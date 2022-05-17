@extends('provider.layouts.app')

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
                            <div class="d-flex m-t-20 no-block align-items-center">
                                <span class="display-5 text-{{ $d['color'] }}"><i class="{{ $d['icon'] }}"></i></span>
                                <a href="{{ $d['link'] }}" class="link display-5 ml-auto">{{ $d['value'] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-6 col-md-12">
            <div class="row">
                <!-- Column -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('msg.orders_income')</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="ml-auto mt-3">
                                        <h1 class="text-primary" title="@lang('msg.orders_total_income')">${{ $amount }}</h1>
                                        <p class="text-muted" title="@lang('msg.last_order_date')">{{ $date }}</p>
                                        <b title="@lang('msg.all_orders')">({{ $count . ' ' . __('msg.orders') }})</b> 
                                        <ul class="list-style-none font-12 mt-2">
                                            <li class="pb-3"><i class="fa fa-circle text-cyan"></i> @lang('models/busOrders.plural') ( {{ $busOrderCount }} )</li>
                                            <li class="pb-3"><i class="fa fa-circle text-warning"></i> @lang('models/tripOrders.plural') ( {{ $tripOrderCount }} )</li>
                                            <li class="pb-3"><i class="fa fa-circle text-primary"></i> @lang('models/packageOrders.plural') ( {{ $packageOrderCount }} )</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="sales1" class="text-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    @include('provider.home.script')
@endpush