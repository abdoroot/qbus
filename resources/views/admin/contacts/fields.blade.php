@if(!isset($contact))
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/contacts.fields.name').'*') !!}
    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
    @error('name')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/contacts.fields.email').'*') !!}
    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
    @error('email')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Subject Field -->
<div class="form-group">
    {!! Form::label('subject', __('models/contacts.fields.subject').'*') !!}
    {!! Form::text('subject', null, ['class' => 'form-control' . ($errors->has('subject') ? ' is-invalid' : '')]) !!}
    @error('subject')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Message Field -->
<div class="form-group">
    {!! Form::label('message', __('models/contacts.fields.message').'*') !!}
    {!! Form::textarea('message', null, ['class' => 'form-control' . ($errors->has('message') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('message')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

@endif

<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('text', __('models/contacts.fields.type').'*', ['class' => 'control-label']) !!}
        @foreach([
            'primary' => 'contact', 
            'info' => 'enquiry', 
            'success' => 'suggestion', 
            'warning' => 'help', 
            'danger' => 'complaint', 
            'primary' => 'feedback'
            ] as $key => $type)
        <div class="custom-control custom-radio">
            {!! Form::radio('type', $type, $type == 'contact' && !isset($contact) ? true : null, ['id' => "type-{$type}", 'class' => 'custom-control-input']) !!}
            {!! Form::label("type-{$type}", __("models/contacts.types.{$type}"), ['class' => "custom-control-label text-{$key}"]) !!}
        </div>
        @endforeach
    </div>
</div>

<!-- Reply Message Field -->
<div class="form-group">
    {!! Form::label('reply_message', __('models/contacts.fields.reply_message').':') !!}
    {!! Form::textarea('reply_message', null, ['class' => 'form-control' . ($errors->has('reply_message') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('reply_message')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.contacts.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>