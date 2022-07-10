@extends('auth.layout')

@section('title', __('auth.forgot_password.title'))

@section('id', 'Forget')

@section('content')
<div class="bg-white dark:bg-gray-900 mb-16">
    <div class="flex justify-center h-screen">
        <div class="hidden bg-cover lg:block lg:w-1/2" style="background-image: url(public/design/assets/img/38.jpg)">
            <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                <div>
                    <h2 class="text-4xl font-bold text-white">@lang('msg.forgot_password_side_title')</h2>
                    <p class="max-w-xl mt-3 text-gray-300 text-xl">@lang('msg.forgot_password_side_text')</p>
                </div>
            </div>
        </div>
        <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-1/2">
            <div class="w-full max-w-sm p-6 m-auto bg-white rounded-md dark:bg-gray-800 my-32">
                @include('guest.layouts.flash')
                <h1 class="text-xl font-semibold text-center text-gray-700 dark:text-white">@lang('auth.forgot_password.phone_title')</h1>
                {!! Form::open(['route' => 'password.phone', 'type' => 'post', 'class' => 'mt-10']) !!}
                    <div>
                        <input type="text"
                            name="phone"
                            class="@error('phone') border-red-500 @enderror 
                                text-lg block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                            placeholder="@lang('auth.phone')">

                        @error('phone')
                        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <button
                            class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 text-lg">
                            @lang('auth.forgot_password.send_pwd_phone_reset') </button>
                    </div>
                {!! Form::close() !!}
                <div class="flex items-center justify-between my-12">
                    <span class="w-1/5 border-b dark:border-gray-600 lg:w-1/5"></span>
                    <a href="#"
                        class="text-xs text-center text-gray-500 uppercase dark:text-gray-400 hover:underline">or</a>
                    <span class="w-1/5 border-b dark:border-gray-400 lg:w-1/5"></span>
                </div>
                <p class="mt-5 text-base text-center text-gray-400"><a href="{{ route('password.request') }}"
                    class="text-blue-500 focus:outline-none focus:underline hover:underline">@lang('msg.reset_password_by_email')</a>.
                </p>
                <p class="mt-6 text-base text-center text-gray-400"><a href="{{ route('login') }}"
                    class="text-blue-500 focus:outline-none focus:underline hover:underline">@lang('auth.sign_in')</a>.
                </p>
                <p class="mt-3 text-lg text-center text-gray-400">@lang('auth.login.register_membership') <a
                    href="{{ route('register') }}"
                    class="text-blue-500 focus:outline-none focus:underline hover:underline">@lang('auth.sign_up')</a>.</p>
            </div>
        </div>
    </div>
</div>
@endsection