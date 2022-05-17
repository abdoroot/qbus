@foreach($locales as $locale)
<!-- Name {{ $locale }} Field -->
<div class="form-group">
    {!! Form::label("name-{$locale}", __('models/packages.fields.name')." ({$locale}) :") !!}
    {!! Form::text("name[{$locale}]", isset($package) ? $package->getTranslation('name', $locale) : null, ['id' => "name-{$locale}", 'class' => 'form-control' . ($errors->has("name.{$locale}") ? ' is-invalid' : '')]) !!}
    @error("name.{$locale}")
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
@endforeach

<!-- Image Field -->
<div class="form-group">
    <label for="image">@lang('models/packages.fields.image') </label>
    <div class="custom-file">
        {!! Form::file('image', ['id' => 'image', 'class' => 'custom-file-input' . ($errors->has('image') ? ' is-invalid' : '')]) !!}
        <label class="custom-file-label" data-browse="@lang('msg.browse')" for="image">
            @if(isset($package) && !is_null($package->image)) {{ $package->image }} @else @lang('msg.upload_file') @endif
        </label>
        @if ($errors->has('image'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('image') }}
            </span> 
        @endif
    </div>
</div>

<div class="mb-3" id="destinations">
    <!-- Repeater Heading -->
    <div class="repeater-heading mb-5">
        <div class="float-left">
            <h4 class="card-title">@lang('models/packages.fields.destinations')</h4>
        </div>
        <button type="button" class="btn btn-primary float-right repeater-add-btn mb-3">
            @lang('crud.add_new')
        </button>
    </div>
    <div class="clearfix"></div>
    <!-- Repeater Items -->
    <div class="items" data-group="destinations">
        <!-- Repeater Content -->
        <div class="item-content row">
            <div class="form-group col-10">
                {!! Form::select('destination_id', $destinations, null, ['class' => 'form-control select2 custom-select' . ($errors->has('destinations') ? ' is-invalid' : ''), 'data-skip-name' => 'on']) !!}
            </div>
            <!-- Repeater Remove Btn -->
            <div class="repeater-remove-btn col-2">
                <button  type="button" class="btn btn-danger remove-btn float-right">@lang('crud.remove')</button>
            </div>
        </div>
    </div>
</div>

<!-- Fees Field -->
<div class="form-group">
    {!! Form::label('fees', __('models/packages.fields.fees').':') !!}
    {!! Form::number('fees', null, ['class' => 'form-control' . ($errors->has('fees') ? ' is-invalid' : ''), 'step' => '.01']) !!}
    @error('fees')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Starting City Id Field -->
<div class="form-group">
    {!! Form::label('starting_city_id', __('models/packages.fields.starting_city_id').':') !!}
    {!! Form::select('starting_city_id', $cities, null, ['class' => 'form-control select2' . ($errors->has('starting_city_id') ? ' is-invalid' : ''), 'id' => 'starting_city_id']) !!}
    @error('starting_city_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="row">
    <!-- Date From Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('date_from', __('models/packages.fields.date_from').':') !!}
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
        {!! Form::label('time_from', __('models/packages.fields.time_from').':') !!}
        {!! Form::time('time_from', null, ['class' => 'form-control timepicker-autoclose' . ($errors->has('time_from') ? ' is-invalid' : ''),'id'=>'time_from', 'placeholder' => 'YYYY-MM-DD']) !!}
        @error('time_from')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
</div>

@foreach($locales as $locale)
<!-- Description {{ $locale }} Field -->
<div class="form-group">
    {!! Form::label("description-{$locale}", __('models/packages.fields.description')." ({$locale}) :") !!}
    {!! Form::textarea("description[{$locale}]", isset($package) ? $package->getTranslation('description', $locale) : null, ['rows' => 3, 'id' => "description-{$locale}", 'class' => 'form-control' . ($errors->has("description.{$locale}") ? ' is-invalid' : '')]) !!}
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
        {!! Form::label('auto_approve', __('models/packages.fields.auto_approve'), ['class' => 'custom-control-label']) !!}
    </div>
    @error('auto_approve')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="row">
<!-- Additional Field -->
{!! Form::label("additionals", __('models/packages.fields.additional')." :", ['class' => 'col-sm-12']) !!}
@foreach($additionals as $i => $additional)
<div class="form-group col-sm-3">
    <div class="custom-control custom-checkbox mr-sm-2 mb-1">
        {!! Form::checkbox("additional[$i][id]", $id = $additional->id, null, ['class' => 'custom-control-input', 'id' => "additional-{$id}"]) !!}
        {!! Form::label("additional-{$id}", $additional->name, ['class' => 'custom-control-label']) !!}
    </div>
</div>

<!-- Fees Field -->
<div class="form-group col-sm-9">
    {!! Form::number("additional[$i][fees]", null, ['class' => 'form-control' . ($errors->has("additional.{$i}.fees") ? ' is-invalid' : ''), 'step' => '.01', 'placeholder' => __('models/packages.fields.fees')]) !!}
    @error("additional.{$i}.fees")
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
@endforeach
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('provider.packages.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>


@push('page_scripts')
<script>
    $(document).ready(function(){
        // Datepicker 
        $('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        @if(!is_null(old('destinations')))
        values = {!! json_encode(array_map(function($destination_id, $index) {
            return ['destinations['.$index.']' => $destination_id];
        }, old('destinations'), array_keys(old('destinations')))) !!};
        @elseif(isset($package))
        values = {!! json_encode(array_map(function($destination_id, $index) {
            return ['destinations['.$index.']' => $destination_id];
        }, $package->destinations ?? [], array_keys($package->destinations ?? []))) !!};
        @else
        values = [];
        @endif

        /* Create Repeater */
        $("#destinations").createRepeater({
            showFirstItemToDefault: true,
            disableFirstItemRemoveButton: true,
            values: values
        });
        
        // select2
        $('.select2').select2();
    });
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
<!-- Import repeater js  -->
<script src="{{ asset('js/repeater.js') }}" type="text/javascript"></script>
@endpush