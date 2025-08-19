<div id="propertyMapId" style="width: 100%; height: 300px" class="mt-4"></div>

@push('script-lib')
<script>
    function initMapType() {
        var myLatLng = {
            lat: parseFloat("{{ $property->latitude ?? null }}"),
            lng: parseFloat("{{ $property->longitude ?? null }}"),
        };
        var map = new google.maps.Map(document.getElementById('propertyMapId'), {
            center: myLatLng,
            zoom: 12,
            mapTypeId: 'satellite',
            mapTypeControl: true,
            mapTypeControlOptions: {
                position: google.maps.ControlPosition.BOTTOM_LEFT,
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            },
        });


        const marker = new google.maps.Marker({
            position: new google.maps.LatLng("{{ $property->latitude }}", "{{ $property->longitude }}"),
            map: map,
            icon: "http://maps.gstatic.com/mapfiles/ms2/micons/rangerstation.png",
            title: "{{ $property->title }}"
        });
    }
    if (document.getElementById('propertyMapId') && typeof google === 'undefined') {
        var script = document.createElement('script');
        script.src =
            "https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMapType";
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    } else if (typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
        initMapType();
    } else {
        handleGoogleMapsError();
    }
</script>
@endpush
