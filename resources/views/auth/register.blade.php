@extends('auth.layout')

@section('title', __('auth.registration.title'))
    
@section('content')
<section id="wrapper" style="overflow: auto;">
    <div class="login-register position-relative">
        <div class="login-box card">
            <div class="card-body">
                @include('flash::message')
                {!! Form::open(['route' => 'register', 'type' => 'post', 'class' => 'form-horizontal form-material', 'id' => 'loginform']) !!}
                    <h3 class="text-center m-b-20">@lang('auth.registration.title')</h3>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="@lang('models/users.fields.name') *">

                            @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="@lang('models/users.fields.email')">

                            @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="@lang('models/users.fields.phone') *">

                            @error('phone')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text"
                                name="address"
                                value="{{ old('address') }}"
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="@lang('models/users.fields.address') *">

                            @error('address')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text"
                                name="date_of_birth"
                                value="{{ old('date_of_birth') }}"
                                class="form-control datepicker-autoclose @error('date_of_birth') is-invalid @enderror"
                                placeholder="@lang('models/users.fields.date_of_birth') *">

                            @error('date_of_birth')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="@lang('models/users.fields.password') *">
                        
                            @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="@lang('auth.confirm_password') *">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            {!! Form::label('text', __('models/users.fields.marital_status').'*', ['class' => 'control-label']) !!}
                            @foreach(['single', 'married'] as $maritalStatus)
                            <div class="custom-control custom-radio">
                                {!! Form::radio('marital_status', $maritalStatus, $maritalStatus == 'primary' && !isset($user) ? true : null, ['id' => "marital-status-{$maritalStatus}", 'class' => 'custom-control-input']) !!}
                                {!! Form::label("marital-status-{$maritalStatus}", __("models/users.marital_status.{$maritalStatus}"), ['class' => "custom-control-label text-{$maritalStatus}"]) !!}
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group text-center p-b-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">@lang('auth.register')</button>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            @lang('auth.registration.have_membership') <a href="{{ route('login') }}" class="text-info m-l-5"><b>@lang('auth.sign_in')</b></a>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection


@section('page-styles')
<!-- Date picker plugins css -->
<link href="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-scripts')
<!-- Date Picker Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
        $('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    })
</script>
@endsection