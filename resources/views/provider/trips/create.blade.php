@extends('provider.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/trips.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.trips.index') }}">@lang('models/trips.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body wizard-content">
                    {!! Form::open(['route' => 'provider.trips.store', 'files' => 'on', 'class' => 'tab-wizard wizard-circle', 'id' => 'trip-form']) !!}
                        {{-- @ include('provider.trips.fields') --}}
                        @include('provider.trips.new_fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection