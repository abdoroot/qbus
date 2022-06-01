<div class="row">
    <!-- User Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('user_id', __('models/tripOrders.fields.user_id').':') !!}
        {!! Form::select('user_id', $users, null, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'id' => 'user_id']) !!}
        @error('user_id')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>

    <!-- User Notes Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('user_notes', __('models/busOrders.fields.user_notes').':') !!}
        {!! Form::textarea('user_notes', null, ['class' => 'form-control' . ($errors->has('user_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
        @error('user_notes')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>

    <!-- Status Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('status', __('models/busOrders.fields.status').'*') !!}
        {!! Form::select('status', $status, null, ['id' => 'status', 'class' => 'form-control selectpicker' . ($errors->has('status') ? ' is-invalid' : '')]) !!}

        @error('status')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>

    <!-- Provider Notes Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('provider_notes', __('models/busOrders.fields.provider_notes').':') !!}
        {!! Form::textarea('provider_notes', null, ['class' => 'form-control' . ($errors->has('provider_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
        @error('provider_notes')
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
</div>