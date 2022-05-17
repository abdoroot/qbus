@extends('auth.layout')

@section('title', __('auth.registration.title'))
    
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
                    <li class="active">{{ __('models/providers.singular') }}</li>
                    <li>{{ __('auth.provider.verify') }}</li>
                    <li>{{ __('auth.provider.account') }}</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    @include('flash::message')
                    <h2 class="fs-title">{{ __('auth.provider.title') }}</h2>
                    <h3 class="fs-subtitle">{{ __('auth.step', ['n' => 1]) }}</h3>
                    {!! Form::open(['route' => 'provider.register', 'type' => 'post', 'files' => 'on', 'class' => 'form-horizontal', 'id' => 'loginform']) !!}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('models/providers.fields.name')</label>
                            <div class="col-md-7">
                                <input type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="@lang('models/providers.fields.name')">

                                @error('name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('models/providers.fields.email')</label>
                            <div class="col-md-7">
                                <input type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="@lang('models/providers.fields.email')">

                                @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">@lang('models/providers.fields.phone')</label>
                            <div class="col-md-7">
                                <input type="tel"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="@lang('models/providers.fields.phone')">

                                @error('phone')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">@lang('models/providers.fields.address')</label>
                            <div class="col-md-7">
                                <input type="text"
                                    name="address"
                                    value="{{ old('address') }}"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="@lang('models/providers.fields.address')">

                                @error('address')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comm_name" class="col-md-4 col-form-label text-md-right">@lang('models/providers.fields.comm_name')</label>
                            <div class="col-md-7">
                                <input type="text"
                                    name="comm_name"
                                    value="{{ old('comm_name') }}"
                                    class="form-control @error('comm_name') is-invalid @enderror"
                                    placeholder="@lang('models/providers.fields.comm_name')">

                                @error('comm_name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comm_reg_num" class="col-md-4 col-form-label text-md-right">@lang('models/providers.fields.comm_reg_num')</label>
                            <div class="col-md-7">
                                <input type="text"
                                    name="comm_reg_num"
                                    value="{{ old('comm_reg_num') }}"
                                    class="form-control @error('comm_reg_num') is-invalid @enderror"
                                    placeholder="@lang('models/providers.fields.comm_reg_num')">

                                @error('comm_reg_num')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comm_reg_img" class="col-md-4 col-form-label text-md-right">@lang('models/providers.fields.comm_reg_img')</label>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <div class="custom-file mb-3">
                                        {!! Form::file('comm_reg_img', ['class' => 'custom-file-input' . ($errors->has('comm_reg_img') ? ' is-invalid' : '')]) !!}
                                        {!! Form::label('comm_reg_img', __('msg.updoad_file'), ['class' => 'custom-file-label form-control', 'data-browse' => __('msg.browse')]) !!}
                                    </div>
                                </div>
                                @error('comm_reg_img')
                                <span class="invalid-feedback"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tax_cert_num" class="col-md-4 col-form-label text-md-right">@lang('models/providers.fields.tax_cert_num')</label>
                            <div class="col-md-7">
                                <input type="text"
                                    name="tax_cert_num"
                                    value="{{ old('tax_cert_num') }}"
                                    class="form-control @error('tax_cert_num') is-invalid @enderror"
                                    placeholder="@lang('models/providers.fields.tax_cert_num')">

                                @error('tax_cert_num')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <h4 class="card-title">@lang('models/providers.tabs.cities_title')</h4>
                        <h5 class="card-subtitle">@lang('models/providers.tabs.cities_subtitle')</h5>
                        <div class="form-group p-t-5 row">
                            {!! Form::select('cities[]', $cities, [], ['multiple' => true, 'class' => 'form-control select2 ' . ($errors->has('cities') ? ' is-invalid' : ''),'id'=>'cities']) !!}
                            @error('cities')
                            <span class="invalid-feedback"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group text-center p-b-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">@lang('auth.register')</button>
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                @lang('auth.registration.have_membership') <a href="{{ route('provider.login') }}" class="text-info m-l-5"><b>@lang('auth.sign_in')</b></a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </fieldset>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</section>
@endsection

@section('page-styles')
<link href="{{ asset('elite/assets/node_modules/register-steps/steps.css') }}" rel="stylesheet">
<link href="{{ asset('elite/dist/css/pages/register3.css') }}" rel="stylesheet">
<!-- Select2 plugins css -->
<link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

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
<!-- Select2 Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
    $('.select2').select2();
</script>
@endsection