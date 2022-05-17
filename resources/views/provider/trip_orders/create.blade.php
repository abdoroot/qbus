@extends('provider.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/tripOrders.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.tripOrders.index') }}">@lang('models/tripOrders.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'provider.tripOrders.store']) !!}
                        @include('provider.trip_orders.create_fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection