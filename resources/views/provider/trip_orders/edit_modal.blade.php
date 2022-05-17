<div id="edit-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {!! Form::model($tripOrder, ['route' => ['provider.tripOrders.update', $tripOrder->id], 'method' => 'patch', 'id' => 'trip-order-form']) !!}
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">@lang('crud.edit')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">                
                @include('provider.trip_orders.fields')
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang('crud.save')</button>
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">@lang('crud.close')</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>