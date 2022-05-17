@extends('user.layouts.app')

@section('title', __('msg.my_complaints'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('msg.my_complaints')</li>
@endsection

@section('top-buttons')
<a href="{{ route('contacts.create', ['type' => 'complaint']) }}" class="btn btn-info ml-2"><i class="fa fa-plus-circle"></i> @lang('crud.add_new')</a>
@endsection

@section('content')
<div class="row">
    @include('flash::message')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body p-0">
                @include('user.contacts.table')
            </div>
        </div>
    </div>
</div>
@endsection