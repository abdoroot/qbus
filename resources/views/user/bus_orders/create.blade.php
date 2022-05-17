@extends('user.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/busOrders.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('busOrders.index') }}">@lang('models/busOrders.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
<div class="row">
    @include('flash::message')
    <div class="col-12">
        <div class="card">
            <div class="card-body wizard-content ">
                <h4 class="card-title">@lang('models/busOrders.plural')</h4>
                <h6 class="card-subtitle">@lang('crud.add_new')</h6>
                {!! Form::open(['route' => 'busOrders.store', 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'bus-order-form']) !!}
                    @include('user.bus_orders.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection