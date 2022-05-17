@extends('admin.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/cities.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.cities.index') }}">@lang('models/cities.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($city, ['route' => ['admin.cities.update', $city->id], 'method' => 'patch']) !!}
                        @include('admin.cities.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection