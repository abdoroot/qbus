@extends('admin.layouts.app')

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
                    {{-- <img src="{{ asset('images/admins/' . $admin->image) }}" class="img-circle" width="150" /> --}}
                    <h4 class="card-title m-t-10">{{ $admin->name }}</h4>
                    <h6 class="card-subtitle">@lang('msg.app_name') @lang('models/admins.singular')</h6>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                    </div>
                </center>
            </div>
            <div><hr></div>
            <div class="card-body"> 
                <small class="text-muted"> @lang('msg.email') </small>
                <h6>{{ $admin->email }}</h6> 
                <small class="text-muted p-t-30 db">@lang('msg.active')</small>
                <h6 class="mb-3">{!! $admin->active_span !!}</h6> 
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
                <li class="nav-item"> <a class="nav-link {{ !isset($active) || !in_array($active, ['settings', 'password']) || $active == 'profile' ? 'active' : '' }}" data-toggle="tab" href="#profile" role="tab">@lang('msg.profile')</a> </li>
                <li class="nav-item"> <a class="nav-link {{ $active == 'settings' ? 'active' : '' }}" data-toggle="tab" href="#settings" role="tab">@lang('msg.settings')</a> </li>
                <li class="nav-item"> <a class="nav-link {{ $active == 'password' ? 'active' : '' }}" data-toggle="tab" href="#password" role="tab">@lang('msg.password')</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!--Profile tab-->
                @include('admin.profile.profile_tab')
                
                <!-- Settings tab -->
                @include('admin.profile.settings_tab')
                
                <!-- Password tab -->
                @include('admin.profile.password_tab')
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
@endsection

