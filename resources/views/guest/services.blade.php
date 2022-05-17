@extends('guest.layouts.app')

@section('title', __('msg.services'))

@section('id', 'Services')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1
            class="text-3xl mb-4 font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">
            {{ $services_title }} <br /> <span class="text-blue-500 mt-4 inline-block">{{ $services_subtitle }}</span></h1>
    </div>
</section>
<section class="allServices my-8">
    <div class="container mx-auto">
        @foreach ($services as $i => $service)            
        <div class="row flex justify-center items-center flex-wrap mb-8 md:mb-0">
            <div class="w-full md:w-1/2"><img class="serviceImg min-w-full object-cover" src="{{ asset('images/services/'.$service->image) }}"
                    alt=""></div>
            <div class="w-full md:w-1/2 p-4 md:p-8">
                <h3 class="text-gray-700 text-2xl">{{ $service->title }}</h3>
                <div class="mt-2">
                    <label class="text-gray-700 text-xl font-bold mt-6">{{ __('models/services.fields.text') }}:</label>
                    <div class="flex items-center mt-1">
                        <p class="text-lg text-gray-500">{{ $service->text }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection