@extends('auth.layout')

@section('title', __('auth.login.admin'))

@section('content')
<section id="wrapper">
    <div class="login-register">
        <div class="login-box card">
            <div class="card-body">
                @include('flash::message')
                {!! Form::open(['route' => 'admin.login', 'type' => 'post', 'class' => 'form-horizontal form-material', 'id' => 'loginform']) !!}
                    <h3 class="text-center m-b-20">@lang('auth.login.admin')</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="@lang('auth.email')"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input type="password"
                                name="password"
                                placeholder="@lang('auth.password')"
                                class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                    <label class="custom-control-label" for="remember">@lang('auth.login.remember_me')</label>
                                </div> 
                                <div class="ml-auto">
                                    <a href="{{ route('admin.password.request') }}" class="text-muted"><i class="fas fa-lock m-r-5"></i> @lang('auth.login.forgot_password')</a> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">@lang('auth.sign_in')</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection