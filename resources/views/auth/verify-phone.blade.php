@extends('auth.layout')

@section('content')
<section id="wrapper" style="overflow: auto;">
    <div class="login-register position-relative">
        <div class="login-box card">
            <div class="card-body">
                @include('flash::message')
                <h3 class="card-title p-3">{{ __('auth.verify_phone.title') }}</h3>
                <h5 class="card-subtitle">{{ __('auth.verify_phone.subtitle') }}</h5>
                {!! Form::open(['route' => ['verification.verify', $user->id]]) !!}
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" name="code" placeholder="{{ __('auth.verify_phone.input') }}" class="form-control @error('code') is-invalid @enderror" required/>

                            @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3 mt-3">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('crud.confirm') }}
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
                {!! Form::open(['route' => ['verification.resend', ['id' => $user->id]], 'id' => 'resend-form']) !!}
                <a class="mb-3" href="javascript:;" onclick="document.getElementById('resend-form').submit();">{{ __('auth.verify_phone.another_req') }}</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection
