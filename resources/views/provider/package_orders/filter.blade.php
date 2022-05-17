<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'provider.packageOrders.index', 'method' => 'get', 'class' => 'row']) !!}
            <!-- Package Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('package_id', __('models/packageOrders.fields.package_id').':') !!}
                {!! Form::select('package_id', $packages, Request::get('package_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- User Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('user_id', __('models/packageOrders.fields.user_id').':') !!}
                {!! Form::select('user_id', $users, Request::get('user_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Coupon Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('coupon_id', __('models/packageOrders.fields.coupon_id').':') !!}
                {!! Form::select('coupon_id', $coupons, Request::get('coupon_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Status Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('status', __('models/packageOrders.fields.status').':') !!}
                {!! Form::select('status', 
                    [
                        'all' => __('msg.all'),
                        'pending' => __('models/packageOrders.status.pending'),
                        'approved' => __('models/packageOrders.status.approved'),
                        'rejected' => __('models/packageOrders.status.rejected'),
                        'canceled' => __('models/packageOrders.status.canceled'),
                        'paid' => __('models/packageOrders.status.paid'),
                    ], Request::get('status'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Count Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('count', __('models/packageOrders.fields.count').':') !!}
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
                {!! Form::label('fees', __('models/packageOrders.fields.fees').':') !!}
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
                {!! Form::label('tax', __('models/packageOrders.fields.tax').':') !!}
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
                {!! Form::label('total', __('models/packageOrders.fields.total').':') !!}
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
            
            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/packageOrders.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('provider.packageOrders.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
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