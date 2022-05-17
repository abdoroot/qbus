@extends('admin.layouts.app')

@section('title', __('msg.calender'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body b-l calender-sidebar">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('page_css')
<link href="{{ asset('elite/assets/node_modules/calendar/dist/fullcalendar.css') }}" rel="stylesheet" />
@endpush

@push('page_scripts')
<!-- calender JavaScript -->
<script src="{{ asset('elite/assets/node_modules/calendar/jquery-ui.min.js') }}"></script>
<script src="{{ asset('elite/assets/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('elite/assets/node_modules/calendar/dist/fullcalendar.min.js') }}"></script>
@include('admin.calender.script')
<!--Sky Icons JavaScript -->
<script src="{{ asset('elite/assets/node_modules/skycons/skycons.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('elite/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
@endpush