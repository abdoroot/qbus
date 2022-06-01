<div class="row">
    <h4 class="card-title col-sm-12">@lang('models/busOrders.bus')</h4>
    <h6 class="card-subtitle col-sm-12">@lang('models/busOrders.bus_title')</h6>
    <!-- Bus Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('bus_id', __('models/busOrders.fields.bus_id').':') !!}
        {!! Form::select('bus_id', $buses, null, ['id' => 'bus_id', 'class' => 'form-control custom-select' . ($errors->has('bus_id') ? ' is-invalid' : '')]) !!}
        @error('bus_id')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
    <!-- Fees Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('fees', __('models/busOrders.fields.fees').':') !!}
        {!! Form::number('fees', null, ['class' => 'form-control' . ($errors->has('fees') ? ' is-invalid' : ''), 'id'=>'fees', 'step' => '0.01']) !!}
        @error('fees')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
    <!-- Tax -->
    <div class="form-group col-sm-6">
        {!! Form::label('fees', __('models/busOrders.fields.tax').': ') !!} 
        <span id="tax"></span> 
    </div>
    <!-- Total -->
    <div class="form-group col-sm-6">
        {!! Form::label('fees', __('models/busOrders.fields.total').': ') !!} 
        <span id="total"></span> 
    </div>
</div>