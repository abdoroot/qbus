@extends('provider.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/destinations.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.destinations.index') }}">@lang('models/destinations.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($destination, ['route' => ['provider.destinations.update', $destination->id], 'method' => 'patch']) !!}
                        @include('provider.destinations.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
