
@if(!in_array($tripOrder->status, ['canceled', 'rejected']))
<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/tripOrders.fields.status').'*') !!}
    {!! Form::select('status', $status, null, ['id' => 'status', 'class' => 'form-control selectpicker' . ($errors->has('status') ? ' is-invalid' : '')]) !!}

    @error('status')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

@if($tripOrder->status == 'paid')              
<!-- Return Field -->
<div class="form-group return-div {{  old('status') == 'rejected' ? '' : 'd-none' }}">
    {!! Form::label('return', __('models/tripOrders.fields.return').':') !!}
    {!! Form::select('return', [
        'bank' => __('models/tripOrders.return.bank'),
        'wallet' => __('models/tripOrders.return.wallet')
    ], null, ['class' => 'form-control custom-select' . ($errors->has('return') ? ' is-invalid' : ''), 'id'=>'return']) !!}
    @error('return')
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
            } else {
                $('.return-div').addClass('d-none');
            }
        })
    </script>
@endpush
@endif

<!-- Provider Notes Field -->
<div class="form-group">
    {!! Form::label('provider_notes', __('models/tripOrders.fields.provider_notes').'*') !!}
    {!! Form::textarea('provider_notes', null, ['class' => 'form-control' . ($errors->has('provider_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('provider_notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>