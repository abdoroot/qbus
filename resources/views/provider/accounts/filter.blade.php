<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'provider.accounts.index', 'method' => 'get', 'class' => 'row']) !!}
            <!-- Username Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('username', __('models/accounts.fields.username').':') !!}
                {!! Form::text('username', Request::get('username'), ['class' => 'form-control']) !!}
            </div>

            <!-- Email Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('email', __('models/accounts.fields.email').':') !!}
                {!! Form::text('email', Request::get('email'), ['class' => 'form-control']) !!}
            </div>

            <!-- Phone Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('phone', __('models/accounts.fields.phone').':') !!}
                {!! Form::text('phone', Request::get('phone'), ['class' => 'form-control']) !!}
            </div>

            <!-- Role Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('role', __('models/accounts.fields.role').':') !!}
                {!! Form::select('role', 
                    [
                        'all' => __('msg.all'),
                        'admin' => __('models/accounts.roles.admin'),
                        'driver' => __('models/accounts.roles.driver'),
                    ], Request::get('role'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Active Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('active', __('models/accounts.fields.active').':') !!}
                {!! Form::select('active', 
                [
                    'all' => __('msg.all'),
                    '1' => __('msg.yes'),
                    '0' => __('msg.no')
                ], Request::get('active'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/accounts.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('provider.accounts.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
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