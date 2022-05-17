@extends('provider.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/terminals.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.terminals.index') }}">@lang('models/terminals.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($terminal, ['route' => ['provider.terminals.update', $terminal->id], 'method' => 'patch']) !!}
                        @include('provider.terminals.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection