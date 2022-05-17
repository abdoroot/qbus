@foreach($locales as $locale)
<!-- Name {{ $locale }} Field -->
<div class="form-group">
    {!! Form::label("name-{$locale}", __('models/categories.fields.name')." ({$locale}) :") !!}
    {!! Form::text("name[{$locale}]", isset($category) ? $category->getTranslation('name', $locale) : null, ['id' => "name-{$locale}", 'class' => 'form-control' . ($errors->has("name.{$locale}") ? ' is-invalid' : '')]) !!}
    @error("name.{$locale}")
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
@endforeach

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.categories.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>