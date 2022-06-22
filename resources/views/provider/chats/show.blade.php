@extends('provider.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/chats.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.chats.index') }}">@lang('models/chats.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('top-buttons')
{!! Form::open(['route' => ['provider.chats.update', $chat->id], 'method' => 'patch']) !!}
<button type="button" 
    class="btn btn-info btn-confirm" 
    data-title ="@lang('msg.confirm')" 
    data-text ="{{ $chat->read_at ? __('msg.mark_as_unread') : __('msg.mark_as_read') }}">
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
                            @include('provider.chats.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('provider.chats.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection