@extends('auth.layout')

@section('title', __('auth.confirm_passwords.title'))

@section('content')
<section id="wrapper">
    <div class="login-register">
        <div class="login-box card">
            <div class="card-body">
                @include('flash::message')
                {!! Form::open(['route' => 'admin.password.email', 'type' => 'post', 'class' => 'form-horizontal form-material']) !!}
                    <h3 class="text-center m-b-20">@lang('auth.confirm_passwords.title')</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="@lang('auth.password')"
                                required autocomplete="current-password">

                            @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">@lang('auth.confirm_passwords.send_pwd_confirm')</button>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <a href="{{ route('admin.password.request') }}" class="text-info m-l-5"><b>@lang('auth.forgot_password.title')</b></a>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection