@extends('guest.layouts.app')

@section('title', $trip->name)

@section('id', 'triple')

@section('content')
<main class="my-8">
    <div class="container mx-auto px-6">
        <div class="md:flex md:items-start">
            <div class="w-full md:w-1/2">
                <div class="tripleImage h-96"> 
                    <img class="w-full h-full object-cover" src="{{ asset('images/trips/'.$trip->image) }}" alt="">
                </div>
            </div>
            <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                <h3 class="text-gray-700 text-2xl">{{ $trip->name }}</h3>
                <div class="flex mt-2 item-center">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 text-gray-{{ $check = $i <= $trip->rate ? '700' : '500' }} fill-current {{ $check ? 'dark:text-gray-300' : null }}"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                    </svg>
                    @endfor
                </div>
                <span class="text-gray-500 text-xl font-bold mt-6 block">
                    <label class="text-gray-700 text-xl font-bold" for="count">@lang('models/trips.fields.type'):</label>
                    @lang('models/trips.types.'.$trip->type)
                </span>
                <span class="text-gray-500 text-xl font-bold mt-6 block">{{ __('msg.trip_starts_on') }} {{ Carbon\Carbon::parse($trip->date_from)->format('d M Y') }}</span>
                <span class="text-gray-500 text-xl font-bold mt-6 block w-full">
                    SAR {{ $trip->fees }} 
                    <span class="float-right text-blue-700"> {{ $trip->available }} @lang('msg.seats_only') </span> 
                </span>
                <hr class="my-3">
                <div class="mt-2">
                    <label class="text-gray-700 text-xl font-bold" for="count">@lang('models/tripOrders.fields.count'):</label>
                    <div class="block w-full items-center mt-1">
                        {!! Form::open(['route' => 'tripOrders.store', 'id' => 'order-form']) !!}
                        {!! Form::hidden('trip_id', $trip->id) !!}
                        {!! Form::hidden('count', 1, ['id' => 'count-input']) !!}
                        <button type="button" class="text-gray-500 focus:outline-none focus:text-gray-600 mt-2" id="increase-count">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                        <span class="text-gray-700 text-lg mx-2 mt-2" id="count-span">1</span>
                        <button type="button" class="text-gray-500 focus:outline-none focus:text-gray-600 mt-2" id="decrease-count">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                        <div class="flex mt-5">
                            <button
                                class="px-8 py-2 bg-indigo-600 text-white text-xl font-bold  font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">
                                @lang('msg.order_now')
                            </button>
                            <button type="button"
                                class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row flex items-start justify-center mt-16 flex-wrap">
            <div class="w-full md:w-2/3">
                <div class="tripleDetails">
                    <div class="mt-2">
                        <label class="text-gray-700 text-xl font-bold mt-6">@lang('models/trips.fields.description'):</label>
                        <div class="flex items-center mt-1">
                            <p class="text-lg text-gray-500">{{ $trip->description }}</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="text-gray-700 text-xl font-bold">@lang('models/trips.destination'):</label>
                        <ul class="text-gray-700 text-left relative overflow-hidden">
                            @foreach($trip->tripCities as $i => $tripCity)
                            <li class="text-lg relative overflow-hidden pl-12 my-4"><span
                                    class="absolute w-8 h-8 bg-blue-700 left-0 top-2 text-center text-white rounded-full">{{ $i+1 }}</span>
                                <div class="mt-2">
                                    <label class="text-gray-700 text-xl font-bold mt-6">{{ !is_null($city = $tripCity->city) ? $city->name : '-' }}</label>
                                    <div class="flex items-center mt-1">
                                        <p class="text-lg text-gray-500">{{ $tripCity->description }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-6 text-left">
                        <label class="text-gray-700 text-xl font-bold mt-6">Locaion:</label>
                        <div class="flex items-center flex-wrap justify-start mt-1">
                            <iframe width="100%" height="500" id="gmap_canvas"
                                src="https://maps.google.com/maps?q=Dubai&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0"
                                marginwidth="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="w-full mx-auto border rounded-lg md:mx-4 text-xl">
                    <div class="p-6">
                        <h1 class="text-xl font-medium text-gray-700 capitalize lg:text-2xl dark:text-white">
                            @lang('models/trips.datetime')</h1>
                        <p class="mt-4 text-gray-500 dark:text-gray-300">
                            <strong>@lang('models/trips.fields.date_to'): {{ Carbon\Carbon::parse($trip->date_to)->format('d M Y') }}</strong>
                            <span class="block mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ Carbon\Carbon::parse($trip->time_from)->format('h:i A') . ' - ' . Carbon\Carbon::parse($trip->time_to)->format('h:i A') }}
                            </span>
                        </p>
                    </div>
                    <hr class="border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h1 class="text-lg font-medium text-gray-700 capitalize lg:text-xl dark:text-white">
                            @lang('models/trips.features')</h1>
                        <div class="mt-8 space-y-4">
                            @foreach(['meal', 'hotel'] as $feature)
                            <div class="flex items-center">
                                @if($trip->$feature)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                @endif
                                <span class="mx-4 text-gray-700 dark:text-gray-300">@lang('models/trips.fields.'.$feature)</span>
                            </div>
                            @endforeach
                            <button type="button" onclick="document.getElementById('order-form').submit()"
                                class="px-8 py-2 bg-indigo-600 text-white text-xl font-bold block font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500 w-full">
                                @lang('msg.order_now')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-16">
            <h3 class="text-gray-600 text-2xl font-medium">@lang('msg.more_trips')</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach($moreTrips as $mTrip)
                {!! $mTrip->viewDiv('max-w-sm mx-auto lg:w-full overflow-hidden bg-white') !!}
                {{-- <div class="max-w-sm mx-auto lg:w-full overflow-hidden bg-white">
                    <div class="imgItem h-72 rounded-lg overflow-hidden">
                        <img class="object-cover object-center min-w-full  h-full" 
                            src="{{ asset('images/trips/'.$mTrip->image) }}"
                            alt="">
                    </div>
                    <div class="flex items-center px-2 py-3 bg-gray-900">
                        <h1 class="mx-3 text-lg font-semibold text-white">{{ $mTrip->name }}</h1>
                    </div>
                    <div class="px-2 py-4">
                        <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                            {{ !is_null($provider = $trip->provider) ? $provider->name : '' }}
                        </h1>
                        <div class="flex mt-2 item-center">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 text-gray-{{ $check = $i <= $trip->rate ? '700' : '500' }} fill-current {{ $check ? 'dark:text-gray-300' : null }}"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                            </svg>
                            @endfor
                        </div>
                        <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 11H10V13H14V11Z" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z" />
                            </svg>
                            <h1 class="px-2 text-lg">Meraki UI</h1>
                        </div>
                        <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                            </svg>
                            <h1 class="px-2 text-lg">California</h1>
                        </div>
                        <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" />
                            </svg>
                            <h1 class="px-2 text-lg">patterson@example.com</h1>
                        </div>
                    </div>
                </div> --}}
                @endforeach
            </div>
        </div>
        <div class="mb-2 mt-16 row flex flex-wrap justify-start overflow-hidden">
            <h1 class="text-3xl w-full font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">
                @lang('models/reviews.plural')
            </h1>
            @foreach($reviews as $review)
            <div
                class="my-2 shadow-lg rounded-t-8xl rounded-b-5xl w-full md:w-10/12 px-4 py-8 bg-white bg-opacity-40">
                <div class="flex flex-wrap items-center">
                    <img class="mr-6 w-8 h-8 rounded-full object-cover" src="{{ !is_null($user = $review->user) ? asset('images/users/'.$user->image) : '' }}" alt="">
                    <h4 class="w-full md:w-auto text-xl font-heading font-medium">{{ $review->name }}</h4>
                    <div class="w-full md:w-px h-2 md:h-8 mx-8 bg-transparent md:bg-gray-200"></div>
                    <span class="mr-4 text-xl font-heading font-medium">{{ $review->rate }}</span>
                    <div class="inline-flex">
                        @for($i = 1; $i <= 5; $i++)
                        <a class="inline-block mr-1" href="javascript:;">
                            <svg class="w-5 h-5 text-gray-{{ $check = $i <= $review->rate ? '700' : '500' }} fill-current {{ $check ? 'dark:text-gray-300' : null }}"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                            </svg>
                        </a>
                        @endfor
                    </div>
                    <div class="flex items-center mt-1">
                        <p class="text-lg text-gray-500">{{ $review->review }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="w-full md:w-1/2 p-6 text-lg">
                <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">@lang('msg.add_review')</h2>
                {!! Form::open(['route' => 'trips.review']) !!}
                    {!! Form::hidden('trip_id', $trip->id) !!}
                    @if(Session::has('review'))
                    <span class="flex items-center text-lg tracking-wide text-green-500 text-xs mt-1 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ Session::get('review') }}
                    </span>
                    @endif
                    <div class="mt-4">
                        <label class="text-gray-700 dark:text-gray-200" for="name">@lang('models/reviews.fields.name')</label>
                        <input id="name" type="text"
                            value="{{ old('name') }}"
                            name="name"
                            class="{{ $errors->has('name') ? 'border-red-500' : '' }} block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        @error('name')
                        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="text-gray-700 dark:text-gray-200" for="emailAddress">@lang('models/reviews.fields.email')</label>
                        <input id="emailAddress" type="email"
                            value="{{ old('email') }}"
                            name="email"
                            class="{{ $errors->has('email') ? 'border-red-500' : '' }} block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        @error('email')
                        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="text-gray-700 dark:text-gray-200" for="rate">@lang('models/reviews.fields.rate')</label>
                        <select id="rate"
                            name="rate"
                            class="{{ $errors->has('rate') ? 'border-red-500' : '' }} block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @if(old('rate') == $i) selected @endif> {{ $i }} @if($i == 1) (@lang('msg.lowest')) @elseif($i == 5) (@lang('msg.heighest')) @endif</option>
                            @endfor
                        </select>
                        @error('rate')
                        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="text-gray-700 dark:text-gray-200" for="comment">@lang('models/reviews.fields.review')</label>
                        <textarea
                            value="{{ old('review') }}"
                            name="review"
                            class="{{ $errors->has('review') ? 'border-red-500' : '' }} block w-full h-40 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"></textarea>
                        @error('review')
                        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-6">
                        <button
                            class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                            @lang('crud.save')
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
</main>
@endsection

@push('page_scripts')
<script>
    $(document).on('click', '#increase-count', function() {
        var value = parseInt($('#count-input').val()) + 1;
        $('#count-input').val(value);
        $('#count-span').text(value);
    })
    $(document).on('click', '#decrease-count', function() {
        var value = parseInt($('#count-input').val()) - 1;
        if(value > 0) {
            $('#count-input').val(value);
            $('#count-span').text(value);
        }
    })
</script>
@endpush