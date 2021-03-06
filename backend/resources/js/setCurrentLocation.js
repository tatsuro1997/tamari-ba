const setCurrentLocation = (pos) => {

    // 緯度・経度を取得
    const lat = pos.coords.latitude;
    const lng = pos.coords.longitude;
    // 定数lat,lng をconsoleに出力
    console.log(lat);
    console.log(lng);

    document.getElementById("cLocation").addEventListener('click', function () {
        // fornの中からlatのclassを見つけて、そのvalueに、定数latを代入
        $("#latitude").val(lat);
        // formの中からlngのclassを見つけて、そのvalueに、定数lngを代入
        $("#longitude").val(lng);
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
    });

}

// エラー時に呼び出される関数
const showErr = (err) => {
    switch (err.code) {
        case 1:
            alert("位置情報の利用が許可されていません");
            break;
        case 2:
            alert("デバイスの位置が判定できません");
            break;
        case 3:
            alert("タイムアウトしました");
            break;
        default:
            alert(err.message);
    }
}

// geolocation に対応しているか否かを確認
if ("geolocation" in navigator) {
    var opt = {
        "enableHighAccuracy": true,
        "timeout": 10000,
        "maximumAge": 0,
    };
    navigator.geolocation.getCurrentPosition(setCurrentLocation, showErr, opt);
} else {
    alert("ブラウザが位置情報取得に対応していません");
}

