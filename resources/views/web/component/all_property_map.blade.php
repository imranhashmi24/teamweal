<div id="propertyMapId" style="width: 100%; height: 600px" class="mt-4"></div>

@push('script-lib')
<script>

    function initMapType() {
        var myLatLng = {
            lat: parseFloat("{{ $getCityLatLng['lat'] ?? null }}"),
            lng: parseFloat("{{ $getCityLatLng['lng'] ?? null }}"),
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
            position: new google.maps.LatLng("{{ $getCityLatLng['lat'] }}", "{{ $getCityLatLng['lng'] }}"),
            map: map,
            title: "{{ $getCityLatLng['title'] }}"
        });

        const properties = @json($property_items);

        console.log(properties);

        if (properties) {
            properties.forEach(function(property) {
                setMarker(map, property);
            });
        }
    }


    function setMarker(map, property) {
        const iconColor = 'http://maps.gstatic.com/mapfiles/ms2/micons/rangerstation.png';

        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(property.lat), parseFloat(property.lng)),
            map: map,
            icon: iconColor,
            title: property.title
        });

        marker.addListener('click', function() {
            redirectToPropertyDetail(property);
        });
    }

    function redirectToPropertyDetail(property) {
        const url = "{{ route('property.detail', ':slug') }}";
        const slug = encodeURIComponent(property.slug);
        const finalUrl = url.replace(":slug", slug);

        window.location.href = finalUrl;
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
