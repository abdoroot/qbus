<div class="flex justify-between p-6">
    <div>
        <h6 class=" border-b py-1 font-bold"> @lang('msg.order_id') : <span class="text-sm font-medium"> {{ $busOrder->id }}</span> </h6>
        <h6 class=" border-b py-1 font-bold">@lang('models/busOrders.fields.date_from') : <span class="text-sm font-medium"> {{ Carbon\Carbon::parse($busOrder->date_from . ' ' . $busOrder->time_from)->format('d M Y h:i a') }}</span></h6>
        <h6 class=" border-b py-1 font-bold"><span class="text-sm font-medium"> @lang('models/busOrders.fields.status') : </span> @lang('models/busOrders.status.'.$busOrder->status)</h6>
        <h6 class=" border-b py-1 font-bold"><span class="text-sm font-medium"> @lang('crud.created_at') : </span> {{ Carbon\Carbon::parse($busOrder->created_at)->format('d M Y') }}</h6>
        <h6 class="py-1 font-bold"> @lang('models/busOrders.destination') : </h6>
        <ul class="px-5">
            @foreach($busOrder->destinationCities() as $city)
            <li> - {{ $city->name }}</li>
            @endforeach
        </ul>
    </div>
    @if(!is_null($bus = $busOrder->bus))
    <div class="border-l border-gray-200 px-4 w-80">
        <h6 class=" border-b py-1 font-bold"> @lang('models/buses.fields.plate') : 
            <span class="text-sm font-medium">{{ $bus->plate }}</span>
        </h6>
        @if(!is_null($img = $bus->image))
        <img src="{{ asset('images/buses/'.$img) }}" alt="">
        @endif
    </div>
    @endif
</div>
<div class="w-full mt-3">
    <iframe width="100%" height="200" frameborder="0" style="border:0" allowfullscreen
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"></iframe>
</div>