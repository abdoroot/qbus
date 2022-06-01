<div class="row">
    <h4 class="card-title col-sm-12">@lang('models/busOrders.destination')</h4>
    <h6 class="card-subtitle col-sm-12">@lang('models/busOrders.destination_title')</h6>
    <div class="col-sm-12 mb-3" id="destination">
        <!-- Repeater Heading -->
        <div class="repeater-heading mb-3">
            <h5 class="float-left">@lang('models/busOrders.fields.destination'):</h5>
            <button type="button" class="btn btn-primary float-right repeater-add-btn mb-3">
                @lang('crud.add_new')
            </button>
        </div>
        <div class="clearfix"></div>
        <!-- Repeater Items -->
        <div class="items" data-group="destination">
            <!-- Repeater Content -->
            <div class="item-content">
                <div class="form-group mb-2">
                    {!! Form::select('destination', $cities, null, ['class' => 'form-control select2 custom-select destination' . ($errors->has('destination') ? ' is-invalid' : ''), 'data-skip-name' => 'on']) !!}
                </div>
            </div>
            <!-- Repeater Remove Btn -->
            <div class="float-right repeater-remove-btn">
                <button  type="button" class="btn btn-danger remove-btn mb-3">@lang('crud.remove')</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>