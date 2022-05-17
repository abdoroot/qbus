<div class="tab-pane {{ !isset($active) || is_null($active) || $active == 'profile' ? 'active' : '' }}" id="profile" role="tabpanel">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 col-xs-6 b-r"> <strong>{{ __('models/buses.plural') }}</strong>
                <br>
                <p class="text-muted">{{ $provider->buses->count() }}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"> <strong>{{ __('models/accounts.plural') }}</strong>
                <br>
                <p class="text-muted">{{ $provider->accounts->count() }}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"> <strong>@lang('models/trips.plural')</strong>
                <br>
                <p class="text-muted">{{ $provider->trips->count() }}</p>
            </div>
            <div class="col-md-3 col-xs-6"> <strong>@lang('models/busOrders.plural')</strong>
                <br>
                <p class="text-muted">{{ $provider->busOrders->count() }}</p>
            </div>
        </div>
        <hr>
        <small class="text-muted"> @lang('models/providers.fields.comm_name') : </small>
        <h6>{{ $provider->comm_name ?? '-' }}</h6> 
        <small class="text-muted"> @lang('models/providers.fields.comm_reg_num') : </small>
        <h6>{{ $provider->comm_reg_num ?? '-' }}</h6> 
        <small class="text-muted"> @lang('models/providers.fields.tax_cert_num') : </small>
        <h6>{{ $provider->tax_cert_num ?? '-' }}</h6> 
        <hr>
        <h4 class="font-medium m-t-30">Some Chart</h4>
        <h5 class="m-t-30">Wordpress <span class="pull-right">80%</span></h5>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
        </div>
        <h5 class="m-t-30">HTML 5 <span class="pull-right">90%</span></h5>
        <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
        </div>
        <h5 class="m-t-30">jQuery <span class="pull-right">50%</span></h5>
        <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
        </div>
        <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
        <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
        </div>
    </div>
</div>