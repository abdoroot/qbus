<div id="cancel-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {!! Form::model($packageOrder, ['route' => ['admin.packageOrders.update', $packageOrder->id], 'method' => 'patch', 'id' => 'package-order-form']) !!}
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">@lang('models/packageOrders.cancel_title')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">  
                @if($packageOrder->status == 'paid')              
                <!-- Return Field -->
                <div class="form-group">
                    {!! Form::label('return', __('models/packageOrders.fields.return').':') !!}
                    {!! Form::select('return', [
                        'bank' => __('models/packageOrders.return.bank'),
                        'wallet' => __('models/packageOrders.return.wallet')
                    ], null, ['class' => 'form-control custom-select' . ($errors->has('return') ? ' is-invalid' : ''), 'id'=>'return']) !!}
                    @error('return')
                    <span class="invalid-feedback"> {{ $message }} </span>
                    @enderror
                </div>
                @endif
                <!-- Admin Notes Field -->
                <div class="form-group">
                    {!! Form::label('admin_notes', __('models/packageOrders.fields.admin_notes').':') !!}
                    {!! Form::textarea('admin_notes', null, ['rows' => 3, 'class' => 'form-control' . ($errors->has('admin_notes') ? ' is-invalid' : '')]) !!}
                    @error('admin_notes')
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