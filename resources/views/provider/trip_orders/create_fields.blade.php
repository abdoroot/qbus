<!-- Trip Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('trip_id', __('models/tripOrders.fields.trip_id').':') !!}
    {!! Form::select('trip_id', $trips, null, ['placeholder' => __('msg.select'), 'class' => 'form-control select2' . ($errors->has('trip_id') ? ' is-invalid' : ''), 'id' => 'trip_id']) !!}
    @error('trip_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user_id', __('models/tripOrders.fields.user_id').':') !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control select2' . ($errors->has('user_id') ? ' is-invalid' : ''), 'id' => 'user_id']) !!}
    @error('user_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Count Field -->
<div class="form-group col-sm-12">
    {!! Form::label('count', __('models/tripOrders.fields.count').':') !!}
    {!! Form::number('count', null, ['class' => 'form-control' . ($errors->has('count') ? ' is-invalid' : '')]) !!}
    @error('count')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Additional Field -->
<div class="form-group col-sm-12">
    {!! Form::label("additionals", __('models/tripOrders.fields.additional')." :") !!}
    <div class="row" id="additionals">
        @if(!is_null($trip_id = old('trip_id'))) 
        <?php
            $additionals = [];
            if(!is_null($trip = App\Models\Trip::find(old('trip_id')))) {
                $additionals = $trip->additionals();
            }
        ?>
        @foreach($additionals as $addition)
        <div class="form-group col-sm-3">
            <div class="custom-control custom-checkbox mr-sm-2 mb-1">
                <input type="checkbox" name="additional[]" value="{{ ($additional = $addition['additional'])->id }}" class="custom-control-input" id="additional-{{ $additional->id }}"
                    @if(in_array($additional->id, old('additional') ?? [])) checked @endif>
                <label for="additional-{{ $additional->id }}" class="custom-control-label"> {{ $additional->name }} </label>
            </div>
        </div>
        
        <!-- Fees Field -->
        <div class="form-group col-sm-9">
            <input type="number" name="additional_count[{{ $additional->id }}]" 
                value="{{ !is_null($additionalCount = old('additional_count'))
                         && isset($additionalCount[$additional->id]) ? $additionalCount[$additional->id] : null }}" 
                class="form-control" placeholder="@lang('models/tripOrders.fields.count')">
        </div>
        @endforeach
        @endif
    </div>
</div>

<!-- Coupon Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('coupon_id', __('models/tripOrders.fields.coupon_id').':') !!}
    {!! Form::select('coupon_id', $coupons, null, ['placeholder' => __('msg.none'), 'class' => 'form-control select2' . ($errors->has('coupon_id') ? ' is-invalid' : ''), 'id' => 'coupon_id']) !!}
    @error('coupon_id')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', __('models/tripOrders.fields.type').'*') !!}
    {!! Form::select('type', [
        'one-way' => __('models/tripOrders.types.one-way'),
        'round' => __('models/tripOrders.types.round'),
        'multi' => __('models/tripOrders.types.multi'),
    ], null, ['id' => 'type', 'class' => 'form-control selectpicker' . ($errors->has('type') ? ' is-invalid' : '')]) !!}

    @error('type')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- User Notes Field -->
<div class="form-group">
    {!! Form::label('user_notes', __('models/tripOrders.fields.user_notes').'*') !!}
    {!! Form::textarea('user_notes', null, ['class' => 'form-control' . ($errors->has('user_notes') ? ' is-invalid' : ''), 'rows' => 3]) !!}
    @error('user_notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/tripOrders.fields.status').'*') !!}
    {!! Form::select('status', $status, null, ['id' => 'status', 'class' => 'form-control selectpicker' . ($errors->has('status') ? ' is-invalid' : '')]) !!}

    @error('status')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<!-- Provider Notes Field -->
<div class="form-group">
    {!! Form::label('provider_notes', __('models/tripOrders.fields.provider_notes').'*') !!}
    {!! Form::textarea('provider_notes', null, ['class' => 'form-control' . ($errors->has('provider_notes') ? ' is-invalid' : ''), 'rows' => 5]) !!}
    @error('provider_notes')
    <span class="invalid-feedback"> {{ $message }} </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">@lang('crud.save')</button>
<a href="{{ route('provider.tripOrders.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>

@push('third_party_stylesheets')
<link href="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Select2 plugins css -->
<link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
<script src="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"></script>
<!-- Select2 Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@push('page_scripts')
<script>
    $('.selectpicker').selectpicker();
    $('.select2').select2();

    $('#trip_id').on('change', function() {
        getAdditionals();
    })

    function getAdditionals() {
        $('#additionals').empty();
        var trip_id = $('#trip_id').val();
        if(trip_id)
        $.ajax({
            url: "{{ route('api.trips.additionals') }}",
            type: "GET",
            data: {
                trip_id: trip_id,
            },
            success: function(res) {
                if(!res.success) {
                    $.toast({
                        heading: "{{ __('msg.error') }}",
                        text: res.message,
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 3000, 
                        stack: 6
                    });
                    return;
                }
                var additionals = res.data;
                $.each(additionals, function(index, addition) {
                    let additional = addition['additional'];
                    $('#additionals').append(`
                        <div class="form-group col-sm-3">
                            <div class="custom-control custom-checkbox mr-sm-2 mb-1">
                                <input type="checkbox" name="additional[]" value="${additional.id}" class="custom-control-input" id="additional-${additional.id}">
                                <label for="additional-${additional.id}" class="custom-control-label"> ${additional.name["{{ App::getLocale() }}"]} </label>
                            </div>
                        </div>
                        
                        <!-- Fees Field -->
                        <div class="form-group col-sm-9">
                            <input type="number" name="additional_count[${additional.id}]" class="form-control" placeholder="@lang('models/tripOrders.fields.count')">
                        </div>
                    `);
                });
                
            },
            error: function(error) {
                $.toast({
                    heading: "500",
                    text: error.message,
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3000, 
                    stack: 6
                });
            }
        })
    }
</script>
@endpush