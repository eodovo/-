window.onload = function () {
    var container = document.getElementById('ulsanMap');
    var options = {
        center: new daum.maps.LatLng(35.53037317567905, 129.36359629298886),
        level: 2
    };

    var map = new daum.maps.Map(container, options);

    var mapTypeControl = new daum.maps.MapTypeControl();
    map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

    var zoomControl = new daum.maps.ZoomControl();
    map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);

    var markerPosition = new daum.maps.LatLng(35.53037317567905, 129.36359629298886);
    var marker = new daum.maps.Marker({
        position: markerPosition
    });

    marker.setMap(map);

    var overlay = new daum.maps.CustomOverlay({
        map: map,
        position: marker.getPosition()
    });


    var container2 = document.getElementById('seoulMap');
    var options2 = {
        center: new daum.maps.LatLng(37.50803358213867, 127.06279408253823),
        level: 3
    };

    var map2 = new daum.maps.Map(container2, options2);

    var mapTypeControl2 = new daum.maps.MapTypeControl();
    map2.addControl(mapTypeControl2, daum.maps.ControlPosition.TOPRIGHT);

    var zoomControl2 = new daum.maps.ZoomControl();
    map2.addControl(zoomControl2, daum.maps.ControlPosition.RIGHT);

    var markerPosition2 = new daum.maps.LatLng(37.50803358213867, 127.06279408253823);
    var marker2 = new daum.maps.Marker({
        position: markerPosition2
    });

    marker2.setMap(map2);

    var overlay2 = new daum.maps.CustomOverlay({
        map: map2,
        position: marker2.getPosition()
    });


    var container3 = document.getElementById('incheonMap');
    var options3 = {
        center: new daum.maps.LatLng(37.3943238076239, 126.68671720157514),
        level: 2
    };

    var map3 = new daum.maps.Map(container3, options3);

    var mapTypeControl3 = new daum.maps.MapTypeControl();
    map3.addControl(mapTypeControl3, daum.maps.ControlPosition.TOPRIGHT);

    var zoomControl3 = new daum.maps.ZoomControl();
    map3.addControl(zoomControl3, daum.maps.ControlPosition.RIGHT);

    var markerPosition3 = new daum.maps.LatLng(37.3943238076239, 126.68671720157514);
    var marker3 = new daum.maps.Marker({
        position: markerPosition2
    });

    marker3.setMap(map3);

    var overlay3 = new daum.maps.CustomOverlay({
        map: map3,
        position: marker3.getPosition()
    });
}