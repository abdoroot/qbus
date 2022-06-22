<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/chats.fields.title').'*') !!}
    {!! Form::text('title', null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : '')]) !!}
    @error('title')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Text Field -->
<div class="form-group">
    {!! Form::label('text', __('models/chats.fields.text').'*') !!}
    {!! Form::textarea('text', null, ['class' => 'form-control' . ($errors->has('text') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('text')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('text', __('models/chats.fields.type').'*', ['class' => 'control-label']) !!}
        @foreach(['primary', 'info', 'success', 'warning', 'danger'] as $type)
        <div class="custom-control custom-radio">
            {!! Form::radio('type', $type, $type == 'primary' && !isset($chat) ? true : null, ['id' => "type-{$type}", 'class' => 'custom-control-input']) !!}
            {!! Form::label("type-{$type}", __("models/chats.types.{$type}"), ['class' => "custom-control-label text-{$type}"]) !!}
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    {!! Form::label('to', __('models/chats.fields.to').'*') !!}
    {!! Form::select('to', [
        'provider' => __('models/providers.singular'),
        'user' => __('models/users.singular'),
        'provider' => __('models/providers.singular')
        ], null, ['class' => 'form-control selectpicker' . ($errors->has('to') ? ' is-invalid' : '')]) !!}

    @error('to')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="form-group to-div" id="provider-div">
    {!! Form::label('provider_id', __('models/chats.fields.provider_id').':') !!}
    <div class="custom-control custom-checkbox d-inline-block float-right">
        {!! Form::checkbox('all_providers', '1', null, ['class' => 'custom-control-input check-all', 'id' => 'all-providers']) !!}
        {!! Form::label('all-providers', __('models/chats.to.all_providers'), ['class' => 'custom-control-label']) !!}
    </div>
    {!! Form::select('providers[]', App\Models\Admin::where('id', '!=', Auth::guard('provider')->user()->id)->pluck('name', 'id'), null, ['class' => 'form-control custom-select select2' . ($errors->has('providers') ? ' is-invalid' : ''), 'multiple' => true, 'id' => 'provider_id']) !!}
    @error('providers')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="form-group to-div" id="user-div">
    {!! Form::label('user_id', __('models/chats.fields.user_id').':') !!}
    <div class="custom-control custom-checkbox d-inline-block float-right">
        {!! Form::checkbox('all_users', '1', null, ['class' => 'custom-control-input check-all', 'id' => 'all-users']) !!}
        {!! Form::label('all-users', __('models/chats.to.all_users'), ['class' => 'custom-control-label']) !!}
    </div>
    {!! Form::select('users[]', App\Models\User::pluck('name', 'id'), null, ['class' => 'form-control custom-select select2' . ($errors->has('users') ? ' is-invalid' : ''), 'multiple' => true, 'id' => 'user_id']) !!}
    @error('users')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="form-group to-div" id="provider-div">
    {!! Form::label('provider_id', __('models/chats.fields.provider_id').':') !!}
    <div class="custom-control custom-checkbox d-inline-block float-right">
        {!! Form::checkbox('all_providers', '1', null, ['class' => 'custom-control-input check-all', 'id' => 'all-providers']) !!}
        {!! Form::label('all-providers', __('models/chats.to.all_providers'), ['class' => 'custom-control-label']) !!}
    </div>
    {!! Form::select('providers[]', App\Models\Provider::pluck('name', 'id'), null, ['class' => 'form-control custom-select select2' . ($errors->has('providers') ? ' is-invalid' : ''), 'multiple' => true, 'id' => 'provider_id']) !!}
    @error('providers')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', __('models/chats.fields.url').':') !!}
    {!! Form::text('url', null, ['class' => 'form-control' . ($errors->has('url') ? ' is-invalid' : '')]) !!}
    @error('url')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', __('models/chats.fields.icon').':') !!}
    {!! Form::text('icon', null, ['class' => 'form-control' . ($errors->has('icon') ? ' is-invalid' : '')]) !!}
    <small id="iconlHelp" class="form-text text-muted">ex: fa fa-user / icon-heart / ti-settings ...</small>
    @error('icon')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('provider.chats.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>

@push('third_party_stylesheets')
    <!-- Select2 plugins css -->
    <link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <!-- Select2 Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('.select2').select2();
        $('.selectpicker').selectpicker();

        $(".check-all").on('change', function() {
            let select = $(this).closest('div').parent().find('select');
            if($(this).is(':checked')) {
                select.select2('destroy').find('option').prop('selected', 'selected').end().select2();
            } else {
                select.select2('destroy').find('option').prop('selected', false).end().select2();
            }
        });

        $('#to').on('change', function() {
            providerOrUser();
        })

        $(function() {
            providerOrUser();
        })

        function providerOrUser() {
            $('.to-div').hide();
            $(`#${$('#to').val()}-div`).slideDown();
        }
    </script>
@endpush