@extends('admin.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/providers.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.providers.index') }}">@lang('models/providers.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('top-buttons')
<a href="{{ route('admin.providers.edit', $provider->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> @lang('crud.edit')</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                
                
            </div>

            <div class="card">
                <!-- Nav tabs -->
               <ul class="nav nav-tabs profile-tab" role="tablist">
                   <li class="nav-item"> <a class="nav-link {{ !isset($active) || !in_array($active, ['accounts', 'buses']) || $active == 'provider' ? 'active' : '' }}" data-toggle="tab" href="#provider-tab" role="tab">@lang('models/providers.tabs.provider')</a> </li>
                   <li class="nav-item"> <a class="nav-link {{ $active == 'accounts' ? 'active' : '' }}" data-toggle="tab" href="#accounts-tab" role="tab">@lang('models/providers.tabs.accounts')</a> </li>
                   <li class="nav-item"> <a class="nav-link {{ $active == 'buses' ? 'active' : '' }}" data-toggle="tab" href="#buses-tab" role="tab">@lang('models/buses.plural')</a> </li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                   <div class="tab-pane {{ !isset($active) || !in_array($active, ['accounts', 'buses']) || $active == 'provider' ? 'active' : '' }}" id="provider-tab" role="tabpanel">
                    <div class="card-body p-0">
                        <table class="table table-hover">
                            <tbody>
                                @include('admin.providers.show_fields')
                            </tbody>
                        </table>
                    </div>
                   </div>

                   @include('admin.providers.show_accounts')

                   @include('admin.providers.show_buses')

                   <div class="card-footer">
                        <a class="btn btn-dark" href="{{ route('admin.providers.index') }}">@lang('crud.back')</a>
                    </div>
               </div>
           </div>
        </div>
    </div>
@endsection