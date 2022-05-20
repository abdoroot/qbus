<div class="md:flex md:items-start">
    <div class="w-full md:w-1/2">
        <div class="tripleImage h-96"> 
            <img class="w-full h-full object-cover" src="{{ !is_null($bus = $trip->bus) && !is_null($image = $bus->image) ? asset('images/buses/'.$image) : '' }}" alt="">
        </div>
    </div>
    <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
        <h3 class="text-gray-700 text-2xl">{{ $trip->name . (!is_null($destination) ? ' - ' . $destination->name : '') }}</h3>
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
            <label class="text-gray-700 text-xl font-bold" for="count">@lang('models/trips.fields.provider_id'): </label>
            {{ !is_null($provider) ? $provider->name : ' - ' }}
        </span>
        <span class="text-gray-500 text-xl font-bold mt-6 block">
            <label class="text-gray-700 text-xl font-bold" for="count">@lang('models/trips.fields.bus_id'): </label>
            {{ !is_null($bus) ? $bus->plate : ' - ' }}
        </span>
        <span class="text-gray-500 text-xl font-bold my-6 block">{{ __('msg.trip_starts_on') }} {{ Carbon\Carbon::parse($trip->date_from)->format('d M Y') }}</span>
        <hr class="my-3">
        <span class="text-gray-500 text-xl font-bold mt-6 block w-full">
            SAR {{ $trip->fees }} 
            <span class="float-right text-blue-700"> {{ $trip->available }} @lang('msg.seats_only') </span> 
        </span>
    </div>
</div>