<div class="flex justify-between p-6">
    <div>
        <p class="text-base">
            @lang('msg.trip_by') :
        </p>
        @if(!is_null($provider = $tripOrder->provider))
        <h1 class="text-3xl italic font-extrabold tracking-widest text-indigo-500">{{ $provider->name }}</h1>
        <div class="p-2">
            <ul class="block">
                <li class="p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600 inline" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-sm">
                        {{ $provider->address }}
                    </span>
                </li>
                <li class="p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm">
                        {{ $provider->email }}
                    </span>
                </li>
                <li class="p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span class="text-sm">
                        {{ $provider->phone }}
                    </span>
                </li>
            </ul>
        </div>
        @endif
    </div>
    <div class="py-2 px-5 border-l-2 border-indigo-200 w-80">
        <span class="font-bold"> @lang('msg.billed_to') : </span>
        <ul class="text-sm">
            @if(!is_null($user = $tripOrder->user))
            <li>{{ $user->name }}</li>
            <li>{{ $user->email }}</li>
            <li>{{ $user->phone }}</li>
            @endif
        </ul>
    </div>
</div>
<div class="w-full h-0.5 bg-indigo-500"></div>