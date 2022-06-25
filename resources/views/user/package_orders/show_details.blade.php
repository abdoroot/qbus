<div class="flex justify-between p-6">
    @if(!is_null($package = $packageOrder->package))
    <div>
        <h6 class="font-bold">@lang('models/packages.singular') : 
            <span class="text-sm font-medium"> 
                <a href="{{ route('packages.show', $package->id) }}" class="text-blue-600">{{ $package->name  }} </a>
            </span>
        </h6>
        <h6 class="font-bold">@lang('models/packages.fields.date_from') : <span class="text-sm font-medium"> {{ Carbon\Carbon::parse($package->date_from . ' ' . $package->time_from)->format('d M Y h:i a') }}</span></h6>
        <h6 class="font-bold"> @lang('models/packages.fields.destination') : </h6>
        <ul class="px-4">
            @foreach($package->packageDestinations() as $destination)
            <li> - {{ $destination->name }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="border-l border-gray-200 px-4 w-80">
        <address class="text-sm">
            <span class="font-bold"> @lang('msg.order_id') : </span> <span class="text-sm font-medium"> {{ $packageOrder->id }}</span>
            <p><span class="font-bold"> @lang('models/packageOrders.fields.status') : </span> @lang('models/packageOrders.status.'.$packageOrder->status)</p>
            <p><span class="font-bold"> @lang('crud.created_at') : </span> {{ Carbon\Carbon::parse($packageOrder->created_at)->format('d M Y') }}</p>
        </address>
    </div>
</div>