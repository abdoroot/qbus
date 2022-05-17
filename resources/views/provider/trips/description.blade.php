<div class="row">
    {{-- <h4 class="card-title col-sm-12">@lang('models/trips.description_title')</h4> --}}
    @foreach($locales as $locale)
    <!-- Name {{ $locale }} Field -->
    <div class="form-group col-sm-12">
        {!! Form::label("name-{$locale}", __('models/trips.fields.name')." ({$locale}) :") !!}
        {!! Form::text("name[{$locale}]", isset($trip) ? $trip->getTranslation('name', $locale) : null, ['id' => "name-{$locale}", 'class' => 'form-control' . ($errors->has("name.{$locale}") ? ' is-invalid' : '')]) !!}
        @error("name.{$locale}")
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
    <!-- Description {{ $locale }} Field -->
    <div class="form-group col-sm-12">
        {!! Form::label("description-{$locale}", __('models/trips.fields.description')." ({$locale}) :") !!}
        {!! Form::textarea("description[{$locale}]", isset($trip) ? $trip->getTranslation('description', $locale) : null, ['rows' => 3, 'class' => 'form-control' . ($errors->has("description.{$locale}") ? ' is-invalid' : '')]) !!}
        @error("description.{$locale}")
        <span class="invalid-feedback"> {{ $message }} </span>
        @enderror
    </div>
    @endforeach

    <!-- Image Field -->
    <div class="form-group col-sm-12">
        <label for="image">@lang('models/trips.fields.image') </label>
        <div class="custom-file">
            {!! Form::file('image', ['id' => 'image', 'class' => 'custom-file-input' . ($errors->has('image') ? ' is-invalid' : '')]) !!}
            <label class="custom-file-label" data-browse="@lang('msg.browse')" for="image">
                @if(isset($trip) && !is_null($trip->image)) {{ $trip->image }} @else @lang('msg.upload_file') @endif
            </label>
            @if ($errors->has('image'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('image') }}
                </span> 
            @endif
        </div>
    </div>
</div>