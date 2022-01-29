$(function () {
    var like = $('.js-like-toggle');
    var likeRoadId;

    like.on('click', function () {
        var $this = $(this);
        likeRoadId = $this.data('roadid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/like',  //routeの記述
            type: 'POST', //受け取り方法の記述（GETもある）
            data: {
                'road_id': likeRoadId //コントローラーに渡すパラメーター
            },
        })

            // Ajaxリクエストが成功した場合
            .done(function (data) {
                console.log(data.roadLikesCount);
                //lovedクラスを追加
                $this.toggleClass('text-red-600');

                //.likesCountの次の要素のhtmlを「data.roadLikesCount」の値に書き換える
                $this.next('.likesCount').html(data.roadLikesCount);

            })
            // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
                //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });

        return false;
    });
});
