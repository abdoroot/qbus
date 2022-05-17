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
                    <li>{{ __('auth.provider.verify') }}</li>
                    <li class="active">{{ __('auth.provider.account') }}</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    @include('flash::message')
                    <h3 class="card-title p-3">{{ __('auth.account.title') }}</h3>
                    <h5 class="fs-subtitle">{{ __('auth.account.subtitle') }}</h5>
                    {!! Form::open(['route' => ['provider.account', $provider_id], 'type' => 'post', 'class' => 'form-horizontal', 'id' => 'loginform']) !!}
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">@lang('models/accounts.fields.username')</label>
                            <div class="col-md-7">
                                <input type="text"
                                    name="username"
                                    value="{{ old('username') }}"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="@lang('models/accounts.fields.username')">

                                @error('username')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('models/accounts.fields.password')</label>
                            <div class="col-md-7">
                                <input type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="@lang('models/accounts.fields.password')">

                                @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group text-center p-b-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">@lang('crud.submit')</button>
                            </div>
                        </div>
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