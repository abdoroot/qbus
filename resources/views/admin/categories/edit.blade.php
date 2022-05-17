@extends('admin.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/categories.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">@lang('models/categories.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($category, ['route' => ['admin.categories.update', $category->id], 'method' => 'patch']) !!}
                        @include('admin.categories.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection