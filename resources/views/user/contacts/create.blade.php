@extends('user.layouts.app')

@section('title', __('models/contacts.types.complaint'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('msg.my_complaints')</li>
@endsection

@section('content')
<div class="row">
    @include('flash::message')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ __('msg.contact') . ': ' . __('models/contacts.types.complaint') }}</h3>
                {!! Form::open(['route' => 'contacts.store']) !!}
                {!! Form::hidden('type', $type) !!}
                <!-- Name Field -->
                <div class="form-group">
                    {!! Form::label('name', __('models/contacts.fields.name').'*') !!}
                    {!! Form::text('name', !is_null(old('name')) ? old('name') : Auth::user()->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                    @error('name')
                    <span class="invalid-feedback"> {{ $message }} </span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    {!! Form::label('email', __('models/contacts.fields.email').'*') !!}
                    {!! Form::email('email', !is_null(old('email')) ? old('email') :Auth::user()->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
                    @error('email')
                    <span class="invalid-feedback"> {{ $message }} </span>
                    @enderror
                </div>

                <!-- Subject Field -->
                <div class="form-group">
                    {!! Form::label('subject', __('models/contacts.fields.subject').'*') !!}
                    {!! Form::text('subject', null, ['class' => 'form-control' . ($errors->has('subject') ? ' is-invalid' : '')]) !!}
                    @error('subject')
                    <span class="invalid-feedback"> {{ $message }} </span>
                    @enderror
                </div>

                <!-- Message Field -->
                <div class="form-group">
                    {!! Form::label('message', __('models/contacts.fields.message').'*') !!}
                    {!! Form::textarea('message', null, ['class' => 'form-control' . ($errors->has('message') ? ' is-invalid' : ''), 'rows' => 5]) !!}
                    @error('message')
                    <span class="invalid-feedback"> {{ $message }} </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-danger m-t-20"><i class="fa fa-envelope"></i> @lang('crud.submit')</button>
                <a href="{{ route('contacts.index') }}" class="btn btn-dark m-t-20"><i class="fa fa-times"></i> @lang('crud.cancel')</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection