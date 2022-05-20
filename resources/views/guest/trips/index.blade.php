@extends('guest.layouts.app')

@section('title', __('msg.trips'))

@section('id', 'triples')

@section('content')
<main class="my-8">
    <div class="container mx-auto">
        <div class="md:flex md:items-start">
            <div class="w-full md:w-1/3 xl:w-1/4">
                <div class="tripleFilter p-4 md:p-0 md:pr-4">
                    <div class="text-lg">
                        {!! Form::open(['route' => 'trips.index', 'method' => 'GET']) !!}
                        <div class="mt-4">
                            <label class="text-gray-700 dark:text-gray-200 font-bold"
                                for="search">@lang('msg.search'):</label>
                            <input id="search" type="text" name="search" value="{{ $search }}"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md"
                                placeholder="@lang('msg.type_your_search_keword')">
                        </div>
                        <h3 class="text-gray-700 dark:text-gray-200 mt-6 font-bold block md:hidden openFilter">
                            @lang('msg.filter_options') <img class="float-right w-8" src="{{ asset('design/assets/img/filter.svg') }}"></h3>
                        <div class="filter">
                            <h3 class="text-gray-700 dark:text-gray-200 mt-6 font-bold">@lang('msg.trip_features'):</h3>
                            <div class="flex items-center mt-4">
                                <div class="mt-4 w-1/2">
                                    <label class="text-gray-700 dark:text-gray-200 font-bold"
                                        for="dateFrom">@lang('models/trips.fields.date_from')</label>
                                    <input id="dateFrom" type="date" name="date_from" value="{{ $date_from }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md">
                                </div>
                                <div class="mt-4 w-1/2">
                                    <label class="text-gray-700 dark:text-gray-200 font-bold"
                                        for="dateTo">@lang('models/trips.fields.date_to')</label>
                                    <input id="dateTo" type="date" name="date_to" value="{{ $date_to }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md">
                                </div>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="mt-4 w-1/2">
                                    <label class="text-gray-700 dark:text-gray-200 font-bold"
                                        for="timeFrom">@lang('models/trips.fields.time_from')</label>
                                    <input id="timeFrom" type="time" name="time_from" value="{{ $time_from }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md">
                                </div>
                                <div class="mt-4 w-1/2">
                                    <label class="text-gray-700 dark:text-gray-200 font-bold"
                                        for="timeTo">@lang('models/trips.fields.time_to')</label>
                                    <input id="timeTo" type="time" name="time_to" value="{{ $time_to }}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md">
                                </div>
                            </div>
                            {{-- @foreach(['one-way','round','multi'] as $t)
                            <div class="mt-4 flex items-start justify-start">
                                <input id="type-{{ $t }}" type="radio" name="type" value="{{ $t }}" @if($t == $type) checked @endif
                                    class="px-4 py-2  mt-2 text-gray-700 bg-white border border-gray-200 rounded-md">
                                <label class="text-gray-700 dark:text-gray-200 ml-4" for="type-{{ $t }}">@lang('models/trips.types.'.$t)</label>
                            </div>
                            @endforeach --}}
                            <div class="mt-4">
                                <label class="text-gray-700 dark:text-gray-200 font-bold" for="city">@lang('models/cities.singular')</label>
                                {!! Form::select('city_id', $cities, $city_id, [
                                    'placeholder' => __('msg.select'),
                                    'class' => 'block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring']) !!}
                            </div>
                            @foreach($additionals as $addition)
                            <div class="mt-4 flex items-start justify-start">
                                <input id="additional-{{ $addition->id }}" type="checkbox" 
                                    name="additional[]" @if(in_array($addition->id, $additional)) checked @endif
                                    class="px-4 py-2  mt-2 text-gray-700 bg-white border border-gray-200 rounded-md" value="{{ $addition->id }}">
                                <label class="text-gray-700 dark:text-gray-200 ml-4" for="additional-{{ $addition->id }}">
                                    {{ $addition->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="w-full">
                            <div class="flex text-lg items-center mx-auto justify-center mt-8">
                                <button 
                                    class="w-full px-5 py-2 font-semibold text-gray-100 transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-gray-700 text-lg">
                                    @lang('msg.search')
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="w-full md:w-2/3 xl:w-3/4">
                <div class="row flex items-start justify-center flex-wrap">
                    @foreach($paginator->items() as $trip)
                    {!! $trip->viewDiv('w-full md:w-1/2 xl:w-1/3 p-4') !!}
                    @endforeach
                    <div class="w-full">
                        <div class="Pagination flex text-lg items-center mx-auto justify-center mt-8">
                            <a href="{{ $paginator->onFirstPage() ? 'javascript:;' : $paginator->previousPageUrl().$query }}"
                                class="flex items-center px-4 py-2 mx-1 bg-white rounded-md {{ $paginator->onFirstPage() ? ' text-gray-500 cursor-not-allowed dark:bg-gray-900 dark:text-gray-600' : ' text-gray-700 transition-colors duration-200 transform ' }}">
                                @lang('pagination.previous')</a>
                            @for($page = 1; $page <= $paginator->lastPage(); $page++)
                            <a href="{{ $paginator->url($page) . $query }}"
                                class="{{ $paginator->currentPage() == $page ? 'active' : null }} text-white items-center hidden px-4 py-2 mx-1 text-gray-700 transition-colors duration-200 transform bg-white rounded-md sm:flex">
                                {{ $page }}
                            </a>
                            @endfor
                            <a href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl().$query : 'javascript:;' }}"
                                class="flex items-center px-4 py-2 mx-1 bg-white rounded-md {{ $paginator->hasMorePages() ? ' text-gray-700 transition-colors duration-200 transform ' : ' text-gray-500 cursor-not-allowed dark:bg-gray-900 dark:text-gray-600' }}">
                                @lang('pagination.next')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection