<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.buses.index', 'method' => 'get', 'class' => 'row']) !!}
            <!-- Plate Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('plate', __('models/buses.fields.plate').':') !!}
                {!! Form::text('plate', Request::get('plate'), ['class' => 'form-control']) !!}
            </div>

            <!-- Passengers Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('passengers', __('models/users.fields.passengers').':') !!}
                <div class="row">
                    <div class="form-group col-sm-4">
                        {!! Form::select('passengers_operator', 
                        [
                            '>' => __('msg.greater_than'),
                            '<' => __('msg.less_than'),
                            '=' => __('msg.equal_to')
                        ], Request::get('passengers_operator'), ['class' => 'form-control selectpicker']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('passengers', Request::get('passengers'), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <!-- Provider Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('provider_id', __('models/buses.fields.provider_id').':') !!}
                {!! Form::select('provider_id', $providers, Request::get('provider_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Account Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('account_id', __('models/buses.fields.account_id').':') !!}
                {!! Form::select('account_id', $accounts, Request::get('account_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Active Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('active', __('models/buses.fields.active').':') !!}
                {!! Form::select('active', 
                [
                    'all' => __('msg.all'),
                    '1' => __('msg.yes'),
                    '0' => __('msg.no')
                ], Request::get('active'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/buses.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('admin.buses.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
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