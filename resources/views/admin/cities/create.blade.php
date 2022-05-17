@extends('admin.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/cities.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.cities.index') }}">@lang('models/cities.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.cities.store']) !!}
                        @include('admin.cities.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection