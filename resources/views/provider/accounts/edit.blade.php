@extends('provider.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/accounts.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.accounts.index') }}">@lang('models/accounts.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($account, ['route' => ['provider.accounts.update', $account->id], 'method' => 'patch']) !!}
                        @include('provider.accounts.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection