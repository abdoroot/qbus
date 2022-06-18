@extends('provider.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/chats.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.chats.index') }}">@lang('models/chats.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($chat, ['route' => ['provider.chats.update', $chat->id], 'method' => 'patch']) !!}
                        @include('provider.chats.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection