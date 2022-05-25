<div class="card col-sm-12 collapse" id="filter-form">
    <div class="card-body">
        {!! Form::open(['route' => 'provider.reviews.index', 'method' => 'get', 'class' => 'row']) !!}
            <!-- Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('name', __('models/reviews.fields.name').':') !!}
                {!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!}
            </div>

            <!-- Email Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('email', __('models/reviews.fields.email').':') !!}
                {!! Form::text('email', Request::get('email'), ['class' => 'form-control']) !!}
            </div>

            <!-- User Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('user_id', __('models/reviews.fields.user_id').':') !!}
                {!! Form::select('user_id', $users, Request::get('user_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Trip Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('trip_id', __('models/reviews.fields.trip_id').':') !!}
                {!! Form::select('trip_id', $trips, Request::get('trip_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Package Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('package_id', __('models/reviews.fields.package_id').':') !!}
                {!! Form::select('package_id', $packages, Request::get('package_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Bus Order Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('bus_order_id', __('models/reviews.fields.bus_order_id').':') !!}
                {!! Form::select('bus_order_id', $busOrders, Request::get('bus_order_id'), ['class' => 'form-control select2', 'placeholder' => __('msg.all')]) !!}
            </div>

            <!-- Rate Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('rate', __('models/reviews.fields.rate').':') !!}
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

            <!-- Review Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('review', __('models/reviews.fields.review').':') !!}
                {!! Form::text('review', Request::get('review'), ['class' => 'form-control']) !!}
            </div>

            <!-- Publish Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('publish', __('models/reviews.fields.publish').':') !!}
                {!! Form::select('publish', 
                [
                    'all' => __('msg.all'),
                    '1' => __('msg.yes'),
                    '0' => __('msg.no')
                ], Request::get('publish'), ['class' => 'form-control selectpicker']) !!}
            </div>

            <!-- Created At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('created_at', __('models/reviews.fields.created_at').':') !!}
                {!! Form::text('created_at', Request::get('created_at'), ['class' => 'form-control daterange']) !!}
            </div>

            <div class="col-sm-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                    <a href="{{ route('provider.reviews.index') }}" class="btn btn-dark">@lang('crud.reset')</a>
                </div>
            </div>

        {!! Form::close() !!}
    </div>
</div>


@push('third_party_stylesheets')
    <link href="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 plugins css -->
    <link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Date picker plugins css -->
    <link href="{{ asset('elite/assets/node_modules/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('elite/assets/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush

@push('third_party_scripts')
    <script src="{{ asset('elite/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/moment/moment.js') }}"></script>
    <!-- Select2 Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('elite/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
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