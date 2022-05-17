<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/emails.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
    @error('email')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.emails.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>