@extends('provider.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/packageOrders.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.packageOrders.index') }}">@lang('models/packageOrders.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'provider.packageOrders.store']) !!}
                        @include('provider.package_orders.create_fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection