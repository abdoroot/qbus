<div class="flex justify-between p-6">
    @if(!is_null($trip = $tripOrder->trip))
    <div>
        <h6 class="font-bold">@lang('msg.trip_id') : 
            <span class="text-sm font-medium"> 
                <a href="{{ route('trips.show', $trip->id) }}" class="text-blue-600">{{ $trip->id  }} </a>
            </span>
        </h6>
        <h6 class="font-bold">@lang('msg.trip_date') : <span class="text-sm font-medium"> {{ Carbon\Carbon::parse($trip->date_from . ' ' . $trip->time_from)->format('d M Y h:i a') }}</span></h6>
        <h6 class="font-bold"> @lang('models/trips.fields.destination') : 
            <span class="text-sm font-medium">{{ !is_null($destination = $trip->destination) ? $destination->name : '-' }}</span>
        </h6>
        <h6 class="font-bold"> @lang('models/buses.fields.plate') : 
            <span class="text-sm font-medium">{{ !is_null($bus = $trip->bus) ? $bus->plate : '-' }}</span>
        </h6>
    </div>
    @endif
    <div class="border-l border-gray-200 px-4 w-80">
        <address class="text-sm">
            <span class="font-bold"> @lang('msg.order_id') : </span> <span class="text-sm font-medium"> {{ $tripOrder->id }}</span>
            <p><span class="font-bold"> @lang('models/tripOrders.fields.type') : </span> @lang('models/trips.types.'.$tripOrder->type)</p>
            <p><span class="font-bold"> @lang('models/tripOrders.fields.status') : </span> @lang('models/tripOrders.status.'.$tripOrder->status)</p>
            <p><span class="font-bold"> @lang('crud.created_at') : </span> {{ Carbon\Carbon::parse($tripOrder->created_at)->format('d M Y') }}</p>
        </address>
    </div>
</div>