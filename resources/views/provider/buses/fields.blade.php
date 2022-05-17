<!-- Plate Field -->
<div class="form-group">
    {!! Form::label('plate', __('models/buses.fields.plate').':') !!}
    {!! Form::text('plate', null, ['class' => 'form-control' . ($errors->has('plate') ? ' is-invalid' : '')]) !!}
    @error('plate')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', __('models/buses.fields.image')) !!}
    <div class="input-group">
        <div class="custom-file mb-3">
            {!! Form::file('image', ['class' => 'custom-file-input' . ($errors->has('image') ? ' is-invalid' : '')]) !!}
            {!! Form::label('image', isset($Bus) ? $bus->image : __('msg.updoad_file'), ['class' => 'custom-file-label form-control', 'data-browse' => __('msg.browse')]) !!}
        </div>
    </div>
    @error('image')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Passengers Field -->
<div class="form-group">
    {!! Form::label('passengers', __('models/buses.fields.passengers').':') !!}
    {!! Form::number('passengers', null, ['class' => 'form-control' . ($errors->has('passengers') ? ' is-invalid' : '')]) !!}
    @error('passengers')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Account Id Field -->
<div class="form-group">
    {!! Form::label('account_id', __('models/buses.fields.account_id').':') !!}
    {!! Form::select('account_id', $accounts, null, ['class' => 'form-control select2 custom-select' . ($errors->has('account_id') ? ' is-invalid' : ''),'id'=>'account_id', 'placeholder' => __('msg.select')]) !!}
    @error('account_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Active Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-switch">
        {!! Form::hidden('active', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('active', '1', null, ['class' => 'custom-control-input', 'id' => 'active']) !!}
        {!! Form::label('active', __('models/buses.fields.active'), ['class' => 'custom-control-label']) !!}
      </div>
    @error('active')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

@push('third_party_stylesheets')
    <!-- Select2 plugins css -->
    <link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <!-- Select2 Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endpush

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('provider.buses.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>