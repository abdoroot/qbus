@extends('admin.layouts.app')

@section('title', __('models/terminals.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/terminals.plural')</li>
@endsection

@section('content')

<div class="row">
    @include('flash::message')
    <div class="card col-sm-12">
        <div class="card-body p-0">
            @include('admin.terminals.table')
        </div>
    </div>
</div>

@endsection