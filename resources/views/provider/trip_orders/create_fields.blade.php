<!-- Trip Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('trip_id', __('models/tripOrders.fields.trip_id').':') !!}
    {!! Form::select('trip_id', $trips, null, ['class' => 'form-control select2' . ($errors->has('trip_id') ? ' is-invalid' : ''), 'id' => 'trip_id']) !!}
    @error('trip_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user_id', __('models/tripOrders.fields.user_id').':') !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control select2' . ($errors->has('user_id') ? ' is-invalid' : ''), 'id' => 'user_id']) !!}
    @error('user_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Count Field -->
<div class="form-group col-sm-12">
    {!! Form::label('count', __('models/trips.fields.count').':') !!}
    {!! Form::number('count', null, ['class' => 'form-control' . ($errors->has('count') ? ' is-invalid' : '')]) !!}
    @error('count')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Coupon Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('coupon_id', __('models/tripOrders.fields.coupon_id').':') !!}
    {!! Form::select('coupon_id', $coupons, null, ['placeholder' => __('msg.none'), 'class' => 'form-control select2' . ($errors->has('coupon_id') ? ' is-invalid' : ''), 'id' => 'coupon_id']) !!}
    @error('coupon_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', __('models/tripOrders.fields.type').'*') !!}
    {!! Form::select('type', [
        'one-way' => __('models/tripOrders.types.one-way'),
        'round' => __('models/tripOrders.types.round'),
        'multi' => __('models/tripOrders.types.multi'),
    ], null, ['id' => 'type', 'class' => 'form-control selectpicker' . ($errors->has('type') ? ' is-invalid' : '')]) !!}

    @error('type')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- User Notes Field -->
<div class="form-group">
    {!! Form::label('user_notes', __('models/tripOrders.fields.user_notes').'*') !!}
    {!! Form::textarea('user_notes', null, ['class' => 'form-control' . ($errors->has('user_notes') ? ' is-invalid' : ''), 'rows' => 3]) !!}
    @error('user_notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/tripOrders.fields.status').'*') !!}
    {!! Form::select('status', $status, null, ['id' => 'status', 'class' => 'form-control selectpicker' . ($errors->has('status') ? ' is-invalid' : '')]) !!}

    @error('status')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Provider Notes Field -->
<div class="form-group">
    {!! Form::label('provider_notes', __('models/tripOrders.fields.provider_notes').'*') !!}
    {!! Form::textarea('provider_notes', null, ['class' => 'form-control' . ($errors->has('provider_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('provider_notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('provider.tripOrders.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>

@push('third_party_stylesheets')
<link href="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Select2 plugins css -->
<link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
<script src="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"></script>
<!-- Select2 Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@push('page_scripts')
<script>
    $('.selectpicker').selectpicker();
    $('.select2').select2();
</script>
@endpush