<div class="md:flex md:items-start">
    <div class="w-full md:w-1/2">
        <div class="packageleImage h-96"> 
            <img class="w-full h-full object-cover" src="{{ !is_null($image = $package->image) ? asset('images/packages/'.$image) : '' }}" alt="">
        </div>
    </div>
    <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
        <h3 class="text-gray-700 text-2xl">{{ $package->name }}</h3>
        <div class="flex mt-2 item-center">
            @for($i = 1; $i <= 5; $i++)
            <svg class="w-5 h-5 text-gray-{{ $check = $i <= $package->rate ? '700' : '500' }} fill-current {{ $check ? 'dark:text-gray-300' : null }}"
                viewBox="0 0 24 24">
                <path
                    d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
            </svg>
            @endfor
        </div>
        <span class="text-gray-500 text-xl font-bold mt-6 block">
            <label class="text-gray-700 text-xl font-bold" for="count">@lang('models/packages.fields.provider_id'): </label>
            {{ !is_null($provider) ? $provider->name : ' - ' }}
        </span>
        <span class="text-gray-500 text-xl font-bold mt-6 block">
            <label class="text-gray-700 text-xl font-bold" for="count">@lang('models/packages.fields.starting_city_id'): </label>
            {{ !is_null($startingCity = $package->startingCity) ? $startingCity->name : ' - ' }}
        </span>
        <span class="text-gray-500 text-xl font-bold my-6 block w-full">
            {{ __('msg.package_starts_on') }} {{ Carbon\Carbon::parse($package->date_from)->format('d M Y') }}
            <span class="float-right text-gray-700"> {{ Carbon\Carbon::parse($package->time_from)->format('h:i A') }} </span> 
        </span>
        <hr class="my-3">
        <span class="text-gray-500 text-xl font-bold mt-6 block w-full">
            SAR {{ $package->fees }} 
            <span class="float-right text-blue-700"> {{ count($package->destinations ?? []) }} @lang('models/packages.fields.destinations') </span> 
        </span>
    </div>
</div>