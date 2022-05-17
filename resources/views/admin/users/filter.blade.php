<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.users.index', 'method' => 'get', 'class' => 'row']) !!}
            <!-- Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('name', __('models/users.fields.name').':') !!}
                {!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!}
            </div>

            <!-- Email Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('email', __('models/users.fields.email').':') !!}
                {!! Form::text('email', Request::get('email'), ['class' => 'form-control']) !!}
            </div>

            <!-- Phone Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('phone', __('models/users.fields.phone').':') !!}
                {!! Form::text('phone', Request::get('phone'), ['class' => 'form-control']) !!}
            </div>

            <!-- Address Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('address', __('models/users.fields.address').':') !!}
                {!! Form::text('address', Request::get('address'), ['class' => 'form-control']) !!}
            </div>

            <!-- Date Of Birth Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('date_of_birth', __('models/users.fields.date_of_birth').':') !!}
                {!! Form::text('date_of_birth', Request::get('date_of_birth'), ['class' => 'form-control daterange']) !!}
            </div>

            <!-- Wallet Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('wallet', __('models/users.fields.wallet').':') !!}
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::select('wallet_operator', 
                        [
                            '>' => __('msg.greater_than'),
                            '<' => __('msg.less_than'),
                            '=' => __('msg.equal_to')
                        ], Request::get('wallet_operator'), ['class' => 'form-control selectpicker']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('wallet', Request::get('wallet'), ['class' => 'form-control', 'step' => '.01']) !!}
                    </div>
                </div>
            </div>

            <!-- Marital Status Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('marital_status', __('models/users.fields.marital_status').':') !!}
                {!! Form::select('marital_status', 
                [
                    'all' => __('msg.all'),
                    'single' => __('models/users.marital_status.single'),
                    'married' => __('models/users.marital_status.married')
                ], Request::get('marital_status'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Block Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('block', __('models/users.fields.block').':') !!}
                {!! Form::select('block', 
                [
                    'all' => __('msg.all'),
                    '1' => __('msg.yes'),
                    '0' => __('msg.no')
                ], Request::get('block'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/users.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-6 mt-5">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
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