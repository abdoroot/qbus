@extends('provider.layouts.app')

@section('title', __('crud.create') . ' ' . __('models/terminals.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.terminals.index') }}">@lang('models/terminals.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.create')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'provider.terminals.store']) !!}
                        @include('provider.terminals.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection