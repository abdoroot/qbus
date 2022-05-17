@extends('admin.layouts.app')

@section('title', __('msg.tax_report'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('msg.tax_report')</li>
@endsection

@section('content')
    @include('admin.tax_report.filter')
    <div class="row">
        <!-- Column -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($statistics as $statistic)
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card">
                                <div class="box bg-{{ $statistic['color'] }} text-center">
                                    <h1 class="font-light text-white">{{ $statistic['value'] }}</h1>
                                    <h6 class="text-white">{{ $statistic['name'] }}</h6>
                                </div>
                            </div>
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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body p-0">
                    @include('admin.tax_report.table')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('third_party_stylesheets')
    <!-- Date picker plugins css -->
    <link href="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 plugins css -->
    <link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- This page CSS -->
    <link href="{{ asset('elite/assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
@endpush

@push('page-css')
    <!-- Dashboard 31 Page CSS -->
    <link href="{{ asset('elite/horizontal/dist/css/pages/dashboard3.css') }}" rel="stylesheet">
@endpush

@push('third_party_scripts')
    <!--sparkline JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/morrisjs/morris.js') }}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/moment/moment.js') }}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@push('page_scripts')
    @include('admin.tax_report.script')
@endpush