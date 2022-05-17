@extends('provider.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/notifications.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.notifications.index') }}">@lang('models/notifications.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('top-buttons')
{!! Form::open(['route' => ['provider.notifications.update', $notification->id], 'method' => 'patch']) !!}
<button type="button" 
    class="btn btn-info btn-confirm" 
    data-title ="@lang('msg.confirm')" 
    data-text ="{{ $notification->read_at ? __('msg.mark_as_unread') : __('msg.mark_as_read') }}">
        <i class="fa fa-edit"></i> @lang('msg.mark_as_unread')
</button>
{!! Form::close() !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('provider.notifications.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('provider.notifications.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection