@extends('guest.layouts.app')

@section('content')
<div class="row">
    <div class="flex flex-wrap items-start min-h-screen bg-white border  text-lg">
        <div class="w-full">
            @if(Session::has('flash_cart'))
            <div class="flex items-center text-base tracking-wide text-xs mt-1 mb-3 px-5 py-5 bg-blue-500">
                {{ Session::get('flash_cart') }}
            </div>
            @endif
            <div class="cart mt-4 md:mt-12">
                <div class="container mx-auto">
                    <div class="row flex items-start justify-center flex-wrap">
                        <div class="w-full md:w-8/12 flex items-start justify-between flex-wrap">
                            @foreach($trips as $trip)
                            <div
                                class="card flex items-center justify-between flex-wrap w-1/2 md:w-full flex-wrap overflow-hidden">
                                <div class="imgCard w-full md:w-4/12 h-52 relative ">
                                    @if(!is_null($bus = $trip->bus))
                                    <img class="h-full w-full object-cover"
                                        src="{{ !is_null($img = $bus->image) ? asset('images/buses/'.$img) : null }}" alt="{{ $bus->plate }}">
                                    @endif
                                </div>
                                <div class="detailsCard w-full md:w-8/12 p-4 relative">
                                    {!! Form::open(['route' => ['removeFromCart', $trip->id]]) !!}
                                    <button
                                        class="remove absolute top-2 right-2 text-red-500 text-lg font-bold">@lang('cart.remove')</button>
                                    {!! Form::close() !!}
                                    <a href="{{ route('trips.show', $trip->id) }}" class="mainTitle">{{ $trip->full_name }} </a>
                                    <p class="description">{{ $trip->description }} </p>
                                    <div class="flex items-center justify-between flex-wrap">
                                        <ul class="items-center text-xl w-full md:w-1/2">
                                            <li class="newPrice">{{ $trip->tot_fees }} SAR </li>
                                            @if($trip->add_fees)
                                            <li class="block">@lang('msg.additionals') : 
                                                {{ $trip->add_fees }} SAR 
                                            </li>
                                            @endif
                                        </ul>
                                        <div class="options flex w-full md:w-1/2 items-center justify-end text-3xl">
                                            {{ $trip->date_from }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="w-full md:w-4/12">
                            <div class="cartDetails flex flex-wrap mb-8">
                                <ul>
                                    <h3>@lang('cart.all_items')</h3>
                                    @foreach($trips as $trip)
                                    <li>{{ $trip->full_name }} </li>
                                    @endforeach
                                    <h3>@lang('cart.datetime')</h3>
                                    <li>
                                        @if(isset($trips[0])) 
                                        {{ Carbon\Carbon::parse(($trip = $trips[0])->date_from)->format('d M Y') . ' - ' . Carbon\Carbon::parse($trip->time_from)->format('h:i A') }}
                                        @endif
                                    </li>
                                    @if(($count = count($trips)) > 1)
                                    <li>
                                        {{ Carbon\Carbon::parse(($trip = $trips[$count - 1])->date_from)->format('d M Y') . ' - ' . Carbon\Carbon::parse($trip->time_from)->format('h:i A') }}
                                    </li>
                                    @endif
                                    <h3>@lang('cart.prices')</h3>
                                </ul>
                                <ul class="flex items-center justify-between flex-wrap">
                                    <li class="flex w-full justify-between"> <span> @lang('cart.fees')</span><span
                                            class="font-bold">{{ $fees }}</span></li>
                                    <li class="flex w-full justify-between"> <span> @lang('cart.additional_fees') </span><span
                                            class="font-bold">{{ $additional_fees }}</span></li>
                                    <li class="flex w-full justify-between"> <span> @lang('cart.total') </span><span class="font-bold">
                                            {{ $total}}</span></li>
                                </ul>
                            </div>
                            <a href="{{ route('storeCart') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded">@lang('cart.confirm_and_order')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

