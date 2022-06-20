@extends('provider.layouts.app')

@section('title', __('models/chats.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/chats.plural')</li>
@endsection

@section('content')

<div class="row">
    @include('flash::message')
    <div class="card col-sm-12">
        <div class="card-body p-0">
            @include('provider.chats.table')
        </div>
    </div>
</div>

@endsection

@push('third_party_stylesheets')
<link href="{{ asset('elite/dist/css/pages/chat-app-page.css') }}" rel="stylesheet">
@endpush

@push('page_scripts')
<script src="{{ asset('elite/dist/js/pages/chat.js') }}"></script>
@endpush