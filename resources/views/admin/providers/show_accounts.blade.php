<div class="tab-pane {{ isset($active) && $active == 'accounts' ? 'active' : '' }}" id="accounts-tab" role="tabpanel">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="card-title">@lang('models/providers.tabs.accounts_title')</h4>
                <h5 class="card-subtitle">@lang('models/providers.tabs.accounts_subtitle')</h5>
            </div>
        </div>                            
        @include('admin.accounts.table', ['accounts' => $provider->accounts, 'action' => false, 'back_to' => route('admin.providers.show', ['provider' => $provider->id, 'active' => 'accounts'])])
    </div>
</div>