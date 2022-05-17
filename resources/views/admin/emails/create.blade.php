@extends('admin.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/emails.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.emails.index') }}">@lang('models/emails.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.emails.store']) !!}
                        @include('admin.emails.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection