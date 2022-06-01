@extends('guest.layouts.app')

@section('content')
<div class="row">
    <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
        <div class="w-full md:w-1/4 min-h-screen py-8 border-r">

            @php $page = "profile.index"; @endphp
            @include('user.profile.menu')
        </div>
        <div class="w-full md:w-3/4 p-4 md:p-8">
            <div class="profileTap">
                <h2 class="font-bold">@lang('msg.profile')</h2><div class="mt-6 ">
                    @include('flash::message')
                    <div class="items-center -mx-2 md:flex mb-4 md:mb-16">
                        <div class="w-full mx-2">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('msg.name')</label>
                            <p>{{ $user->name }}</p></div>
                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('msg.email')</label>
                            <p>{{ $user->email }}</p></div>
                    </div>
                    <div class="items-center -mx-2 md:flex mb-4 md:mb-16">

                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('msg.phone')</label>
                            <p>{{ $user->phone }}</p></div>

                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('msg.address')</label>
                            <p>{{ $user->address }}</p></div>

                    </div>

                    <div class="items-center -mx-2 md:flex mb-4 md:mb-16">

                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('msg.age')</label>
                            <p>{{ Carbon\Carbon::parse($user->date_of_birth)->diff(Carbon\Carbon::now())->format('%y years') }}</p></div>

                        <div class="w-full mx-2 mt-4 md:mt-0">
                            <label class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('msg.marital_status')</label>
                            <p>{{ __('models/users.marital_status.'.$user->marital_status) }}</p></div>

                    </div>



                </div>
            </div>
        </div></div>
</div>

<!-- Row -->
@endsection

