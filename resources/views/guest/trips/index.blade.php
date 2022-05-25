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
                    @foreach($paginator->items() as $trip)
                    {!! $trip->viewDiv('w-full md:w-1/2 xl:w-1/3 p-4', $query) !!}
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