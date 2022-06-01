<script>
    
    $(document).ready(function() {
        /** 
         * Google Map Script 
        **/
        let marker, position,
            lat  = 25.4052,
            lng  = 55.5136,
            zoom = 12;

        @if(isset($busOrder))
            @if(isset($lat) && !is_null($lat)) lat   = {{ $lat }}; @endif
            @if(isset($lng) && !is_null($lng)) lng   = {{ $lng }}; @endif
            @if(isset($zoom) && !is_null($zoom)) zoom = {{ $zoom }}; @endif
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
    });
</script>
<!-- google maps api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoliAneRffQDyA7Ul9cDk3tLe7vaU4yP8"></script>