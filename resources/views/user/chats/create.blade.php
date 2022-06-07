@extends('guest.layouts.app')

@section('content')
<div class="row">
    <div class="row flex flex-wrap items-start min-h-screen bg-white border  text-lg">
        <div class="w-full md:w-1/4 min-h-screen py-8 border-r">
            @include('user.chats.menu')
        </div>
        <div class="w-full md:w-3/4 p-4 md:p-8">
            <div class="profileTap">
                @include('user.chats.fields')
            </div>
        </div>
    </div>
</div>

<!-- Row -->
@endsection

