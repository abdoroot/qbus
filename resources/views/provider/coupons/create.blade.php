@extends('provider.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/coupons.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.coupons.index') }}">@lang('models/coupons.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'provider.coupons.store']) !!}
                        @include('provider.coupons.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection