@extends('auth.layout')

@section('title', __('auth.login.title'))

@section('id', 'Login')

@section('content')
    <div class="bg-white dark:bg-gray-900 mb-16">
        <div class="flex justify-center h-screen">
            <div class="hidden bg-cover lg:block lg:w-1/2" style="background-image: url(public/design/assets/img/38.jpg)">
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>
                        <h2 class="text-4xl font-bold text-white">@lang('msg.login_side_title')</h2>
                        <p class="max-w-xl mt-3 text-gray-300 text-xl">@lang('msg.login_side_text')</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-1/2">
                <div class="flex-1">
                    <div class="text-center">
                        <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">@lang('auth.login.title')</h2>
                        <p class="mt-3 text-gray-500 dark:text-gray-300 text-lg">@lang('auth.login.subtitle')</p>
                    </div>
                    <div class="mt-8">
                        {!! Form::open(['route' => 'provider.login', 'type' => 'post', 'id' => 'loginform']) !!}
                            <div>
                                <label for="username" class="block mb-2 text-lg text-gray-600 dark:text-gray-200">@lang('auth.username')</label>
                                <input type="tel"
                                    name="username"
                                    value="{{ old('username') }}"
                                    placeholder="@lang('auth.username')"
                                    class="@error('username') border-red-500 @enderror 
                                        block w-full px-4 py-4 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-lg ">

                                @error('username')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-lg text-gray-600 dark:text-gray-200">@lang('auth.password')</label>
                                    <a href="{{ route('provider.password.request') }}"
                                        class="text-lg text-gray-400 focus:text-blue-500 hover:text-blue-500 hover:underline"> @lang('auth.login.forgot_password')</a>
                                </div>
                                <input type="password"
                                    name="password"
                                    placeholder="@lang('auth.password')"
                                    class="@error('password') border-red-500 @enderror 
                                        block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-lg" />

                                @error('password')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-6">
                                <div class="form-check">
                                  <input type="checkbox" id="remember" name="remember" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer">
                                  <label for="remember" class="form-check-label inline-block text-base text-gray-600 dark:text-gray-200">
                                    @lang('auth.login.remember_me')
                                  </label>
                                </div>
                              </div>
                            <div class="mt-6">
                                <button
                                    class="text-lg w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    @lang('auth.sign_in')
                                </button>
                            </div>
                        {!! Form::close() !!}
                        <p class="mt-6 text-lg text-center text-gray-400">@lang('auth.login.register_membership') <a
                                href="{{ route('provider.register') }}"
                                class="text-blue-500 focus:outline-none focus:underline hover:underline">@lang('auth.sign_up')</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    