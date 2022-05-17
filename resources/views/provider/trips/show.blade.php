@extends('provider.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/trips.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.trips.index') }}">@lang('models/trips.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('top-buttons')
<a href="javascript:;" data-toggle="modal" data-target="#notification-modal" class="btn btn-primary">@lang('msg.send_notification')</a>
<a href="{{ route('provider.trips.edit', $trip->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> @lang('crud.edit')</a>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('provider.trips.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('provider.trips.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
    @include('provider.trips.notification')  
@endsection