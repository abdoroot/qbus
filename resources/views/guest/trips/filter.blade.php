{!! Form::open(['route' => 'trips.index', 'method' => 'GET']) !!}
    {!! Form::hidden('type', $type) !!}
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
        <div class="mt-4">
            <label class="text-gray-700 dark:text-gray-200 font-bold"
                for="code">@lang('models/coupons.fields.singular')</label>
            <input id="code" type="text" name="code" value="{{ $code }}"
                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md"
                placeholder="@lang('models/coupons.fields.code')">
        </div>
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
            <label class="text-gray-700 dark:text-gray-200 font-bold" for="city">@lang('models/destinations.fields.from_city_id')</label>
            {!! Form::select('from_city_id', $cities, $from_city_id, [
                'placeholder' => __('msg.select'),
                'class' => 'block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring']) !!}
        </div>
        <div class="mt-4">
            <label class="text-gray-700 dark:text-gray-200 font-bold" for="city">@lang('models/destinations.fields.to_city_id')</label>
            {!! Form::select('to_city_id', $cities, $to_city_id, [
                'placeholder' => __('msg.select'),
                'class' => 'block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring']) !!}
        </div>
        <h3 class="text-gray-700 dark:text-gray-200 mt-6 font-bold">@lang('models/trips.fields.additional'):</h3>
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