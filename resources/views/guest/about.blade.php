@extends('guest.layouts.app')

@section('title', __('msg.about'))

@section('id', 'About')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1
            class="text-3xl mb-4 font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">
            {{ $about_title }} <br /> <span class="text-blue-500 mt-4 inline-block">{{ $about_subtitle }}</span></h1>
    </div>
</section>
<!-- Features Section-->
<section class="Features bg-gray-100 dark:bg-gray-900 md:mt-10">
    <div class="container px-6 py-10 mx-auto">
        <div class="lg:flex lg:items-center">
            <div class="w-full space-y-12 lg:w-1/2 ">
                <div>
                    <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">
                        {!! $features_title !!}</h1>
                    <div class="mt-2">
                        <span class="inline-block w-40 h-1 rounded-full bg-blue-500"></span>
                        <span class="inline-block w-3 h-1 ml-1 rounded-full bg-blue-500"></span>
                        <span class="inline-block w-1 h-1 ml-1 rounded-full bg-blue-500"></span>
                    </div>
                </div>
                @foreach($features as $feature)
                <div class="md:flex md:items-start md:-mx-4">
                    <span class="inline-block p-2 text-blue-500 bg-blue-100 rounded-xl md:mx-4 dark:text-white dark:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path>
                        </svg>
                    </span>
                    <div class="mt-4 md:mx-4 md:mt-0">
                        <h1 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white">{{ $feature->title }}</h1>
                        <p class="mt-3 text-gray-500 dark:text-gray-300 text-lg">{{ $feature->text }} </p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="hidden lg:flex lg:items-center lg:w-1/2 lg:justify-center">
                <img class="w-[28rem] h-[28rem] object-cover xl:w-[34rem] xl:h-[34rem] rounded-full"
                    src="{{ $about_image }}" alt="">
            </div>
        </div>
    </div>
</section>
<!-- End Features -->
<div class="container mx-auto text-center my-20">
    <div class="text-xl">{!! $about_text !!}</div>
</div>
@endsection