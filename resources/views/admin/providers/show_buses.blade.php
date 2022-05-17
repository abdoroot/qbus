<div class="tab-pane {{ isset($active) && $active == 'buses' ? 'active' : '' }}" id="buses-tab" role="tabpanel">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="card-title">@lang('models/buses.plural')</h4>
            </div>
        </div>                            
        @include('admin.buses.table', ['buses' => $provider->buses])
    </div>
</div>