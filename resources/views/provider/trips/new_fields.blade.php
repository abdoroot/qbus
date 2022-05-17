<!-- Destination Id Field -->
<div class="form-group">
    {!! Form::label('destination_id', __('models/trips.fields.destination_id').':') !!}
    {!! Form::select('destination_id', $destinations, null, ['class' => 'form-control select2 custom-select' . ($errors->has('destination_id') ? ' is-invalid' : ''),'id'=>'destination_id']) !!}
    @error('destination_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="row">
    <!-- Date From Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('date_from', __('models/trips.fields.date_from').':') !!}
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
        {!! Form::label('time_from', __('models/trips.fields.time_from').':') !!}
        {!! Form::time('time_from', null, ['class' => 'form-control timepicker-autoclose' . ($errors->has('time_from') ? ' is-invalid' : ''),'id'=>'time_from', 'placeholder' => 'YYYY-MM-DD']) !!}
        @error('time_from')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
    <!-- Date To Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('date_to', __('models/trips.fields.date_to').':') !!}
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
        {!! Form::label('time_to', __('models/trips.fields.time_to').':') !!}
        {!! Form::time('time_to', null, ['class' => 'form-control timepicker-autoclose' . ($errors->has('time_to') ? ' is-invalid' : ''),'id'=>'time_to', 'placeholder' => 'YYYY-MM-DD']) !!}
        @error('time_to')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
</div>

<!-- Bus Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('bus_id', __('models/trips.fields.bus_id').':') !!}
    {!! Form::select('bus_id', $buses, null, ['class' => 'form-control select2' . ($errors->has('bus_id') ? ' is-invalid' : ''), 'id' => 'bus_id']) !!}
    @error('bus_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Fees Field -->
<div class="form-group col-sm-12">
    {!! Form::label('fees', __('models/trips.fields.fees').':') !!}
    {!! Form::number('fees', null, ['class' => 'form-control' . ($errors->has('fees') ? ' is-invalid' : '')]) !!}
    @error('fees')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

@foreach($locales as $locale)
<!-- Description {{ $locale }} Field -->
<div class="form-group col-sm-12">
    {!! Form::label("description-{$locale}", __('models/trips.fields.description')." ({$locale}) :") !!}
    {!! Form::textarea("description[{$locale}]", isset($trip) ? $trip->getTranslation('description', $locale) : null, ['rows' => 3, 'class' => 'form-control' . ($errors->has("description.{$locale}") ? ' is-invalid' : '')]) !!}
    @error("description.{$locale}")
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
@endforeach

<!-- Auto Approve Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-checkbox mr-sm-2 mb-3">
        {!! Form::hidden('auto_approve', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('auto_approve', '1', null, ['class' => 'custom-control-input', 'id' => 'auto_approve']) !!}
        {!! Form::label('auto_approve', __('models/trips.fields.auto_approve'), ['class' => 'custom-control-label']) !!}
    </div>
    @error('auto_approve')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="row">
    <!-- Additional Field -->
    {!! Form::label("additionals", __('models/trips.fields.additional')." :", ['class' => 'col-sm-12']) !!}
    @foreach($additionals as $i => $additional)
    <div class="form-group col-sm-3">
        <div class="custom-control custom-checkbox mr-sm-2 mb-1">
            {!! Form::checkbox("additional[$i][id]", $id = $additional->id, null, ['class' => 'custom-control-input', 'id' => "additional-{$id}"]) !!}
            {!! Form::label("additional-{$id}", $additional->name, ['class' => 'custom-control-label']) !!}
        </div>
    </div>
    
    <!-- Fees Field -->
    <div class="form-group col-sm-9">
        {!! Form::number("additional[$i][fees]", null, ['class' => 'form-control' . ($errors->has("additional.{$i}.fees") ? ' is-invalid' : ''), 'step' => '.01', 'placeholder' => __('models/trips.fields.fees')]) !!}
        @error("additional.{$i}.fees")
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
    @endforeach
    </div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('provider.trips.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>

@push('page_scripts')
<script>
    $(document).ready(function() {
        // select2
        $('.select2').select2();
        // Datepicker 
        $('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    })
</script>
@endpush

@push('third_party_stylesheets')
<!-- Date picker plugins css -->
<link href="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Select2 plugins css -->
<link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- iCheck -->
<link href="{{ asset('elite/assets/node_modules/icheck/skins/all.css') }}" rel="stylesheet">
@endpush

@push('third_party_scripts')
<!-- Date Picker Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- Select2 Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush