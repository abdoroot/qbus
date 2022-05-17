<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.busOrders.index', 'method' => 'get', 'class' => 'row']) !!}

            <!-- Provider Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('provider_id', __('models/busOrders.fields.provider_id').':') !!}
                {!! Form::select('provider_id', $providers, Request::get('provider_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Bus Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('bus_id', __('models/busOrders.fields.bus_id').':') !!}
                {!! Form::select('bus_id', $buses, Request::get('bus_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- User Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('user_id', __('models/busOrders.fields.user_id').':') !!}
                {!! Form::select('user_id', $users, Request::get('user_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Destination Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('destination', __('models/busOrders.fields.destination').':') !!}
                {!! Form::select('destination[]', $destinations, Request::get('destination'), ['class' => 'form-control select2', 'multiple' => true]) !!}
            </div>

            <!-- Fees Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('fees', __('models/busOrders.fields.fees').':') !!}
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
                {!! Form::label('tax', __('models/busOrders.fields.tax').':') !!}
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
                {!! Form::label('total', __('models/busOrders.fields.total').':') !!}
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

            <!-- Status Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('status', __('models/busOrders.fields.status').':') !!}
                {!! Form::select('status', 
                    [
                        'all' => __('msg.all'),
                        'pending' => __('models/busOrders.status.pending'),
                        'approved' => __('models/busOrders.status.approved'),
                        'rejected' => __('models/busOrders.status.rejected'),
                        'canceled' => __('models/busOrders.status.canceled'),
                        'paid' => __('models/busOrders.status.paid'),
                        'complete' => __('models/busOrders.status.complete'),
                    ], Request::get('status'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Date From Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('date_from', __('models/busOrders.fields.date_from').':') !!}
                {!! Form::text('date_from', Request::get('date_from'), ['class' => 'form-control datepicker']) !!}
            </div>

            <!-- Date To Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('date_to', __('models/busOrders.fields.date_to').':') !!}
                {!! Form::text('date_to', Request::get('date_to'), ['class' => 'form-control datepicker']) !!}
            </div>

            <!-- Time From Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('time_from', __('models/busOrders.fields.time_from').':') !!}
                {!! Form::time('time_from', Request::get('time_from'), ['class' => 'form-control']) !!}
            </div>

            <!-- Time To Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('time_to', __('models/busOrders.fields.time_to').':') !!}
                {!! Form::time('time_to', Request::get('time_to'), ['class' => 'form-control']) !!}
            </div>

            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/busOrders.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('admin.busOrders.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
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
    <!-- Date picker plugins css -->
    <link href="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
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

        // Datepicker 
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        $('.daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + '+' + picker.endDate.format('YYYY-MM-DD'));
        });
    })
</script>
@endpush