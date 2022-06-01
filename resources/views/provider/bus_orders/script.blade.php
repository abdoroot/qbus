@push('page_scripts')
<script>
    $(document).ready(function() {
        /* Create Repeater */
        @if(!is_null(old('destination')))
        values = {!! json_encode(array_map(function($city_id, $index) {
            return ['destination['.$index.']' => $city_id];
        }, old('destination'), array_keys(old('destination')))) !!};
        @elseif(isset($busOrder))
        values = {!! json_encode(array_map(function($city_id, $index) {
            return ['destination['.$index.']' => $city_id];
        }, $busOrder->destination, array_keys($busOrder->destination))) !!};
        @else
        values = [
            {'destination[0]': null},
            {'destination[1]': null},
        ];
        @endif

        $("#destination").createRepeater({
            showFirstItemToDefault: true,
            disableFirstItemRemoveButton: true,
            values: values
        });

        // select2
        $('#bus_id').select2();
        $('#user_id').select2();

        // Datepicker 
        $('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        $(document).on('change', '#date_from', function () {
            if(!$('#date_to').val()) {
                // $('#date_to').val($(this).val());
                $('#date_to').datepicker('setDate', new Date($(this).val()));
            }
        })

        $(document).on('keyup', '#fees', function () {
            var fees = parseFloat($('#fees').val());
            if(fees > 0) {
                var tax = fees * {{ $tax / 100 }};
                $('#tax').text(tax);
                $('#total').text(fees + tax);
            }
        })
    })
</script>

@include('user.components.map')

@endpush

@push('third_party_stylesheets')
<link href="{{ asset('elite/assets/node_modules/wizard/steps.css') }}" rel="stylesheet">
<!-- Date picker plugins css -->
<link href="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Select2 plugins css -->
<link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- iCheck -->
<link href="{{ asset('elite/assets/node_modules/icheck/skins/all.css') }}" rel="stylesheet">
<link href="{{ asset('elite/dist/css/pages/form-icheck.css') }}" rel="stylesheet">
@endpush

@push('third_party_scripts')
<script src="{{ asset('elite/assets/node_modules/wizard/jquery.steps.min.js') }}"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- Select2 Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<!-- icheck -->
<script src="{{ asset('elite/assets/node_modules/icheck/icheck.min.js') }}"></script>
<script src="{{ asset('elite/assets/node_modules/icheck/icheck.init.js') }}"></script>
<!-- Import repeater js  -->
<script src="{{ asset('js/repeater.js') }}" type="text/javascript"></script>
@endpush