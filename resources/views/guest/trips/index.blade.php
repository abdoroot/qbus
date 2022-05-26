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
                        @include('guest.trips.filter')
                    </div>
                </div>
            </div>
            <div class="w-full md:w-2/3 xl:w-3/4">
                <div class="row flex items-start justify-center flex-wrap">
                    @if(Session::has('trip'))
                    <span class="w-full items-center text-base tracking-wide bg-blue-300 my-10 p-3">
                        {{ Session::get('trip') }}
                    </span>
                    @endif
                    
                    @if(count($paginator->items()) == 0)
                        <h1 class="w-full items-center text-xl tracking-wide text-indiago-500 mt-20 p-3 text-center">
                            @lang('msg.no_items_found')
                        </h1>
                        
                        @if($type == 'multi')
                        <a href="{{ Request::fullUrl() . '&skip='.(Request::get('skip')+1) }}" class="w-full items-center text-base tracking-wide text-blue-500 mb-3 mt-5 text-center">
                            @lang('msg.skip_to_the_next_trip_search')
                        </a>

                        <div>
                            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">
                                </h1>
                            <div class="mt-2">
                                <span class="inline-block w-10 h-1 rounded-full bg-gray-800"></span>
                                <span class="inline-block mx-2 text-gray-800 text-xl">@lang('msg.or')</span>
                                <span class="inline-block w-10 h-1 rounded-full bg-gray-800"></span>
                            </div>
                        </div>
                        @endif
                        
                        <a href="{{ Request::url() }}" class="w-full items-center text-base tracking-wide text-blue-500 mt-5 p-3 text-center">
                            @lang('msg.reset_search_fields')
                        </a>
                    @endif

                    @foreach($paginator->items() as $trip)
                    {!! $trip->viewDiv('w-full md:w-1/2 xl:w-1/3 p-4', $query = substr($url = Request::fullUrl(), strpos($url, '?') + 1)) !!}
                    @endforeach
                    @if($paginator->lastPage() > 1)
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection