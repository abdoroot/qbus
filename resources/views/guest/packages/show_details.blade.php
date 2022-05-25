<div class="w-full md:w-2/3">
    <div class="packageleDetails">
        <div class="mt-2">
            <label class="text-gray-700 text-xl font-bold mt-6">@lang('models/packages.fields.description'):</label>
            <div class="flex items-center mt-1">
                <p class="text-lg text-gray-500">{{ $package->description ?? '-' }}</p>
            </div>
        </div>
        <div class="mt-6">
            <label class="text-gray-700 text-xl font-bold">@lang('models/packages.destination'):</label>
            <ul class="text-gray-700 text-left relative overflow-hidden">
                @foreach($package->packageDestinations() as $i => $destination)
                <li class="text-lg relative overflow-hidden pl-12 my-4">
                    <span
                        class="absolute w-8 h-8 bg-blue-700 left-0 top-2 text-center text-white rounded-full">
                        {{ $i + 1 }}
                    </span>
                    <div class="mt-2">
                        <label class="text-gray-700 text-xl font-bold mt-6">{{ $destination->name }}</label>
                    </div>
                    <ul class="text-gray-700 text-left relative overflow-hidden">
                        <li class="text-lg relative overflow-hidden pl-8 my-3">
                            <span
                                class="absolute w-2 h-2 bg-blue-700 left-0 top-3 text-center text-white rounded-full">
                            </span>
                            <div>
                                <label class="text-gray-700 text-xl font-bold">{{ !is_null($fromCity = $destination->fromCity) ? $fromCity->name : '-' }}</label>
                                <div>
                                    <label class="text-gray-700 text-base font-bold mt-6">@lang('models/destinations.fields.starting_terminal_id') : </label>
                                    <span class="text-base text-gray-500">{{ !is_null($startingTerminal = $destination->startingTerminal) ? $startingTerminal->name : '-' }}</span>
                                </div>
                            </div>
                        </li>
                        <li class="text-lg relative overflow-hidden pl-8 my-3">
                            <span
                                class="absolute w-2 h-2 bg-blue-700 left-0 top-3 text-center text-white rounded-full">
                            </span>
                            <div>
                                <label class="text-gray-700 text-xl font-bold">{{ !is_null($toCity = $destination->toCity) ? $toCity->name : '-' }}</label>
                                <div>
                                    <label class="text-gray-700 text-base font-bold mt-6">@lang('models/destinations.fields.arrival_terminal_id') : </label>
                                    <span class="text-base text-gray-500">{{ !is_null($arrivalTerminal = $destination->arrivalTerminal) ? $arrivalTerminal->name : '-' }}</span>
                                </div>
                            </div>
                        </li>
                        @if(count($stops = $destination->stopTerminals()) > 0)
                        <li class="text-lg relative overflow-hidden pl-8 my-3">
                            <span
                                class="absolute w-2 h-2 bg-blue-700 left-0 top-3 text-center text-white rounded-full">
                            </span>
                            <div>
                                <label class="text-gray-700 text-xl font-bold">@lang('models/destinations.fields.stops')</label>
                                @foreach($stops as $stop)
                                <div class="flex items-center mt-1">
                                    <p class="text-lg text-gray-500">- {{ $stop->name }}</p>
                                </div>
                                @endforeach
                            </div>
                        </li>
                        @endif
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
        @if($package->provider_notes != "")
        <div class="mt-6">
            <label class="text-gray-700 text-xl font-bold mt-6">@lang('models/packages.fields.provider_notes'):</label>
            <div class="flex items-center mt-1">
                <p class="text-lg text-gray-500">{{ $package->provider_notes ?? '-' }}</p>
            </div>
        </div>
        @endif
    </div>
</div>