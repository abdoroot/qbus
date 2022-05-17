@extends('admin.layouts.app')

@section('title', __('models/services.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/services.plural')</li>
@endsection

@section('top-buttons')
<a href="{{ route('admin.services.create') }}" class="btn btn-info"><i class="fa fa-plus-circle"></i> @lang('crud.add_new')</a>
@endsection

@section('content')

<div class="row">
    @include('flash::message')
    <div class="card col-sm-12">
        <div class="card-body p-0">
            @include('admin.services.table')
        </div>
    </div>
</div>

@endsection