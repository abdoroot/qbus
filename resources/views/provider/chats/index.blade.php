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