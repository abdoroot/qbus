@extends('guest.layouts.app')

@section('content')
    <div class="row">
        <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
            <div class="w-full md:w-1/4 min-h-screen py-8 border-r">

                @php $page = "profile.orders"; @endphp
                @include('user.profile.menu', ['user' => Auth::user()])
            </div>

            <div class="w-full md:w-3/4 p-4 md:p-8">
                <div class="profileTap">
                    <h2 class="font-bold">@lang('models/busOrders.plural')</h2>
                    <div class="my-5">
                        <a href="{{ route('tripOrders.index') }}"
                        class="{{ Request::is('tripOrders*') ? 'bg-blue-700' : 'bg-blue-400' }} px-4 mx-2 text-lg py-2 text-white transition-colors duration-200 transform rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            @lang('models/tripOrders.plural')
                        </a>
                        <a href="{{ route('packageOrders.index') }}"
                        class="{{ Request::is('packageOrders*') ? 'bg-blue-700' : 'bg-blue-400' }} px-4 mx-2 text-lg py-2 text-white transition-colors duration-200 transform rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            @lang('models/packageOrders.plural')
                        </a>
                        <a href="{{ route('busOrders.index') }}"
                        class="{{ Request::is('busOrders*') ? 'bg-blue-700' : 'bg-blue-400' }} px-4 mx-2 text-lg py-2 text-white transition-colors duration-200 transform rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            @lang('models/busOrders.plural')
                        </a>
                    </div>
                    <div class="mt-6 ">
                        @include('flash::message')
                        @include('user.bus_orders.table')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row -->
@endsection

