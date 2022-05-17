<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/coupons.fields.status').':') !!}
    {!! Form::select('status', [
        'pending' => __('models/coupons.status.pending'),
        'approved' => __('models/coupons.status.approved'),
        'rejected' => __('models/coupons.status.rejected'),
    ], null, ['class' => 'form-control select2 custom-select' . ($errors->has('status') ? ' is-invalid' : ''),'id'=>'status']) !!}
    @error('status')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Admin Notes Field -->
<div class="form-group">
    {!! Form::label('admin_notes', __('models/coupons.fields.admin_notes').':') !!}
    {!! Form::textarea('admin_notes', null, ['rows' => 3, 'class' => 'form-control' . ($errors->has('admin_notes') ? ' is-invalid' : '')]) !!}
    @error('admin_notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.coupons.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>