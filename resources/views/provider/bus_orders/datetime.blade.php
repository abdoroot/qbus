<div class="row">
    <h4 class="card-title col-sm-12">@lang('models/busOrders.datetime_title')</h4>
    <!-- Date From Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('date_from', __('models/busOrders.fields.date_from').':') !!}
        <div class="input-group">
            {!! Form::text('date_from', null, ['class' => 'form-control datepicker-autoclose' . ($errors->has('date_from') ? ' is-invalid' : ''),'id'=>'date_from', 'placeholder' => 'YYYY-MM-DD']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="icon-calender"></i></span>
            </div>
        </div>
        @error('date_from')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
    <!-- Time From Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('time_from', __('models/busOrders.fields.time_from').':') !!}
        {!! Form::time('time_from', null, ['class' => 'form-control timepicker-autoclose' . ($errors->has('time_from') ? ' is-invalid' : ''),'id'=>'time_from', 'placeholder' => 'YYYY-MM-DD']) !!}
        @error('time_from')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
    <!-- Date To Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('date_to', __('models/busOrders.fields.date_to').':') !!}
        <div class="input-group">
            {!! Form::text('date_to', null, ['class' => 'form-control datepicker-autoclose' . ($errors->has('date_to') ? ' is-invalid' : ''),'id'=>'date_to', 'placeholder' => 'YYYY-MM-DD']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="icon-calender"></i></span>
            </div>
        </div>
        @error('date_to')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
    <!-- Time To Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('time_to', __('models/busOrders.fields.time_to').':') !!}
        {!! Form::time('time_to', null, ['class' => 'form-control timepicker-autoclose' . ($errors->has('time_to') ? ' is-invalid' : ''),'id'=>'time_to', 'placeholder' => 'YYYY-MM-DD']) !!}
        @error('time_to')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
</div>