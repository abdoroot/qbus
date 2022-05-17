<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.packages.index', 'method' => 'get', 'class' => 'row']) !!}
            <!-- Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('name', __('models/packages.fields.name').':') !!}
                {!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!}
            </div>

            <!-- Description Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('description', __('models/packages.fields.description').':') !!}
                {!! Form::text('description', Request::get('description'), ['class' => 'form-control']) !!}
            </div>

            <!-- Provider Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('provider_id', __('models/packages.fields.provider_id').':') !!}
                {!! Form::select('provider_id', $providers, Request::get('provider_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Fees Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('fees', __('models/packages.fields.fees').':') !!}
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

            <!-- Starting City Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('starting_city_id', __('models/packages.fields.starting_city_id').':') !!}
                {!! Form::select('starting_city_id', $cities, Request::get('starting_city_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Destinations Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('destinations', __('models/packages.fields.destinations').':') !!}
                {!! Form::select('destinations[]', $destinations, Request::get('destinations'), ['class' => 'form-control select2', 'multiple' => true]) !!}
            </div>

            <!-- Date From Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('date_from', __('models/packages.fields.date_from').':') !!}
                {!! Form::text('date_from', Request::get('date_from'), ['class' => 'form-control datepicker']) !!}
            </div>

            <!-- Time From Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('time_from', __('models/packages.fields.time_from').':') !!}
                {!! Form::time('time_from', Request::get('time_from'), ['class' => 'form-control']) !!}
            </div>

            <!-- Additional Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('additional', __('models/packages.fields.additional').':') !!}
                {!! Form::select('additional[]', $additionals, Request::get('additional'), ['class' => 'form-control select2', 'multiple' => true]) !!}
            </div>

            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/packages.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
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
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
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