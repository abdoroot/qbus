<!-- From City Id Field -->
<div class="form-group">
    {!! Form::label('from_city_id', __('models/destinations.fields.from_city_id').':') !!}
    {!! Form::select('from_city_id', $cities, null, ['class' => 'form-control select2 custom-select' . ($errors->has('from_city_id') ? ' is-invalid' : ''),'id'=>'from_city_id']) !!}
    @error('from_city_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- To City Id Field -->
<div class="form-group">
    {!! Form::label('to_city_id', __('models/destinations.fields.to_city_id').':') !!}
    {!! Form::select('to_city_id', $cities, null, ['class' => 'form-control select2 custom-select' . ($errors->has('to_city_id') ? ' is-invalid' : ''),'id'=>'to_city_id']) !!}
    @error('to_city_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Starting Terminal Id Field -->
<div class="form-group">
    {!! Form::label('starting_terminal_id', __('models/destinations.fields.starting_terminal_id').':') !!}
    {!! Form::select('starting_terminal_id', $terminals, null, ['class' => 'form-control select2 custom-select' . ($errors->has('starting_terminal_id') ? ' is-invalid' : ''),'id'=>'starting_terminal_id']) !!}
    @error('starting_terminal_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="mb-3" id="stops">
    <!-- Repeater Heading -->
    <div class="repeater-heading mb-5">
        <div class="float-left">
            <h4 class="card-title">@lang('models/packages.fields.stops')</h4>
        </div>
        <button type="button" class="btn btn-primary float-right repeater-add-btn mb-3">
            @lang('crud.add_new')
        </button>
    </div>
    <div class="clearfix"></div>
    <!-- Repeater Items -->
    <div class="items" data-group="stops">
        <!-- Repeater Content -->
        <div class="item-content row">
            <div class="form-group col-10">
                {!! Form::select('terminal_id', $terminals, null, ['class' => 'form-control select2 custom-select' . ($errors->has('stops') ? ' is-invalid' : ''), 'data-skip-name' => 'on']) !!}
            </div>
            <!-- Repeater Remove Btn -->
            <div class="repeater-remove-btn col-2">
                <button  type="button" class="btn btn-danger remove-btn float-right">@lang('crud.remove')</button>
            </div>
        </div>
    </div>
</div>

<!-- Arrival Terminal Id Field -->
<div class="form-group">
    {!! Form::label('arrival_terminal_id', __('models/destinations.fields.arrival_terminal_id').':') !!}
    {!! Form::select('arrival_terminal_id', $terminals, null, ['class' => 'form-control select2 custom-select' . ($errors->has('arrival_terminal_id') ? ' is-invalid' : ''),'id'=>'arrival_terminal_id']) !!}
    @error('arrival_terminal_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('provider.destinations.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>

@push('page_scripts')
<script>
    $(document).ready(function() {
        /* Create Repeater */
        @if(!is_null(old('stops')))
        values = {!! json_encode(array_map(function($terminalId, $index) {
            return ['stops['.$index.']' => $terminalId];
        }, old('stops'), array_keys(old('stops')))) !!};
        @elseif(isset($destination))
        values = {!! json_encode(array_map(function($terminal, $index) {
            return ['stops['.$index.']' => $terminal['id']];
        }, $stopTerminals = json_decode(json_encode($destination->stopTerminals()),true), array_keys($stopTerminals))) !!};
        @else
        values = [
            {'stops[0]': null},
        ];
        @endif
        var repeater = $("#stops").createRepeater({
            showFirstItemToDefault: true,
            disableFirstItemRemoveButton: false,
            values: values
        });
        $('.select2').select2();
    });
</script>
@endpush

@push('third_party_stylesheets')
<!-- Select2 plugins css -->
<link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
<!-- Select2 Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Import repeater js  -->
<script src="{{ asset('js/repeater.js') }}" type="text/javascript"></script>
@endpush
