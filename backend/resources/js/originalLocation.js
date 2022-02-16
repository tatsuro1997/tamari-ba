let marker;

function initMap() {
    // google map へ表示するための設定
    latlng = new google.maps.LatLng(lat, lng);
    map = document.getElementById("map");
    opt = {
        zoom: 13,
        center: latlng,
    };
    // google map 表示
    mapObj = new google.maps.Map(map, opt);
    // マーカーを設定
    marker = new google.maps.Marker({
        position: latlng,
        map: mapObj,
        title: '現在地',
    });

    mapObj.addListener('click', function (e) {
        getClickLatLng(e.latLng, mapObj);
    });
}

// 住所、座標を取得してマーカー設置
function getClickLatLng(latlng, opt) {

    $('#latitude').val(latlng.lat());
    $('#longitude').val(latlng.lng());

    // 既存のマーカーの削除
    deleteMarker();

    // マーカー設置
    marker = new google.maps.Marker({
        position: latlng,
        map: mapObj
    });

    opt.panTo(latlng);
}

// 既にあるマーカーの削除
function deleteMarker() {
    if (marker != null) {
        marker.setMap(null);
    }
    marker = null;
}
