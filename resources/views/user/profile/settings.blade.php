@extends('guest.layouts.app')

@section('content')
<div class="row">
    <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
        <div class="w-full md:w-1/4 min-h-screen py-8 border-r">
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

