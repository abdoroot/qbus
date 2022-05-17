@extends('admin.layouts.app')

@section('title', __('models/tripOrders.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/tripOrders.plural')</li>
@endsection

@section('top-buttons')
<a class="btn btn-primary" data-toggle="collapse" href="#filter-form" aria-expanded="false" aria-controls="filter-form">
    <i class="fas fa-filter"></i> @lang('msg.filter')
</a>
@endsection

@section('content')
<div class="row">
    @include('flash::message')
    @include('admin.trip_orders.filter')
    <div class="card col-sm-12">
        <div class="card-body p-0">
            @include('admin.trip_orders.table')
        </div>
    </div>
</div>
@endsection