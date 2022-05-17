
@if(!in_array($busOrder->status, ['canceled', 'rejected', 'complete']))
<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/busOrders.fields.status').'*') !!}
    {!! Form::select('status', $status, null, ['id' => 'status', 'class' => 'form-control selectpicker' . ($errors->has('status') ? ' is-invalid' : '')]) !!}

    @error('status')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

@if($busOrder->status == 'paid')              
<!-- Return Field -->
<div class="form-group return-div {{  old('status') == 'rejected' ? '' : 'd-none' }}">
    {!! Form::label('return', __('models/busOrders.fields.return').':') !!}
    {!! Form::select('return', [
        'bank' => __('models/busOrders.return.bank'),
        'wallet' => __('models/busOrders.return.wallet')
    ], null, ['class' => 'form-control custom-select' . ($errors->has('return') ? ' is-invalid' : ''), 'id'=>'return']) !!}
    @error('return')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>
@else

<!-- Fees Field -->
<div class="form-group fees-div {{  old('status') == 'rejected' ? 'd-none' : '' }}">
    {!! Form::label('fees', __('models/busOrders.fields.fees').':') !!}
    {!! Form::text('fees', null, ['class' => 'form-control' . ($errors->has('fees') ? ' is-invalid' : '')]) !!}
    @error('fees')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

@endif

@push('third_party_stylesheets')
    <link href="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <script src="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('.selectpicker').selectpicker();
        $('#status').on('change', function() {
            if($(this).val() == 'rejected') {
                $('.return-div').removeClass('d-none');
                $('.fees-div').addClass('d-none');
            } else {
                $('.return-div').addClass('d-none');
                $('.fees-div').removeClass('d-none');
            }
        })
    </script>
@endpush
@endif

<!-- Provider Notes Field -->
<div class="form-group">
    {!! Form::label('provider_notes', __('models/busOrders.fields.provider_notes').'*') !!}
    {!! Form::textarea('provider_notes', null, ['class' => 'form-control' . ($errors->has('provider_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('provider_notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>