@extends('admin.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/categories.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">@lang('models/categories.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.categories.store']) !!}
                        @include('admin.categories.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection