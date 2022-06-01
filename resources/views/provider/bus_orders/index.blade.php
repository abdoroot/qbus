@extends('provider.layouts.app')

@section('title', __('models/busOrders.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/busOrders.plural')</li>
@endsection

@section('top-buttons')
<a class="btn btn-primary" data-toggle="collapse" href="#filter-form" aria-expanded="false" aria-controls="filter-form">
    <i class="fas fa-filter"></i> @lang('msg.filter')
</a>
<a href="{{ route('provider.busOrders.create') }}" class="btn btn-info"><i class="fa fa-plus-circle"></i> @lang('crud.add_new')</a>
@endsection

@section('content')
<div class="row">
    @include('flash::message')
    @include('provider.bus_orders.filter')
    <div class="card col-sm-12">
        <div class="card-body p-0">
            @include('provider.bus_orders.table')
        </div>
    </div>
</div>
@endsection