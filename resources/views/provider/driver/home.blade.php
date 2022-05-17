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
<script>
    $(function () {
    "use strict";
    Morris.Area({
        element: 'morris-area-chart',
        data: {!! json_encode($orders) !!},
        lineColors: ['#fb9678', '#01c0c8', '#ab8ce4'],
        xkey: 'day',
        ykeys: ['busOrders', 'tripOrders', 'backageOrders'],
        labels: [
            "@lang('models/busOrders.plural')", 
            "@lang('models/tripOrders.plural')", 
            "@lang('models/packageOrders.plural')"
        ],
        pointSize: 2,
        lineWidth: 0,
        resize:true,
        fillOpacity: 0.8,
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        hideHover: 'auto',
        xLabels: "day",
        parseTime: false        
    });
});
    var sparklineLogin = function() { 
        $('#sparklinedash').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9, 12, 10, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '10',
            barColor: '#4caf50'
        });
         $('#sparklinedash2').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9, 12, 10, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '10',
            barColor: '#9675ce'
        });
          $('#sparklinedash3').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9, 12, 10, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '10',
            barColor: '#03a9f3'
        });
           $('#sparklinedash4').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9, 12, 10, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '10',
            barColor: '#f96262'
        });
   }
    var sparkResize;
 
    $(window).resize(function(e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineLogin, 500);
    });
    sparklineLogin();

</script>
@endpush