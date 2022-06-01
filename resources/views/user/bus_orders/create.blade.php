@extends('guest.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/busOrders.singular'))

@section('id', 'Book')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1
            class="text-3xl mb-4 font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">
            @lang('msg.create_bus_order_title') <br />
             <span class="text-blue-500 mt-4 inline-block">@lang('msg.create_bus_order_subtitle')</span>
        </h1>
    </div>
</section>
<div class="BookBus">
    <div class="container mx-auto">
        <div class="row flex items-center justify-center flex-wrap p-4 md:p-0">
            <div class="w-full">
                <ul class="mb-3 timeLine step-list flex items-center justify-between relative overflow-hidden">
                    @for($i = 1; $i <= 5; $i++)
                    <li
                        class="i-{{ $i }} bg-white flex text-center items-center justify-center border-black rounded-full text-2xl border-2 w-12 h-12">
                        {{ $i }}
                    </li>
                    @endfor
                </ul>
                @include('guest.layouts.flash')
            </div>
            <div class="w-full">
                {!! Form::open(['route' => 'busOrders.store']) !!}
                    {!! Form::hidden('provider_id', null, ['id' => 'provider_id']) !!}
                    {!! Form::hidden('bus_id', null, ['id' => 'bus_id']) !!}
                    
                    @include('user.bus_orders.steps.location')

                    @include('user.bus_orders.steps.datetime')

                    @include('user.bus_orders.steps.destination')

                    @include('user.bus_orders.steps.provider')

                    @include('user.bus_orders.steps.bus')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@include('guest.layouts.map')

@endsection

@include('user.bus_orders.script')