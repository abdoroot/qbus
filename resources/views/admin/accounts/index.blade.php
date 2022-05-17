@extends('admin.layouts.app')

@section('title', __('models/accounts.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/accounts.plural')</li>
@endsection

@section('top-buttons')
<a class="btn btn-primary" data-toggle="collapse" href="#filter-form" aria-expanded="false" aria-controls="filter-form">
    <i class="fas fa-filter"></i> @lang('msg.filter')
</a>
<a href="{{ route('admin.accounts.create') }}" class="btn btn-info"><i class="fa fa-plus-circle"></i> @lang('crud.add_new')</a>
@endsection

@section('content')

<div class="row">
    @include('flash::message')
    @include('admin.accounts.filter')
    <div class="card col-sm-12">
        <div class="card-body p-0">
            @include('admin.accounts.table')
        </div>
    </div>
</div>

@endsection