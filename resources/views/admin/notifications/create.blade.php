@extends('admin.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/notifications.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.notifications.index') }}">@lang('models/notifications.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.notifications.store']) !!}
                        @include('admin.notifications.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection