@extends('admin.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/notifications.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.notifications.index') }}">@lang('models/notifications.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($notification, ['route' => ['admin.notifications.update', $notification->id], 'files' => 'on', 'method' => 'patch']) !!}
                        @include('admin.notifications.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection