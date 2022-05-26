@extends('guest.layouts.app')

@section('content')
<div class="row">
    <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
        <div class="w-full md:w-1/4 min-h-screen py-8 border-r"><div class="flex flex-col items-center mt-6 -mx-2">
                <img class="object-cover w-24 h-24 mx-2 rounded-full" src="{{ is_file(asset('images/users/' . $user->image)) ? asset('images/users/' . $user->image):asset('images/users/default-user-image.png') }}" alt="avatar">
                <h4 class="mx-2 mt-2 font-medium text-gray-800 dark:text-gray-200 hover:underline">{{ $user->name }}</h4>
                <p class="mx-2 mt-1 text-sm font-medium text-gray-600 dark:text-gray-400 hover:underline">  {{ $user->phone }}</p>
            </div>

            @php $page = "profile.index"; @endphp
            @include('user.profile.menu')
        </div>
        <div class="w-full md:w-3/4 p-4 md:p-8">
            <div class="profileTap">
                <h2 class="font-bold">My profile</h2><div class="mt-6 ">
                    @include('flash::message')
                    <div class="items-center -mx-2 md:flex mb-4 md:mb-16">
                        <div class="w-full mx-2">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">Name</label>
                            <p>{{ $user->name }}</p></div>
                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">E-mail</label>
                            <p>{{ $user->email }}</p></div>
                    </div>
                    <div class="items-center -mx-2 md:flex mb-4 md:mb-16">

                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">Phone</label>
                            <p>{{ $user->phone }}</p></div>

                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">address</label>
                            <p>{{ $user->address }}</p></div>

                    </div>

                    <div class="items-center -mx-2 md:flex mb-4 md:mb-16">

                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">age</label>
                            <p>{{ Carbon\Carbon::parse($user->date_of_birth)->diff(Carbon\Carbon::now())->format('%y years') }}</p></div>

                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">Marital status</label>
                            <p>{{ __('models/users.marital_status.'.$user->marital_status) }}</p></div>

                    </div>



                </div>
            </div>
        </div></div>
</div>

<div class="row">
    @include('flash::message')
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">


        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link {{ !isset($active) || is_null($active) || $active == 'profile' ? 'active' : '' }}" data-toggle="tab" href="#profile" role="tab">@lang('msg.profile')</a> </li>
                <li class="nav-item"> <a class="nav-link {{ $active == 'settings' ? 'active' : '' }}" data-toggle="tab" href="#settings" role="tab">@lang('msg.settings')</a> </li>
                <li class="nav-item"> <a class="nav-link {{ $active == 'password' ? 'active' : '' }}" data-toggle="tab" href="#password" role="tab">@lang('msg.password')</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!--Profile tab-->


                <!-- Settings tab -->


                <!-- Password tab -->
                @include('user.profile.password_tab')
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
@endsection

