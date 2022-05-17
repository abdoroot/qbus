<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('models/users.fields.name').'*') !!}
    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
    @error('name')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
    @error('email')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Phone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('phone', __('models/users.fields.phone').'*') !!}
    {!! Form::text('phone', null, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : '')]) !!}
    @error('phone')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', __('models/users.fields.address').'*') !!}
    {!! Form::text('address', null, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : '')]) !!}
    @error('address')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Date Of Birth Field -->
<div class="form-group col-sm-12">
    {!! Form::label('date_of_birth', __('models/users.fields.date_of_birth').'*') !!}
    {!! Form::text('date_of_birth', null, ['class' => 'form-control datepicker-autoclose' . ($errors->has('date_of_birth') ? ' is-invalid' : '')]) !!}
    @error('date_of_birth')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Password Field -->
<div class="form-group col-sm-12">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : '')]) !!}
    @error('password')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', __('models/users.fields.image').':') !!}
    <div class="custom-file">
        {!! Form::file('image', ['id' => 'image', 'class' => 'custom-file-input' . ($errors->has('image') ? ' is-invalid' : '')]) !!}
        <label class="custom-file-label" data-browse="@lang('msg.browse')" for="image">
            @isset($user) {{ $user->image }} @else @lang('msg.upload_file') @endif
        </label>
        @if ($errors->has('image'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('image') }}
            </span> 
        @endif
    </div>
</div>

<!-- Wallet Field -->
<div class="form-group col-sm-12">
    {!! Form::label('wallet', __('models/users.fields.wallet').'*') !!}
    {!! Form::number('wallet', null, ['class' => 'form-control' . ($errors->has('wallet') ? ' is-invalid' : ''), 'step' => '.01']) !!}
    @error('wallet')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<div class="form-group col-sm-12">
    {!! Form::label('marital_status', __('models/users.fields.marital_status').'*', ['class' => 'control-label']) !!}
    @foreach(['single', 'married'] as $maritalStatus)
    <div class="custom-control custom-radio">
        {!! Form::radio('marital_status', $maritalStatus, $maritalStatus == 'primary' && !isset($user) ? true : null, ['id' => "marital-status-{$maritalStatus}", 'class' => 'custom-control-input']) !!}
        {!! Form::label("marital-status-{$maritalStatus}", __("models/users.marital_status.{$maritalStatus}"), ['class' => "custom-control-label text-{$maritalStatus}"]) !!}
    </div>
    @endforeach
</div>

<!-- Notes Field -->
<div class="form-group col-sm-12">
    {!! Form::label('notes', __('models/users.fields.notes').':') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control' . ($errors->has('notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Block Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-switch">
        {!! Form::hidden('block', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('block', '1', null, ['class' => 'custom-control-input', 'id' => 'block']) !!}
        {!! Form::label('block', __('models/users.fields.block'), ['class' => 'custom-control-label']) !!}
      </div>
    @error('block')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Block Notes Field -->
<div class="form-group col-sm-12">
    {!! Form::label('block_notes', __('models/users.fields.block_notes').':') !!}
    {!! Form::textarea('block_notes', null, ['class' => 'form-control' . ($errors->has('block_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('block_notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('admin.users.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>


@push('third_party_stylesheets')
    <!-- Date picker plugins css -->
    <link href="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('page_scripts')
<script>
    function toggleBlockNotes() {
        if($('#block').is(':checked')) $('#block_notes').closest('div').slideDown(); else $('#block_notes').closest('div').slideUp();
    }
    $('#block').on('change', function() {
        toggleBlockNotes();
    })

    $(function() {
        toggleBlockNotes();

        $('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    })
</script>
@endpush