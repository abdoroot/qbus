<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'provider.coupons.index', 'method' => 'get', 'class' => 'row']) !!}
            <!-- Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('name', __('models/coupons.fields.name').':') !!}
                {!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!}
            </div>

            <!-- Status Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('status', __('models/coupons.fields.status').':') !!}
                {!! Form::select('status', 
                    [
                        'all' => __('msg.all'),
                        'pending' => __('models/coupons.status.pending'),
                        'approved' => __('models/coupons.status.approved'),
                        'rejected' => __('models/coupons.status.rejected'),
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

            <!-- Type Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('type', __('models/coupons.fields.type').':') !!}
                {!! Form::select('type', 
                    [
                        'all' => __('msg.all'),
                        'amount' => __('models/coupons.types.amount'),
                        'percentage' => __('models/coupons.types.percentage'),
                    ], Request::get('type'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Discount Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('discount', __('models/coupons.fields.discount').':') !!}
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::select('discount_operator', 
                        [
                            '>' => __('msg.greater_than'),
                            '<' => __('msg.less_than'),
                            '=' => __('msg.equal_to')
                        ], Request::get('discount_operator'), ['class' => 'form-control selectpicker']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('discount', Request::get('discount'), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            
            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/coupons.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('provider.coupons.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
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

        $('.daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + '+' + picker.endDate.format('YYYY-MM-DD'));
        });

        // Datepicker 
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    })
</script>
@endpush