@extends('auth.layout')

@section('title', __('auth.verify'))

@section('id', 'Sign')

@section('content')
    <div class="flex items-center min-h-screen bg-gray-50 mb-8">
        <div class="flex-1 h-full mx-auto bg-white rounded-lg">
            <div class="flex flex-col md:flex-row">
                <div class="hidden bg-cover lg:block lg:w-1/2"
                    style="background-image: url(public/design/assets/img/40.jpg)">
                    <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                        <div>
                            <h2 class="text-4xl font-bold text-white">@lang('msg.provider_verification_side_title')</h2>
                            <p class="max-w-xl mt-3 text-gray-300 text-xl">@lang('msg.provider_verification_side_text')</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 lg:w-1/2">
                    <div class="w-full">
                        @include('guest.layouts.flash')
                        <h6 class="mb-4 text-sm">@lang('msg.step') 2/3</h6>
                        <h3 class="mb-4 text-xl font-bold text-blue-600">@lang('auth.verify_phone.title')</h3>
                        <div class="flex flex-wrap mx-auto">
                            <a
                                class="inline-flex items-center justify-center w-1/2 py-3 font-medium leading-none tracking-wider border-b-2 border-gray-200 sm:px-6 sm:w-auto sm:justify-start hover:text-gray-900">
                                @lang('models/providers.singular')
                            </a>
                            <a
                                class="inline-flex items-center justify-center w-1/2 py-3 font-medium leading-none tracking-wider text-indigo-500 bg-gray-100 border-b-2 border-indigo-500 rounded-t sm:px-6 sm:w-auto sm:justify-start">
                                @lang('auth.provider.verify')
                            </a>
                            <a
                                class="inline-flex items-center justify-center w-1/2 py-3 font-medium leading-none tracking-wider border-b-2 border-gray-200 sm:px-6 sm:w-auto sm:justify-start hover:text-gray-900">
                                @lang('auth.provider.account')
                            </a>
                        </div>
                        <div class="mt-8">
                            {!! Form::open(['route' => ['provider.verification.verify', $provider->id], 'type' => 'post', 'id' => 'registerform']) !!}
                                <div>
                                    <input type="text"
                                        name="code"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('code') border-red-500 @enderror"
                                        value="{{ old('code') }}"
                                        placeholder="@lang('auth.verify_phone.input')">
    
                                    @error('code')
                                    <span class="error flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-6">
                                    <button
                                        class="text-base w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                        @lang('crud.confirm')</button>
                                </div>
                            {!! Form::close() !!}
                            {!! Form::open(['route' => ['provider.verification.resend', ['id' => $provider->id]], 'id' => 'resend-form']) !!}
                            {!! Form::close() !!}
                            <p class="mt-6 text-base text-center text-gray-400">
                                <a href="javascript:;" onclick="document.getElementById('resend-form').submit();"
                                class="text-blue-500 focus:outline-none focus:underline hover:underline">@lang('auth.verify_phone.another_req')</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-styles')
<!-- Select2 plugins css -->
<link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('page-scripts')
<!-- Select2 Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
    $('.select2').select2();
</script>
@endsection