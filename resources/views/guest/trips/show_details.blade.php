<div class="w-full md:w-2/3">
    <div class="tripleDetails">
        <div class="mt-2">
            <label class="text-gray-700 text-xl font-bold mt-6">@lang('models/trips.fields.description'):</label>
            <div class="flex items-center mt-1">
                <p class="text-lg text-gray-500">{{ $trip->description ?? '-' }}</p>
            </div>
        </div>
        <div class="mt-6 text-xl">
            <div class="pb-6">
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
            <div class="py-6">
                <h1 class="text-lg font-medium text-gray-700 capitalize lg:text-xl dark:text-white">
                    @lang('models/trips.fields.additional')</h1>
                <div class="mt-8 space-y-4">
                    @foreach($additionals as $additional)
                    <div class="flex items-center">
                        @if(!is_null($tripAdditionals = $trip->additionals()) && !is_null($addition = collect($tripAdditionals)->where('id', $additional->id)->first()))
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
                        <span class="mx-4 text-gray-700 dark:text-gray-300">{{ $additional->name }} 
                            @if(isset($addition) && !is_null($addition))
                                ({{ $addition['fees'] }})
                            @endif
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-6">
            <label class="text-gray-700 text-xl font-bold">@lang('models/trips.destination'):</label>
            <ul class="text-gray-700 text-left relative overflow-hidden">
                {{-- @foreach($trip->tripCities as $i => $tripCity)
                <li class="text-lg relative overflow-hidden pl-12 my-4"><span
                        class="absolute w-8 h-8 bg-blue-700 left-0 top-2 text-center text-white rounded-full">{{ $i+1 }}</span>
                    <div class="mt-2">
                        <label class="text-gray-700 text-xl font-bold mt-6">{{ !is_null($city = $tripCity->city) ? $city->name : '-' }}</label>
                        <div class="flex items-center mt-1">
                            <p class="text-lg text-gray-500">{{ $tripCity->description }}</p>
                        </div>
                    </div>
                </li>
                @endforeach --}}
                @if(!is_null($destination))
                <li class="text-lg relative overflow-hidden pl-12 my-4">
                    <span
                        class="pl-1 pt-1 absolute w-8 h-8 bg-blue-700 left-0 top-2 text-center text-white rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>
                    <div class="mt-2">
                        <label class="text-gray-700 text-xl font-bold mt-6">@lang('models/destinations.fields.from_city_id')</label>
                        <div class="flex items-center mt-1">
                            <p class="text-lg text-gray-500"> {{ !is_null($fromCity = $destination->fromCity) ? $fromCity->name : '-' }} </p>
                        </div>
                        <div>
                            <label class="text-gray-700 text-base font-bold mt-6">@lang('models/destinations.fields.starting_terminal_id') : </label>
                            <span class="text-base text-gray-500">{{ !is_null($startingTerminal = $destination->startingTerminal) ? $startingTerminal->name : '-' }}</span>
                        </div>
                    </div>
                </li>
                <li class="text-lg relative overflow-hidden pl-12 my-4">
                    <span
                        class="pl-1 pt-1 absolute w-8 h-8 bg-blue-700 left-0 top-2 text-center text-white rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>
                    <div class="mt-2">
                        <label class="text-gray-700 text-xl font-bold mt-6">@lang('models/destinations.fields.to_city_id')</label>
                        <div class="flex items-center mt-1">
                            <p class="text-lg text-gray-500">{{ !is_null($toCity = $destination->toCity) ? $toCity->name : '-' }}</p>
                        </div>
                        <div>
                            <label class="text-gray-700 text-base font-bold mt-6">@lang('models/destinations.fields.arrival_terminal_id') : </label>
                            <span class="text-base text-gray-500">{{ !is_null($arrivalTerminal = $destination->arrivalTerminal) ? $arrivalTerminal->name : '-' }}</span>
                        </div>
                    </div>
                </li>
                @if(!is_null($stops = $destination->stopTerminals()))
                <li class="text-lg relative overflow-hidden pl-12 my-4">
                    <span
                        class="pl-1 pt-1 absolute w-8 h-8 bg-blue-700 left-0 top-2 text-center text-white rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>
                    <div class="mt-2">
                        <label class="text-gray-700 text-xl font-bold mt-6">@lang('models/destinations.fields.stops')</label>
                        @foreach($stops as $stop)
                        <div class="flex items-center mt-1">
                            <p class="text-lg text-gray-500">- {{ $stop->name }}</p>
                        </div>
                        @endforeach
                    </div>
                </li>
                @endif
                @endif
            </ul>
        </div>
        <div class="mt-6">
            <label class="text-gray-700 text-xl font-bold mt-6">@lang('models/trips.fields.provider_notes'):</label>
            <div class="flex items-center mt-1">
                <p class="text-lg text-gray-500">{{ $trip->provider_notes ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>