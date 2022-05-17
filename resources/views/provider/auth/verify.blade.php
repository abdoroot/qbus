@extends('auth.layout')

@section('content')
<section id="wrapper" class="step-register" style="overflow: auto;">
    <div class="register-box">
        <div class="register-div">
            <a href="{{ route('home') }}" class="text-center m-b-40">
                <img src="{{ $app_logo }}" alt="{{ __('msg.app_name') }}" style="max-width: 200px;" />
                {{-- <br/>
                <img src="{{ asset('logo-light.png') }}" alt="{{ __('msg.app_name') }}" /> --}}
            </a>
            <!-- multistep form -->
            <div id="msform">
                <!-- progressbar -->
                <ul id="eliteregister">
                    <li>{{ __('models/providers.singular') }}</li>
                    <li class="active">{{ __('auth.provider.verify') }}</li>
                    <li>{{ __('auth.provider.account') }}</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    @include('flash::message')
                    <h3 class="card-title p-3">{{ __('auth.verify_phone.title') }}</h3>
                    <h5 class="fs-subtitle">{{ __('auth.verify_phone.subtitle') }}</h5>
                    {!! Form::open(['route' => ['provider.verification.verify', $provider->id]]) !!}
                        <input type="text" name="code" placeholder="{{ __('auth.verify_phone.input') }}" class="@error('code') is-invalid @enderror" required/>
                        <div class="form-group row mb-3 mt-3">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('crud.confirm') }}
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['route' => ['provider.verification.resend', ['id' => $provider->id]], 'id' => 'resend-form']) !!}
                    <a class="mb-3" href="javascript:;" onclick="document.getElementById('resend-form').submit();">{{ __('auth.verify_phone.another_req') }}</a>
                    {!! Form::close() !!}
                </fieldset>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-styles')
<link href="{{ asset('elite/assets/node_modules/register-steps/steps.css') }}" rel="stylesheet">
<link href="{{ asset('elite/dist/css/pages/register3.css') }}" rel="stylesheet">
<style>
    #msform .col-md-7 {
        margin-bottom: 18px;
    }
    #msform input {
        margin-bottom: 0px;
    }
</style>
@endsection

@section('page-scripts')
<script src="{{ asset('elite/assets/node_modules/register-steps/jquery.easing.min.js') }}"></script>
<script src="{{ asset('elite/assets/node_modules/register-steps/register-init.js') }}"></script>
@endsection