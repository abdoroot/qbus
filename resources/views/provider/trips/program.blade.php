<div class="row">
    <h4 class="card-title col-sm-12">@lang('models/trips.program')</h4>
    <h6 class="card-subtitle col-sm-12">@lang('models/trips.program_title')</h6>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('text', __('models/trips.fields.type').'*', ['class' => 'control-label']) !!}
            @foreach(['one-way', 'round', 'multi'] as $type)
            <div class="custom-control custom-radio">
                {!! Form::radio('type', $type, !isset($account) && $type == 'one-way' ? true : null, ['id' => "type-{$type}", 'class' => 'custom-control-input']) !!}
                {!! Form::label("type-{$type}", __("models/trips.types.{$type}"), ['class' => "custom-control-label"]) !!}
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-12 mb-3" id="program">
        <!-- Repeater Heading -->
        <div class="repeater-heading mb-3">
            <button type="button" class="btn btn-primary float-right repeater-add-btn mb-3">
                @lang('crud.add_new')
            </button>
        </div>
        <div class="clearfix"></div>
        <!-- Repeater Items -->
        <div class="items" data-group="program">
            <!-- Repeater Content -->
            <div class="item-content">
                <div class="form-group mb-2">
                    {!! Form::select('city_id', $cities, null, ['class' => 'form-control select2 program-city-id' . ($errors->has('program') ? ' is-invalid' : ''), 'data-name' => 'city_id']) !!}
                </div>
                <div class="form-group mb-2">
                    {!! Form::textarea('description', null, ['rows' => 2, 'class' => 'form-control program-description' . ($errors->has('program') ? ' is-invalid' : ''), 'data-name' => 'description']) !!}
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