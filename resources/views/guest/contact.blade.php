@extends('guest.layouts.app')

@section('title', __('msg.contact'))

@section('id', 'Contact')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1
            class="text-3xl mb-4 font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">
            {{ $contact_title }} <br /> <span class="text-blue-500 mt-4 inline-block">{{ $contact_subtitle }}</span></h1>
        <div class="row flex items-center justify-center">
            <div class="flex w-full md:w-2/3">
                <section class="w-full max-w-2xl px-6 py-4 mx-auto bg-white ">
                    <div class="mt-6 ">
                        {!! Form::open(['route' => 'contacts.store', 'method' => 'POST']) !!}
                        @if(Session::has('contact'))
                        <span class="flex items-center text-lg tracking-wide text-green-500 text-xs mt-1 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            {{ Session::get('contact') }}
                        </span>
                        @endif
                        <div class="items-center -mx-2 md:flex mb-6">
                            <div class="w-full mx-2">
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('models/contacts.fields.name')</label>
                                <input
                                    class="{{ $errors->has('name') ? 'border-red-500' : '' }} block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                                    value="{{ old('name') }}"
                                    name="name"
                                    type="text">

                                @error('name')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="w-full mx-2 mt-4 md:mt-0">
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('models/contacts.fields.email')</label>
                                <input
                                    class="{{ $errors->has('email') ? 'border-red-500' : '' }} block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                                    value="{{ old('email') }}"
                                    name="email"
                                    type="email">

                                @error('email')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="items-center -mx-2 md:flex mb-6">
                            <div class="w-full mx-2">
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('models/contacts.fields.subject')</label>
                                <input
                                    class="{{ $errors->has('subject') ? 'border-red-500' : '' }} block w-full px-4 py-4 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                                    value="{{ old('subject') }}"
                                    name="subject"
                                    type="text">

                                @error('subject')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full mt-4">
                            <label
                                class="block mb-2 text-lg font-medium text-gray-600 dark:text-gray-200">@lang('models/contacts.fields.message')</label>
                            <textarea
                                class="{{ $errors->has('message') ? 'border-red-500' : '' }} block w-full h-40 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                                value="{{ old('message') }}"
                                name="message"
                                ></textarea>
                            
                            @error('message')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="flex justify-center mt-6">
                            <button
                                class="px-4 text-lg py-2 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                                @lang('msg.send_message')
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </section>
            </div>
            <div class="flex flex-wrap justify-center flex-col w-full md:w-1/3">
                <div
                    class="flex flex-col items-center p-6 my-6 w-full mx-auto space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                    <span
                        class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </span>
                    <h1 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white">@lang('models/settings.keys.email')</h1>
                    <p class="text-gray-500 dark:text-gray-300 text-lg">{{ $app_email }}</p>
                </div>
                <div
                    class="flex flex-col items-center p-6 my-6 w-full mx-auto space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                    <span
                        class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                    </span>
                    <h1 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white">@lang('models/settings.keys.phone')</h1>
                    <p class="text-gray-500 dark:text-gray-300 text-lg"> {{ $app_phone }} </p>
                </div>
                <div
                    class="flex flex-col items-center p-6 my-6 w-full mx-auto space-y-3 text-center bg-gray-100 rounded-xl dark:bg-gray-800">
                    <span
                        class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                    <h1 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white">@lang('models/settings.keys.location')</h1>
                    <p class="text-gray-500 dark:text-gray-300 text-lg">{{ $app_location }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection