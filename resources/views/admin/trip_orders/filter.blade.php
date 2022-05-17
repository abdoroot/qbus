<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.tripOrders.index', 'method' => 'get', 'class' => 'row']) !!}

            <!-- Provider Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('provider_id', __('models/tripOrders.fields.provider_id').':') !!}
                {!! Form::select('provider_id', $providers, Request::get('provider_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Trip Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('trip_id', __('models/tripOrders.fields.trip_id').':') !!}
                {!! Form::select('trip_id', $trips, Request::get('trip_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- User Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('user_id', __('models/tripOrders.fields.user_id').':') !!}
                {!! Form::select('user_id', $users, Request::get('user_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Coupon Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('coupon_id', __('models/tripOrders.fields.coupon_id').':') !!}
                {!! Form::select('coupon_id', $coupons, Request::get('coupon_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Count Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('count', __('models/tripOrders.fields.count').':') !!}
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::select('count_operator', 
                        [
                            '>' => __('msg.greater_than'),
                            '<' => __('msg.less_than'),
                            '=' => __('msg.equal_to')
                        ], Request::get('count_operator'), ['class' => 'form-control selectpicker']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('count', Request::get('count'), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <!-- Fees Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('fees', __('models/tripOrders.fields.fees').':') !!}
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::select('fees_operator', 
                        [
                            '>' => __('msg.greater_than'),
                            '<' => __('msg.less_than'),
                            '=' => __('msg.equal_to')
                        ], Request::get('fees_operator'), ['class' => 'form-control selectpicker']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('fees', Request::get('fees'), ['class' => 'form-control', 'step' => '.01']) !!}
                    </div>
                </div>
            </div>

            <!-- Tax Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('tax', __('models/tripOrders.fields.tax').':') !!}
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::select('tax_operator', 
                        [
                            '>' => __('msg.greater_than'),
                            '<' => __('msg.less_than'),
                            '=' => __('msg.equal_to')
                        ], Request::get('tax_operator'), ['class' => 'form-control selectpicker']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('tax', Request::get('tax'), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <!-- Total Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('total', __('models/tripOrders.fields.total').':') !!}
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::select('total_operator', 
                        [
                            '>' => __('msg.greater_than'),
                            '<' => __('msg.less_than'),
                            '=' => __('msg.equal_to')
                        ], Request::get('total_operator'), ['class' => 'form-control selectpicker']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('total', Request::get('total'), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <!-- Type Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('type', __('models/tripOrders.fields.type').':') !!}
                {!! Form::select('type', 
                    [
                        'all' => __('msg.all'),
                        'one-way' => __('models/tripOrders.types.one-way'),
                        'round' => __('models/tripOrders.types.round'),
                        'multi' => __('models/tripOrders.types.multi'),
                    ], Request::get('type'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Status Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('status', __('models/tripOrders.fields.status').':') !!}
                {!! Form::select('status', 
                    [
                        'all' => __('msg.all'),
                        'pending' => __('models/tripOrders.status.pending'),
                        'approved' => __('models/tripOrders.status.approved'),
                        'rejected' => __('models/tripOrders.status.rejected'),
                        'canceled' => __('models/tripOrders.status.canceled'),
                        'paid' => __('models/tripOrders.status.paid'),
                    ], Request::get('status'), ['class' => 'form-control selectpicker']) !!}
            </div>
            
            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/tripOrders.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('admin.tripOrders.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
                </div>
            </div>

        {!! Form::close() !!}
    </div>
</div>


@push('third_party_stylesheets')
    <link href="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Date picker plugins css -->
    <link href="{{ asset('elite/assets/node_modules/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('elite/assets/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Select2 plugins css -->
    <link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <script src="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/moment/moment.js') }}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Select2 Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@push('page_scripts')
<script>
    $(function() {
        $('.selectpicker').selectpicker();
        $('.select2').select2();

        // Daterange
        $('.daterange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                // format: 'YYYY-MM-DD',
                cancelLabel: "@lang('crud.clear')"
            }
        });

        $('.daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + '+' + picker.endDate.format('YYYY-MM-DD'));
        });
    })
</script>
@endpush