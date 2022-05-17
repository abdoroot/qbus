@extends('admin.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/admins.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">@lang('models/admins.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($admin, ['route' => ['admin.admins.update', $admin->id], 'method' => 'patch']) !!}
                        @include('admin.admins.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection