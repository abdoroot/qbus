@extends('auth.layout')

@section('title', __('auth.registration.title'))

@section('id', 'Sign')

@section('content')
    <div class="flex items-center min-h-screen bg-gray-50 mb-8">
        <div class="flex-1 h-full mx-auto bg-white rounded-lg">
            <div class="flex flex-col md:flex-row">
                <div class="hidden bg-cover lg:block lg:w-1/2"
                    style="background-image: url(public/design/assets/img/40.jpg)">
                    <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                        <div>
                            <h2 class="text-4xl font-bold text-white">@lang('msg.provider_register_side_title')</h2>
                            <p class="max-w-xl mt-3 text-gray-300 text-xl">@lang('msg.provider_register_side_text')</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 lg:w-1/2">
                    <div class="w-full">
                        <h6 class="mb-4 text-sm">@lang('msg.step') 1/3</h6>
                        <h3 class="mb-4 text-xl font-bold text-blue-600">@lang('auth.registration.title')</h3>
                        <div class="flex flex-wrap mx-auto">
                            <a
                                class="inline-flex items-center justify-center w-1/2 py-3 font-medium leading-none tracking-wider text-indigo-500 bg-gray-100 border-b-2 border-indigo-500 rounded-t sm:px-6 sm:w-auto sm:justify-start">
                                @lang('models/providers.singular')
                            </a>
                            <a
                                class="inline-flex items-center justify-center w-1/2 py-3 font-medium leading-none tracking-wider border-b-2 border-gray-200 sm:px-6 sm:w-auto sm:justify-start hover:text-gray-900">
                                @lang('auth.provider.verify')
                            </a>
                            <a
                                class="inline-flex items-center justify-center w-1/2 py-3 font-medium leading-none tracking-wider border-b-2 border-gray-200 sm:px-6 sm:w-auto sm:justify-start hover:text-gray-900">
                                @lang('auth.provider.account')
                            </a>
                        </div>
                        <div class="mt-8">
                            {!! Form::open(['route' => 'provider.register', 'files' => 'on', 'type' => 'post', 'id' => 'registerform']) !!}
                                <div>
                                    <label for="name" class="w-full text-base text-gray-600 dark:text-gray-200">@lang('models/providers.fields.name')</label>
                                    <input type="text"
                                        name="name"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('name') border-red-500 @enderror"
                                        value="{{ old('name') }}"
                                        placeholder="@lang('models/providers.fields.name')">
    
                                    @error('name')
                                    <span class="error flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="mt-6">
                                    <label for="email" class="w-full text-base text-gray-600 dark:text-gray-200">@lang('models/providers.fields.email')</label>
                                    <input type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('email') border-red-500 @enderror"
                                        placeholder="@lang('models/providers.fields.email')">
    
                                    @error('email')
                                    <span class="error flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="mt-6">
                                    <label for="phone" class="w-full text-base text-gray-600 dark:text-gray-200">@lang('models/providers.fields.phone')</label>
                                    <input type="text"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('phone') border-red-500 @enderror"
                                        placeholder="@lang('models/providers.fields.phone')">
    
                                    @error('phone')
                                    <span class="error flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="mt-6">
                                    <label for="address" class="w-full text-base text-gray-600 dark:text-gray-200">@lang('models/providers.fields.address')</label>
                                    <input type="text"
                                        name="address"
                                        value="{{ old('address') }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('address') border-red-500 @enderror"
                                        placeholder="@lang('models/providers.fields.address')">
    
                                    @error('address')
                                    <span class="error flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="mt-6">
                                    <label for="comm_name" class="w-full text-base text-gray-600 dark:text-gray-200">@lang('models/providers.fields.comm_name')</label>
                                    <input type="text"
                                        name="comm_name"
                                        value="{{ old('comm_name') }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('comm_name') border-red-500 @enderror"
                                        placeholder="@lang('models/providers.fields.comm_name')">
    
                                    @error('comm_name')
                                    <span class="error flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="mt-6">
                                    <label for="comm_reg_num" class="w-full text-base text-gray-600 dark:text-gray-200">@lang('models/providers.fields.comm_reg_num')</label>
                                    <input type="text"
                                        name="comm_reg_num"
                                        value="{{ old('comm_reg_num') }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('comm_reg_num') border-red-500 @enderror"
                                        placeholder="@lang('models/providers.fields.comm_reg_num')">
    
                                    @error('comm_reg_num')
                                    <span class="error flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-6 flex flex-col items-center justify-center bg-grey-lighter">
                                    <label class="w-full text-lg text-gray-600 dark:text-gray-200">@lang('models/providers.fields.comm_reg_img')</label>
                                    <label
                                        class="@error('comm_reg_img') border-red-500 @enderror mt-3 w-full flex flex-col items-center p-2 bg-white text-blue rounded-lg  tracking-wide uppercase border border-blue cursor-pointer ">
                                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                        </svg>
                                        {{-- <span class="mt-2 text-base leading-normal">@lang('msg.updoad_file')</span> --}}
                                        <input name="comm_reg_img" type='file' class="hidden" />
                                    </label>
                                    @error('comm_reg_img')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"> {{ $message }} </span>
                                    @enderror
                                </div>
        
                                <div class="mt-6">
                                    <label for="tax_cert_num" class="w-full text-base text-gray-600 dark:text-gray-200">@lang('models/providers.fields.tax_cert_num')</label>
                                    <input type="text"
                                        name="tax_cert_num"
                                        value="{{ old('tax_cert_num') }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                            @error('tax_cert_num') border-red-500 @enderror"
                                        placeholder="@lang('models/providers.fields.tax_cert_num')">
    
                                    @error('tax_cert_num')
                                    <span class="error flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <h4 class="mt-6 text-base text-gray-600 dark:text-gray-200">@lang('models/providers.tabs.cities_title')</h4>
                                <h5 class="text-sm text-gray-600 dark:text-gray-200">@lang('models/providers.tabs.cities_subtitle')</h5>
                                <div class="mt-3">
                                    {!! Form::select('cities[]', $cities, [], ['multiple' => true, 'class' => 'block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 text-base 
                                        select2 ' . ($errors->has('cities') ? ' border-red-500' : ''),'id'=>'cities']) !!}
                                    @error('cities')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="mt-6">
                                    <button
                                        class="text-base w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                        @lang('auth.register')</button>
                                </div>
                            {!! Form::close() !!}
                            <p class="mt-6 text-base text-center text-gray-400"> @lang('auth.registration.have_membership')  
                                <a href="{{ route('provider.login') }}"
                                class="text-blue-500 focus:outline-none focus:underline hover:underline">@lang('auth.sign_in')</a>.
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