@extends('admin.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/busOrders.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.busOrders.index') }}">@lang('models/busOrders.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('content')
<div class="row">
    @include('flash::message')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body printableArea">
                <h3><b>@lang('models/busOrders.singular')</b> <span class="float-right">{{ '#' . $busOrder->id }}</span></h3>
                <hr>
                @include('admin.bus_orders.show_fields')
            </div>
            <div class="card-footer">
                <a class="btn btn-dark" href="{{ route('admin.busOrders.index') }}"> @lang('crud.back') </a>
                <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> @lang('crud.print')</span> </button>
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#cancel-modal"> @lang('crud.cancel') </button>
            </div>
        </div>
    </div>
</div>
@include('admin.bus_orders.cancel_modal')
@endsection

@push('page_scripts')
<script src="{{ asset('elite/dist/js/pages/jquery.PrintArea.js') }}" type="text/JavaScript"></script>
<script>
$(document).ready(function() {
    $("#print").click(function() {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("div.printableArea").printArea(options);
    });
});
</script>
@endpush