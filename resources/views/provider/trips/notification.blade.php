<div id="notification-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {!! Form::open(['route' => ['provider.trips.notification', $trip->id], 'method' => 'post']) !!}
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">@lang('msg.send_notification')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">                
                <!-- Text Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('text', __('models/notifications.fields.text').':') !!}
                    {!! Form::textarea('text', null, ['class' => 'form-control' . ($errors->has('text') ? ' is-invalid' : ''), 'rows' => 5]) !!}
                    @error('text')
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