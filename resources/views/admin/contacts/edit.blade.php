@extends('admin.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/contacts.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">@lang('models/contacts.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($contact, ['route' => ['admin.contacts.update', $contact->id], 'method' => 'patch']) !!}
                        @include('admin.contacts.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection