<div class="row">
    <h4 class="card-title col-sm-12">@lang('models/trips.bus_title')</h4>
    <!-- Bus Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('bus_id', __('models/trips.fields.bus_id').':') !!}
        {!! Form::select('bus_id', $buses, null, ['class' => 'form-control select2' . ($errors->has('bus_id') ? ' is-invalid' : ''), 'id' => 'bus_id']) !!}
        @error('bus_id')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>

    <!-- Max Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('max', __('models/trips.fields.max').':') !!}
        {!! Form::number('max', null, ['class' => 'form-control' . ($errors->has('max') ? ' is-invalid' : '')]) !!}
        @error('max')
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

</div>