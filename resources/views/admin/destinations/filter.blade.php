<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.destinations.index', 'method' => 'get', 'class' => 'row']) !!}
            <!-- Provider Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('provider_id', __('models/destinations.fields.provider_id').':') !!}
                {!! Form::select('provider_id', $providers, Request::get('provider_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- From City Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('from_city_id', __('models/destinations.fields.from_city_id').':') !!}
                {!! Form::select('from_city_id', $cities, Request::get('from_city_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- To City Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('to_city_id', __('models/destinations.fields.to_city_id').':') !!}
                {!! Form::select('to_city_id', $cities, Request::get('to_city_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Starting Terminal Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('starting_terminal_id', __('models/destinations.fields.starting_terminal_id').':') !!}
                {!! Form::select('starting_terminal_id', $terminals, Request::get('starting_terminal_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Arrival Terminal Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('arrival_terminal_id', __('models/destinations.fields.arrival_terminal_id').':') !!}
                {!! Form::select('arrival_terminal_id', $terminals, Request::get('arrival_terminal_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Stops Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('stops', __('models/destinations.fields.stops').':') !!}
                {!! Form::select('stops[]', $terminals, Request::get('stops'), ['class' => 'form-control select2', 'placeholder' => __('msg.all'), 'multiple' => true]) !!}
            </div>

            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/destinations.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
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