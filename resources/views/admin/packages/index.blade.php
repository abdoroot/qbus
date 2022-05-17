@extends('admin.layouts.app')

@section('title', __('models/packages.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/packages.plural')</li>
@endsection

@section('top-buttons')
<a class="btn btn-primary" data-toggle="collapse" href="#filter-form" aria-expanded="false" aria-controls="filter-form">
    <i class="fas fa-filter"></i> @lang('msg.filter')
</a>
@endsection

@section('content')
<div class="row">
    @include('flash::message')
    @include('admin.packages.filter')
    <div class="card col-sm-12">
        <div class="card-body p-0">
            @include('admin.packages.table')
        </div>
    </div>
</div>
@endsection