$(function () {
    let like = $('.js-like-toggle');
    let likeId;
    let url;
    let data;

    like.on('click', function () {
        let $this = $(this);
        likeId = $this.data('likeid');

        // bike, roadによって処理を分ける
        if (likeId[1] == 'bike') {
            url = '/bike_like';
            data = {
                'bike_id': likeId[0]
            }
        }
        if (likeId[1] == 'road') {
            url = '/road_like';
            data = {
                'road_id': likeId[0]
            }
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,  //routeの記述
            type: 'POST', //受け取り方法の記述（GETもある）
            data: data, //コントローラーに渡すパラメーター
        })

            // Ajaxリクエストが成功した場合
            .done(function (data) {
                console.log(data.likesCount);
                //lovedクラスを追加
                $this.toggleClass('text-red-600');

                //.likesCountの次の要素のhtmlを「data.roadLikesCount」の値に書き換える
                $this.next('.likesCount').html(data.likesCount);

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
