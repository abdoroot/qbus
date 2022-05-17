<div id="cancel-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {!! Form::model($busOrder, ['route' => ['busOrders.update', $busOrder->id], 'method' => 'patch', 'id' => 'bus-order-form']) !!}
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">@lang('models/busOrders.cancel_title')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">                
                <!-- User Notes Field -->
                <div class="form-group">
                    {!! Form::label('user_notes', __('models/busOrders.fields.user_notes').'*') !!}
                    {!! Form::textarea('user_notes', null, ['class' => 'form-control' . ($errors->has('user_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
                    @error('user_notes')
                    <span class="invalid-feedback"> {{ $message }} </span>
                    @enderror
                </div>
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