<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.providers.index', 'method' => 'get', 'class' => 'row']) !!}
            <!-- Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('name', __('models/providers.fields.name').':') !!}
                {!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!}
            </div>

            <!-- Email Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('email', __('models/providers.fields.email').':') !!}
                {!! Form::text('email', Request::get('email'), ['class' => 'form-control']) !!}
            </div>

            <!-- Phone Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('phone', __('models/providers.fields.phone').':') !!}
                {!! Form::text('phone', Request::get('phone'), ['class' => 'form-control']) !!}
            </div>

            <!-- Address Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('address', __('models/providers.fields.address').':') !!}
                {!! Form::text('address', Request::get('address'), ['class' => 'form-control']) !!}
            </div>

            <!-- Commercial Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('comm_name', __('models/providers.fields.comm_name').':') !!}
                {!! Form::text('comm_name', Request::get('comm_name'), ['class' => 'form-control']) !!}
            </div>

            <!-- Commercial Registration Number Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('comm_reg_num', __('models/providers.fields.comm_reg_num').':') !!}
                {!! Form::text('comm_reg_num', Request::get('comm_reg_num'), ['class' => 'form-control']) !!}
            </div>

            <!-- Rate Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('rate', __('models/providers.fields.rate').':') !!}
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::select('rate_operator', 
                        [
                            '>' => __('msg.greater_than'),
                            '<' => __('msg.less_than'),
                            '=' => __('msg.equal_to')
                        ], Request::get('rate_operator'), ['class' => 'form-control selectpicker']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::select('rate', array_combine(range(1,5), range(1,5)), Request::get('rate'), ['class' => 'form-control selectpicker', 'placeholder' => __('msg.all')]) !!}
                    </div>
                </div>
            </div>

            <!-- Tax Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('tax', __('models/providers.fields.tax').':') !!}
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
                        {!! Form::number('tax', Request::get('tax'), ['class' => 'form-control', 'step' => '.01']) !!}
                    </div>
                </div>
            </div>

            <!-- Approval Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('approve', __('models/providers.fields.approve').':') !!}
                {!! Form::select('approve', 
                [
                    'all' => __('msg.all'),
                    '1' => __('msg.yes'),
                    '0' => __('msg.no')
                ], Request::get('approve'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Block Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('block', __('models/providers.fields.block').':') !!}
                {!! Form::select('block', 
                [
                    'all' => __('msg.all'),
                    '1' => __('msg.yes'),
                    '0' => __('msg.no')
                ], Request::get('block'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/providers.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-6 mt-5">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('admin.providers.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
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
@endpush

@push('third_party_scripts')
    <script src="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/moment/moment.js') }}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush

@push('page_scripts')
<script>
    $(function() {
        $('.selectpicker').selectpicker();

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