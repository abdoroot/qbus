<!-- Value Field -->
<div class="form-group col-sm-12">
    {!! Form::label($key = $setting->key, __('models/settings.keys.'.$key) . ':') !!}
    @if(($type = $setting->type) == 'file')
    <div class="custom-file">
        {!! Form::file($key, ['id' => $key, 'class' => 'custom-file-input' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
        <label class="custom-file-label" for="{{ $key }}">{{ !is_null($setting->value) ? $setting->value : __('Upload File') }}</label>
        @if ($errors->has($key))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first($key) }}
            </span> 
        @endif
    </div>
    @elseif($type == 'textarea')
        @if(in_array($key, $trans))
            @foreach($locales as $locale)
            {!! Form::textarea($key.'['.$locale.']', $setting->getTranslation('trans', $locale), ['id' => $inputId = "$key-$locale", 'class' => 'form-control mb-2' . ($errors->has("{$key}.{$locale}") ? ' is-invalid' : ''), 'placeholder' => __('models/settings.keys.'.$key) . " ({$locale})", 'rows' => 3]) !!}
            @error("{$key}.{$locale}")
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            @endforeach
        @else
        {!! Form::textarea($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : ''), 'rows' => 3]) !!}
        @endif
    @elseif($type == 'editor')
        @push('page_scripts')
        <script src="{{ asset('elite/assets/node_modules/html5-editor/wysihtml5-0.3.0.js') }}"></script>
        <script src="{{ asset('elite/assets/node_modules/html5-editor/bootstrap-wysihtml5.js') }}"></script>
        @endpush
        @if(in_array($key, $trans))
            @foreach($locales as $locale)
            {!! Form::textarea($key.'['.$locale.']', $setting->getTranslation('trans', $locale), ['id' => $inputId = "$key-$locale", 'class' => 'teaxtarea_editor form-control mb-2' . ($errors->has("{$key}.{$locale}") ? ' is-invalid' : ''), 'placeholder' => __('models/settings.keys.'.$key) . " ({$locale})", 'rows' => 10]) !!}
            @error("{$key}.{$locale}")
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            @push('page_scripts')
            <script>$('#'+"{{ $inputId }}").wysihtml5();</script>
            @endpush
            @endforeach
        @else
        {!! Form::textarea($key, $setting->value, ['id' => $key, 'class' => 'textarea_editor form-control' . ($errors->has($key) ? ' is-invalid' : ''), 'rows' => '10']) !!}
        @push('page_scripts')
        <script>$('#'+"{{ $key }}").wysihtml5();</script>
        @endpush
        @endif
    
    @elseif($type == 'url')
    {!! Form::url($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
    @elseif($type == 'number')
    {!! Form::number($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
    @elseif($type == 'email')
    {!! Form::email($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
    @else
        @if(in_array($key, $trans))
            @foreach($locales as $locale)
            {!! Form::text($key.'['.$locale.']', $setting->getTranslation('trans', $locale), ['id' => "$key-$locale", 'class' => 'form-control mb-2' . ($errors->has("{$key}.{$locale}") ? ' is-invalid' : ''), 'placeholder' => __('models/settings.keys.'.$key) . " ({$locale})"]) !!}
            @error("{$key}.{$locale}")
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            @endforeach
        @else
        {!! Form::text($key, $setting->value, ['id' => $key, 'class' => 'form-control' . ($errors->has($key) ? ' is-invalid' : '')]) !!}
        @endif
    @endif

    @error($key)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>