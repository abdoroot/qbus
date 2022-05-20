@extends('auth.layout')

@section('title', __('auth.confirm_passwords.title'))

@section('id', 'Forget')

@section('content')
<div class="w-full max-w-sm p-6 m-auto bg-white rounded-md dark:bg-gray-800 my-32">
    @include('guest.layouts.flash')
    <h1 class="text-xl font-semibold text-center text-gray-700 dark:text-white">@lang('auth.confirm_passwords.title')</h1>
    {!! Form::open(['route' => 'password.email', 'type' => 'post', 'class' => 'mt-10']) !!}
        <div>
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
        <div class="mt-6">
            <button
                class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 text-lg">
                @lang('auth.confirm_passwords.send_pwd_confirm') </button>
        </div>
    {!! Form::close() !!}
    <p class="mt-6 text-lg text-center text-gray-400">
        <a href="{{ route('password.request') }}"
        class="text-blue-500 focus:outline-none focus:underline hover:underline">@lang('auth.login.forgot_password')</a>
    </p>
</div>
@endsection