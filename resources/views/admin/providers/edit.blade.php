@extends('admin.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/providers.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.providers.index') }}">@lang('models/providers.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                 <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link {{ !isset($active) || !in_array($active, ['accounts']) || $active == 'provider' ? 'active' : '' }}" data-toggle="tab" href="#provider-tab" role="tab">@lang('models/providers.tabs.provider')</a> </li>
                    <li class="nav-item"> <a class="nav-link {{ $active == 'accounts' ? 'active' : '' }}" data-toggle="tab" href="#accounts-tab" role="tab">@lang('models/providers.tabs.accounts')</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane {{ !isset($active) || !in_array($active, ['accounts']) || $active == 'provider' ? 'active' : '' }}" id="provider-tab" role="tabpanel">
                        <div class="card-body">
                            {!! Form::model($provider, ['route' => ['admin.providers.update', $provider->id], 'method' => 'patch', 'files' => true]) !!}
                                @include('admin.providers.fields')
                            {!! Form::close() !!}
                        </div>
                    </div>

                    @include('admin.providers.accounts')
                </div>
            </div>
        </div>
    </div>
@endsection