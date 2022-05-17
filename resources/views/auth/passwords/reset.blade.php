@extends('auth.layout')

@section('title', __('auth.reset_password.title'))

@section('content')
<section id="wrapper">
    <div class="login-register">
        <div class="login-box card">
            <div class="card-body">
                @include('flash::message')
                {!! Form::open(['route' => 'password.update', 'type' => 'post', 'class' => 'form-horizontal form-material']) !!}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <h3 class="text-center m-b-20">@lang('auth.reset_password.title')</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input type="email"
                                name="email"
                                value="{{ $email ?? old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="@lang('auth.email')">

                            @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="@lang('auth.password')">

                            @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="@lang('auth.confirm_password')">
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">@lang('auth.reset_password.reset_pwd_btn')</button>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <a href="{{ route('login') }}" class="text-info m-l-5"><b>@lang('auth.sign_in')</b></a>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection