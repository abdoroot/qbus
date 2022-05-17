<div class="tab-pane {{ isset($active) && $active == 'accounts' ? 'active' : '' }}" id="accounts-tab" role="tabpanel">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="card-title">@lang('models/providers.tabs.accounts_title')</h4>
                <h5 class="card-subtitle">@lang('models/providers.tabs.accounts_subtitle')</h5>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('admin.accounts.create', ['provider_id' => $provider->id, 'back_to' => route('admin.providers.edit', ['provider' => $provider->id, 'active' => 'accounts'])]) }}" class="btn btn-info float-right"><i class="fa fa-plus-circle"></i> @lang('crud.add_new')</a>
            </div>
        </div>                            
        @include('admin.accounts.table', ['accounts' => $provider->accounts, 'action' => true, 'back_to' => route('admin.providers.edit', ['provider' => $provider->id, 'active' => 'accounts'])])
    
        <a class="btn btn-dark" href="{{ route('admin.providers.index') }}">@lang('crud.back')</a>
    </div>
</div>