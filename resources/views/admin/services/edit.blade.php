@extends('admin.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/services.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">@lang('models/services.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($service, ['route' => ['admin.services.update', $service->id], 'method' => 'patch', 'files' => true]) !!}
                        @include('admin.services.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection