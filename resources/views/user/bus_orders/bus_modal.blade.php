<div id="bus-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">@lang('models/busOrders.fields.bus_id')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <img class="card-img" src="{{ asset('images/buses/'.$bus->image) }}" /> 
                <small class="text-muted"> @lang('models/buses.fields.plate') :</small>
                <h6>{{ $bus->plate }}</h6> 
                <small class="text-muted"> @lang('models/buses.fields.passengers') :</small>
                <h6>{{ $bus->passengers }}</h6>  
                <hr>
                <div class="row">
                    <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ti-truck"></i> <font class="font-medium">{{ $bus->busOrders->where('user_id', Auth::user()->id)->count() }}</font></a></div>
                    <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-star"></i> <font class="font-medium">{{ $bus->rate  }}</font></a></div>
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