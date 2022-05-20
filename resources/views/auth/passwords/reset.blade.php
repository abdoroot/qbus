@extends('auth.layout')

@section('title', __('auth.reset_password.title'))

@section('id', 'Forget')

@section('content')
<div class="bg-white dark:bg-gray-900 mb-16">
    <div class="flex justify-center h-screen">
        <div class="hidden bg-cover lg:block lg:w-1/2" style="background-image: url(public/design/assets/img/38.jpg)">
            <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                <div>
                    <h2 class="text-4xl font-bold text-white">@lang('msg.reset_password_side_title')</h2>
                    <p class="max-w-xl mt-3 text-gray-300 text-xl">@lang('msg.reset_password_side_text')</p>
                </div>
            </div>
        </div>
        <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-1/2">
            <div class="w-full max-w-sm p-6 m-auto bg-white rounded-md dark:bg-gray-800 my-32">
                @include('guest.layouts.flash')
                <h1 class="text-xl font-semibold text-center text-gray-700 dark:text-white">@lang('auth.reset_password.title')</h1>
                {!! Form::open(['route' => 'password.update', 'type' => 'post', 'class' => 'mt-10']) !!}
                <input type="hidden" name="token" value="{{ $token }}">
                    <div>
                        {!! Form::label('email', __('auth.email'), ['class' => 'block text-lg text-gray-800 dark:text-gray-200']) !!}
                        <input type="email"
                            name="email"
                            value="{{ $email ?? old('email') }}"
                            class="@error('email') border-red-500 @enderror 
                                text-lg block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                            placeholder="@lang('auth.email')">

                        @error('email')
                        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-5">
                        {!! Form::label('password', __('auth.password'), ['class' => 'block text-lg text-gray-800 dark:text-gray-200']) !!}
                        <input type="password"
                            name="password"
                            class="@error('password') border-red-500 @enderror 
                                text-lg block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                            placeholder="@lang('auth.password')">

                        @error('password')
                        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-5">
                        {!! Form::label('password_confirmation', __('auth.confirm_password'), ['class' => 'block text-lg text-gray-800 dark:text-gray-200']) !!}
                        <input type="password"
                            name="password_confirmation"
                            class="@error('password_confirmation') border-red-500 @enderror 
                                text-lg block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                            placeholder="@lang('auth.confirm_password')">
                    </div>
                    <div class="mt-6">
                        <button
                            class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 text-lg">
                            @lang('auth.reset_password.reset_pwd_btn') </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection