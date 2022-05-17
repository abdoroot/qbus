@extends('admin.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/additionals.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.additionals.index') }}">@lang('models/additionals.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($additional, ['route' => ['admin.additionals.update', $additional->id], 'method' => 'patch']) !!}
                        @include('admin.additionals.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection