@extends('guest.layouts.app')

@section('content')
<div class="row">
    <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
        <div class="w-full md:w-1/4 min-h-screen py-8 border-r"><div class="flex flex-col items-center mt-6 -mx-2">
                <img class="object-cover w-24 h-24 mx-2 rounded-full" src="{{ is_file(asset('images/users/' . $user->image)) ? asset('images/users/' . $user->image):asset('images/users/default-user-image.png') }}" alt="avatar">
                <h4 class="mx-2 mt-2 font-medium text-gray-800 dark:text-gray-200 hover:underline">{{ $user->name }}</h4>
                <p class="mx-2 mt-1 text-sm font-medium text-gray-600 dark:text-gray-400 hover:underline">  {{ $user->phone }}</p>
            </div>
            @php $page = "profile.settings"; @endphp
            @include('user.profile.menu')
            @include('flash::message')
        </div>

        <div class="w-full md:w-3/4 p-4 md:p-8">
            <div class="profileTap">
                @include('user.profile.settings_tab')
                </div>
            </div>
        </div></div>
</div>

    <!-- Column -->
</div>
<!-- Row -->
@endsection

