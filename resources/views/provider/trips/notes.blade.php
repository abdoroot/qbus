<div class="row">
    <h4 class="card-title col-sm-12">@lang('models/trips.notes_title')</h4>
    <!-- Provider Notes Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('provider_notes', __('models/trips.fields.provider_notes').':') !!}
        {!! Form::textarea('provider_notes', null, ['class' => 'form-control' . ($errors->has('provider_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
        @error('provider_notes')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>

    <!-- Meal Field -->
    <div class="form-group col-sm-12">
        <div class="custom-control custom-checkbox mr-sm-2 mb-3">
            {!! Form::hidden('meal', 0, ['class' => 'form-check-input']) !!}
            {!! Form::checkbox('meal', '1', null, ['class' => 'custom-control-input', 'id' => 'meal']) !!}
            {!! Form::label('meal', __('models/trips.fields.meal'), ['class' => 'custom-control-label']) !!}
        </div>
        @error('meal')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>

    <!-- Hotel Field -->
    <div class="form-group col-sm-12">
        <div class="custom-control custom-checkbox mr-sm-2 mb-3">
            {!! Form::hidden('hotel', 0, ['class' => 'form-check-input']) !!}
            {!! Form::checkbox('hotel', '1', null, ['class' => 'custom-control-input', 'id' => 'hotel']) !!}
            {!! Form::label('hotel', __('models/trips.fields.hotel'), ['class' => 'custom-control-label']) !!}
        </div>
        @error('hotel')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>

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
</div>