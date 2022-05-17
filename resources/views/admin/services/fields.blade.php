@foreach($locales as $locale)
<!-- Title {{ $locale }} Field -->
<div class="form-group col-sm-12">
    {!! Form::label("title-{$locale}", __('models/services.fields.title')." ({$locale}) :") !!}
    {!! Form::text("title[{$locale}]", isset($service) ? $service->getTranslation('title', $locale) : null, ['id' => "title-{$locale}", 'class' => 'form-control' . ($errors->has("title.{$locale}") ? ' is-invalid' : '')]) !!}
    @error("title.{$locale}")
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
<!-- Text {{ $locale }} Field -->
<div class="form-group col-sm-12">
    {!! Form::label("text-{$locale}", __('models/services.fields.text')." ({$locale}) :") !!}
    {!! Form::textarea("text[{$locale}]", isset($service) ? $service->getTranslation('text', $locale) : null, ['rows' => 3, 'class' => 'form-control' . ($errors->has("text.{$locale}") ? ' is-invalid' : '')]) !!}
    @error("text.{$locale}")
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
@endforeach

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', __('models/services.fields.image')) !!}
    <div class="input-group">
        <div class="custom-file mb-3">
            {!! Form::file('image', ['class' => 'custom-file-input' . ($errors->has('image') ? ' is-invalid' : '')]) !!}
            {!! Form::label('image', isset($Service) ? $service->image : __('msg.updoad_file'), ['class' => 'custom-file-label form-control', 'data-browse' => __('msg.browse')]) !!}
        </div>
    </div>
    @error('image')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.services.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>