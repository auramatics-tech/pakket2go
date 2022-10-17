var autocomplete = [];
style = [
    {
        "stylers": [
            {
                "saturation": -100
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    }
];

var map_options = { draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true };

function initMap() {
    $('.searchInput').each(function () {
        var id = $(this).attr('id')
        console.log(id)
        var input = document.getElementById(id);
        const options = {
            componentRestrictions: { country: "nl" },
        };
        autocomplete.push(new google.maps.places.Autocomplete(input, options));
    })

    if (show_map == 1) {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: { lat: 52.0357187, lng: 4.8963642 },
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            options: {
                styles: style
            }
        });

        map.setOptions(map_options);

        if (direction == 1) {
            console.log(autocomplete)
            $(autocomplete).each(function (i, val) {
                autocomplete[i].addListener('place_changed', function () {
                    var place = autocomplete[i].getPlace();
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    var marker = new google.maps.Marker({
                        map: map,
                        anchorPoint: new google.maps.Point(0, -29)
                    });

                    if (i == 0)
                        var type = 'pickup_';
                    else
                        var type = 'delivery_';

                    for (const component of place.address_components) {
                        const componentType = component.types[0];
                        fill_address(componentType, component, type)
                    }

                    $('#' + type + 'lat').val(place.geometry.location.lat());
                    $('#' + type + 'lng').val(place.geometry.location.lng());

                    marker.setIcon(({
                        url: BASEURL + '/assets/svg/from.svg',
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(35, 35)
                    }));
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                    booking_direction()
                });
            })
        }
    }
}

function booking_direction() {

    var start = $("#searchInput_from").val();
    var end = $("#searchInput_to").val();

    if (start && end) {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 9,
            center: { lat: 52.0357187, lng: 4.8963642 },
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            options: {
                styles: style
            }
        });

        // map.setOptions(map_options);

        var marker_delivery_start = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        marker_delivery_start.setIcon(({
            url: BASEURL + '/assets/svg/from.svg',
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));

        var marker_delivery_end = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
        marker_delivery_end.setIcon(({
            url: BASEURL + '/assets/svg/to_marker.svg',
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({ suppressMarkers: true });
        directionsDisplay.setMap(map);

        drawPath(directionsService, directionsDisplay, start, end, marker_delivery_start, marker_delivery_end);
    }
}

function drawPath(directionsService, directionsDisplay, start, end, marker_delivery_start, marker_delivery_end) {
    // jQuery(".loadermodal").show();
    directionsService.route({
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
    }, function (response, status) {
        if (status === 'OK') {
            var distance = Math.round(response.routes[0].legs[0].distance.value / 1000);
            $('#address_distance').val(distance)

            var leg = response.routes[0].legs[0];
            makeMarker(marker_delivery_start, leg.start_location);
            makeMarker(marker_delivery_end, leg.end_location);
            directionsDisplay.setDirections(response);
            directionsDisplay.setOptions({
                polylineOptions: {
                    strokeColor: '#FC4C00'
                }
            });
            saveMapToDataUrl()
        } else {
            window.alert('Problem in showing direction due to ' + status);
        }
    });
}

function makeMarker(marker_delivery, location) {

    marker_delivery.setPosition(location);
    marker_delivery.setVisible(true);
}


function changeLocale(url) {
    window.location.href = url
}


function fill_address(componentType, component, from = 'pickup_') {
    switch (componentType) {
        case "postal_code":
            {
                document.querySelector("#" + from + "postcode").value = component.short_name;
                break;
            }
        case "route":
            {
                document.querySelector("#" + from + "street").value = component.short_name;
                break;
            }
        case "locality":
            {
                document.querySelector("#" + from + "locality").value = component.short_name;
                break;
            }
    }
}

function saveMapToDataUrl() {

    var element = $("#map")[0];

    html2canvas(element, {
        useCORS: true,
        onrendered: function (canvas) {
            var dataUrl = canvas.toDataURL("image/png");
            console.log(dataUrl)
            // DO SOMETHING WITH THE DATAURL
            // Eg. write it to the page
            document.write('<img src="' + dataUrl + '"/>');
        }
    });
}

$(document).ready(function () {
    booking_direction();
})