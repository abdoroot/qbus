<!-- Step 1 -->
<h6>@lang('models/trips.description')</h6>
<section>
    @include('provider.trips.description')
</section>
<h6>@lang('models/trips.datetime')</h6>
<section>
    @include('provider.trips.datetime')
</section>
<h6>@lang('models/trips.location')</h6>
<section>
    <div class="row">
        <h4 class="card-title col-sm-12">@lang('models/trips.location_title')</h4>
        <div class="form-group col-sm-12">
            <div id="markermap" class="gmaps"></div>
            {!! Form::hidden('lat', null) !!}
            {!! Form::hidden('lng', null) !!}
            {!! Form::hidden('zoom', null) !!}
        </div>
    </div>
</section>

<h6>@lang('models/trips.destination')</h6>
<section>
    @include('provider.trips.program')
</section>

<h6>@lang('models/trips.bus')</h6>
<section>
    @include('provider.trips.bus')
</section>

<h6>@lang('models/trips.notes')</h6>
<section>
    @include('provider.trips.notes')
</section>

@push('page_scripts')
@include('provider.trips.script')
<script>
    $(document).ready(function() {
        // select2
        $('.select2').select2();
        // Datepicker 
        $('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        /** 
         * Google Map Script 
        **/
        let marker, position,
            lat  = 25.4052,
            lng  = 55.5136,
            zoom = 12;

        @if(isset($busOrder))
            @if(!is_null($lat  = $busOrder->lat)) lat   = {{ $lat }}; @endif
            @if(!is_null($lng  = $busOrder->lng)) lng   = {{ $lng }}; @endif
            @if(!is_null($zoom = $busOrder->zoom)) zoom = {{ $zoom }}; @endif
        @endif

        $('input[name=lat]').val(lat);
        $('input[name=lng]').val(lng);
        $('input[name=zoom]').val(zoom);

        // function initMap() {
            const map = new google.maps.Map(document.getElementById("markermap"), {
                zoom: 12,
                center: { lat: lat, lng: lng },
            });
            marker = new google.maps.Marker({
                map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: { lat: lat, lng: lng },
            });
            marker.addListener("dragend", () => {
                position = marker.getPosition();
                $('input[name=lat]').val(position.lat());
                $('input[name=lng]').val(position.lng());
                $('input[name=zoom]').val(map.getZoom());
            });
        // }
    })
</script>
<!-- google maps api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoliAneRffQDyA7Ul9cDk3tLe7vaU4yP8"></script>
@endpush

@push('third_party_stylesheets')
<link href="{{ asset('elite/assets/node_modules/wizard/steps.css') }}" rel="stylesheet">
<!-- Date picker plugins css -->
<link href="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Select2 plugins css -->
<link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- iCheck -->
<link href="{{ asset('elite/assets/node_modules/icheck/skins/all.css') }}" rel="stylesheet">
@endpush

@push('third_party_scripts')
<script src="{{ asset('elite/assets/node_modules/wizard/jquery.steps.min.js') }}"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- Select2 Plugin JavaScript -->
<script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Import repeater js  -->
<script src="{{ asset('js/repeater.js') }}" type="text/javascript"></script>
@endpush