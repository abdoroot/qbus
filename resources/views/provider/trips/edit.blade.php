@extends('provider.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/trips.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.trips.index') }}">@lang('models/trips.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body wizard-content">
                    {!! Form::model($trip, ['route' => ['provider.trips.update', $trip->id], 'method' => 'patch', 'files' => 'on', 'class' => 'tab-wizard wizard-circle', 'id' => 'trip-form']) !!}
                        @include('provider.trips.new_fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection