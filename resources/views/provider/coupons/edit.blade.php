@extends('provider.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/coupons.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.coupons.index') }}">@lang('models/coupons.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($coupon, ['route' => ['provider.coupons.update', $coupon->id], 'method' => 'patch']) !!}
                        @include('provider.coupons.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection