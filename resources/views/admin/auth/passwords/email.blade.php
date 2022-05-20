@extends('admin.auth.layout')

@section('title', __('auth.forgot_password.title'))

@section('content')
{!! Form::open(['route' => 'admin.password.email', 'type' => 'post', 'class' => 'form-horizontal form-material']) !!}
    <h3 class="text-center m-b-20">@lang('auth.forgot_password.title')</h3>
    <div class="form-group ">
        <div class="col-xs-12">
            <input type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="@lang('auth.email')">

            @error('email')
            <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group text-center">
        <div class="col-xs-12 p-b-20">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">@lang('auth.forgot_password.send_pwd_reset')</button>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div class="col-sm-12 text-center">
            <a href="{{ route('admin.login') }}" class="text-info m-l-5"><b>@lang('auth.sign_in')</b></a>
        </div>
    </div>
{!! Form::close() !!}
@endsection