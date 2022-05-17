@extends('provider.layouts.app')

@section('title', __('msg.profile'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('msg.profile')</li>
@endsection

@section('content')
<div class="row">
    @include('flash::message')
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> 
                    <img src="{{ asset('images/providers/' . $provider->image) }}" class="img-circle" width="150" />
                    <h4 class="card-title m-t-10">{{ $provider->name }}</h4>
                    <h6 class="card-subtitle"><i class="icon-user"></i> {{ $account->username }}</h6>
                </center>
            </div>
            <div>
                <hr> </div>
            <div class="card-body"> 
                <small class="text-muted"> @lang('models/providers.singular') </small>
                <h6>{{ $provider->name }}</h6> 
                <small class="text-muted"> @lang('models/providers.fields.email') </small>
                <h6>{{ $provider->email }}</h6> 
                <small class="text-muted"> @lang('models/providers.fields.phone') </small>
                <h6>{{ $provider->phone }}</h6> 
                <small class="text-muted"> @lang('models/providers.fields.address') </small>
                <h6>{{ $provider->address }}</h6> 
                <small class="text-muted p-t-30 db">@lang('models/providers.fields.approve')</small>
                <h6 class="mb-3">{!! $provider->approve_span !!}</h6> 
                <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link {{ !isset($active) || is_null($active) || $active == 'profile' ? 'active' : '' }}" data-toggle="tab" href="#profile" role="tab">@lang('msg.profile')</a> </li>
                {{-- <li class="nav-item"> <a class="nav-link {{ $active == 'settings' ? 'active' : '' }}" data-toggle="tab" href="#settings" role="tab">@lang('msg.settings')</a> </li> --}}
                <li class="nav-item"> <a class="nav-link {{ $active == 'account' ? 'active' : '' }}" data-toggle="tab" href="#account" role="tab">@lang('msg.account')</a> </li>
                <li class="nav-item"> <a class="nav-link {{ $active == 'password' ? 'active' : '' }}" data-toggle="tab" href="#password" role="tab">@lang('msg.password')</a> </li>
                @if(Auth::guard('provider')->user()->role == 'admin')
                <li class="nav-item"> <a class="nav-link {{ $active == 'cities' ? 'active' : '' }}" data-toggle="tab" href="#cities" role="tab">@lang('models/providers.fields.cities')</a> </li>
                @endif
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!--Profile tab-->
                @include('provider.profile.profile_tab')
                
                <!-- Settings tab -->
                {{-- @ include('provider.profile.settings_tab') --}}
                
                <!-- Account tab -->
                @include('provider.profile.account_tab')
                
                <!-- Password tab -->
                @include('provider.profile.password_tab')
                
                @if(Auth::guard('provider')->user()->role == 'admin')
                <!-- Cities tab -->
                @include('provider.profile.cities_tab')
                @endif
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
@endsection

