@extends('user.layouts.app')

@section('title', __('models/notifications.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/notifications.plural')</li>
@endsection

@section('content')

<div class="row">
    @include('flash::message')
    <div class="card col-sm-12">
        <div class="card-body p-0">
            @include('user.notifications.table')
        </div>
    </div>
</div>

@endsection