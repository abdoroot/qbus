@extends('guest.layouts.app')

@section('content')
    <div class="row">
        <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
            <div class="w-full md:w-1/4 min-h-screen py-8 border-r">

                @php $page = "notifications.index"; @endphp
                @include('user.profile.menu', ['user' => Auth::user()])
            </div>

            <div class="w-full md:w-3/4 p-4 md:p-8">
                <div class="profileTap">
                    <h2 class="font-bold">@lang('models/notifications.plural')</h2><div class="mt-6 ">
                        @include('flash::message')
                        @include('user.notifications.table')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row -->
@endsection

