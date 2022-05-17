<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/coupons.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
    @error('name')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Date From Field -->
<div class="form-group">
    {!! Form::label('date_from', __('models/coupons.fields.date_from').':') !!}
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

<!-- Date To Field -->
<div class="form-group">
    {!! Form::label('date_to', __('models/coupons.fields.date_to').':') !!}
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

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', __('models/coupons.fields.type').':') !!}
    {!! Form::select('type', [
            'amount' => __('models/coupons.types.amount'),
            'percentage' => __('models/coupons.types.percentage') 
        ], null, ['class' => 'form-control select2 custom-select' . ($errors->has('type') ? ' is-invalid' : ''),'id'=>'type']) !!}
    @error('type')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Discount Field -->
<div class="form-group">
    {!! Form::label('discount', __('models/coupons.fields.discount').':') !!}
    {!! Form::number('discount', null, ['class' => 'form-control' . ($errors->has('discount') ? ' is-invalid' : ''), 'step' => '0.01']) !!}
    @error('discount')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('provider.coupons.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>

@push('third_party_stylesheets')
    <!-- Date picker plugins css -->
    <link href="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    </script>
@endpush