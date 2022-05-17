@extends('provider.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/buses.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.buses.index') }}">@lang('models/buses.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'provider.buses.store', 'files' => true]) !!}
                        @include('provider.buses.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection