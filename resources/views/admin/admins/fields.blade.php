<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('models/admins.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
    @error('name')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', __('models/admins.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->first('email') ? ' is-invalid' : '')]) !!}
    @error('email')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Password Field -->
<div class="form-group col-sm-12">
    {!! Form::label('password', __('models/admins.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control' . ($errors->first('password') ? ' is-invalid' : '')]) !!}
    @error('password')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Active Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-checkbox mr-sm-2 mb-3">
        {!! Form::hidden('active', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('active', '1', null, ['class' => 'custom-control-input', 'id' => 'active']) !!}
        {!! Form::label('active', __('models/admins.fields.active'), ['class' => 'custom-control-label']) !!}
    </div>
    @error('active')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.admins.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>