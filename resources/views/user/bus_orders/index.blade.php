@extends('user.layouts.app')

@section('title', __('models/busOrders.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/busOrders.plural')</li>
@endsection

@section('top-buttons')
<a href="{{ route('busOrders.create') }}" class="btn btn-info m-l-15"><i class="fa fa-plus-circle"></i> @lang('crud.add_new')</a>
@endsection

@section('content')

<div class="row">
    @include('flash::message')
    {{-- <div class="card col-sm-12">
        <div class="card-body p-0"> --}}
            @include('user.bus_orders.table')
        {{-- </div>
    </div> --}}
</div>

@endsection