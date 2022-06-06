@extends('guest.layouts.app')

@section('content')
    <div class="row">
        <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
            <div class="w-full md:w-1/4 min-h-screen py-8 border-r">

                @php $page = "profile.complaint"; @endphp
                @include('user.profile.menu')
            </div>

            <div class="w-full md:w-3/4 p-4 md:p-8">
                <div class="profileTap">
                    <h2 class="font-bold">@lang('msg.my_complain')</h2><div class="mt-6 ">
                        @include('flash::message')
                        <div class="relative mb-4 text-center w-full md:w-1/4 p-2">
                            <a href="{{route('profile.new_complain')}}" class="block text-white text-center bg-indigo-500 w-full border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">@lang('msg.new') </a>
                        </div>
                        @include('user.profile.complaint-table')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row -->
@endsection

