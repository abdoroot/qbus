<div id="user-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">@lang('models/users.singular')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <small class="text-muted"> @lang('models/users.fields.name') :</small>
                <h6>{{ $user->name }}</h6> 
                <small class="text-muted"> @lang('models/users.fields.email') :</small>
                <h6>{{ $user->email }}</h6> 
                <small class="text-muted"> @lang('models/users.fields.phone') :</small>
                <h6>{{ $user->phone }}</h6> 
                <small class="text-muted"> @lang('models/users.fields.address') :</small>
                <h6>{{ $user->address }}</h6> 
                <small class="text-muted p-t-30 db">@lang('models/users.fields.marital_status') :</small>
                <h6 class="mb-3">{!! __('models/users.marital_status.'.$user->marital_status) !!}</h6> 
                <small class="text-muted p-t-30 db">@lang('models/users.fields.block') :</small>
                <h6 class="mb-3">{!! $user->block_span !!}</h6> 
                <hr>
                <div class="row">
                    <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ti-truck"></i> <font class="font-medium">{{ $user->busOrders->where('provider_id', Auth::guard('provider')->user()->provider_id)->count() }}</font></a></div>
                    <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-wallet"></i> <font class="font-medium">{{ $user->busOrders->where('provider_id', Auth::guard('provider')->user()->provider_id)->sum('fees')  }}</font></a></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">@lang('crud.close')</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>