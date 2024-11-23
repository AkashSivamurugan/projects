function initMap(driverLocation) {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: driverLocation
    });

    var marker = new google.maps.Marker({
        position: driverLocation,
        map: map,
        title: 'Your Cab'
    });
}
