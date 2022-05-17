{!! Form::hidden('back_to', $back_to = (isset($back_to) && !is_null($back_to) ? $back_to : route('admin.accounts.index'))) !!}

<!-- Provider Id Field -->
<div class="form-group">
    {!! Form::label('provider_id', __('models/accounts.fields.provider_id').':') !!}
    {!! Form::select('provider_id', App\Models\Provider::pluck('name', 'id'), isset($provider_id) && !is_null($provider_id) ? $provider_id : null, ['class' => 'form-control select2 custom-select' . ($errors->has('provider_id') ? ' is-invalid' : ''),'id'=>'provider_id']) !!}
    @error('provider_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', __('models/accounts.fields.username').'*') !!}
    {!! Form::text('username', null, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : '')]) !!}
    @error('username')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', __('models/accounts.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : '')]) !!}
    @error('password')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Active Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-switch">
        {!! Form::hidden('active', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('active', '1', null, ['class' => 'custom-control-input', 'id' => 'active']) !!}
        {!! Form::label('active', __('models/accounts.fields.active'), ['class' => 'custom-control-label']) !!}
      </div>
    @error('active')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/accounts.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
    @error('email')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/accounts.fields.phone').':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : '')]) !!}
    @error('phone')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('text', __('models/accounts.fields.role').'*', ['class' => 'control-label']) !!}
        @foreach(['admin', 'driver'] as $role)
        <div class="custom-control custom-radio">
            {!! Form::radio('role', $role, null, ['id' => "role-{$role}", 'class' => 'custom-control-input']) !!}
            {!! Form::label("role-{$role}", __("models/accounts.roles.{$role}"), ['class' => "custom-control-label"]) !!}
        </div>
        @endforeach
    </div>
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ $back_to }}" class="btn btn-dark">@lang('crud.cancel')</a>

@push('third_party_stylesheets')
    <!-- Select2 plugins css -->
    <link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <!-- Select2 Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endpush