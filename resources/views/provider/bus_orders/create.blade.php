@extends('provider.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/busOrders.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.busOrders.index') }}">@lang('models/busOrders.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'provider.busOrders.store']) !!}
                        @include('provider.bus_orders.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection