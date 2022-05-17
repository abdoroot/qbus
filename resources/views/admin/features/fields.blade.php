@foreach($locales as $locale)
<!-- Title {{ $locale }} Field -->
<div class="form-group col-sm-12">
    {!! Form::label("title-{$locale}", __('models/features.fields.title')." ({$locale}) :") !!}
    {!! Form::text("title[{$locale}]", isset($feature) ? $feature->getTranslation('title', $locale) : null, ['id' => "title-{$locale}", 'class' => 'form-control' . ($errors->has("title.{$locale}") ? ' is-invalid' : '')]) !!}
    @error("title.{$locale}")
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
<!-- Text {{ $locale }} Field -->
<div class="form-group col-sm-12">
    {!! Form::label("text-{$locale}", __('models/features.fields.text')." ({$locale}) :") !!}
    {!! Form::textarea("text[{$locale}]", isset($feature) ? $feature->getTranslation('text', $locale) : null, ['rows' => 3, 'class' => 'form-control' . ($errors->has("text.{$locale}") ? ' is-invalid' : '')]) !!}
    @error("text.{$locale}")
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
@endforeach

{{-- <!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', __('models/features.fields.icon')) !!}
    <div class="input-group">
        <div class="custom-file mb-3">
            {!! Form::file('icon', ['class' => 'custom-file-input' . ($errors->has('icon') ? ' is-invalid' : '')]) !!}
            {!! Form::label('icon', isset($Feature) ? $feature->icon : __('msg.updoad_file'), ['class' => 'custom-file-label form-control', 'data-browse' => __('msg.browse')]) !!}
        </div>
    </div>
    @error('icon')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div> --}}

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.features.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>