@foreach($locales as $locale)
<!-- Name {{ $locale }} Field -->
<div class="form-group">
    {!! Form::label("name-{$locale}", __('models/additionals.fields.name')." ({$locale}) :") !!}
    {!! Form::text("name[{$locale}]", isset($additional) ? $additional->getTranslation('name', $locale) : null, ['id' => "name-{$locale}", 'class' => 'form-control' . ($errors->has("name.{$locale}") ? ' is-invalid' : '')]) !!}
    @error("name.{$locale}")
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
@endforeach

<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', __('models/additionals.fields.icon').':') !!}
    {!! Form::text('icon', null, ['class' => 'form-control' . ($errors->has('icon') ? ' is-invalid' : '')]) !!}
    @error('icon')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.additionals.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>