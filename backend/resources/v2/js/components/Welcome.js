import React, { useState, useEffect, Fragment } from 'react';

import Swiper from './Welcome/Swiper';
import Main from './Welcome/Main';

import solo from '../../../../public/images/solo.webp';
import touring from '../../../../public/images/touring.webp';
import custom from '../../../../public/images/custom.webp';
import communicate from '../../../../public/images/communicate.webp';
import other from '../../../../public/images/other.webp';
import enjoy from '../../../../public/images/enjoy.webp';

const PURPOSE_DATA = [
    {
        id: '1',
        image: solo,
        kind: 'ソロ',
        title: 'ツーリングスポットはTamari-Baで!',
        description: 'Tamari-Baではユーザーお気に入りのツーリングスポットが数々紹介されています。目的地が決まっていないときや目的地周辺で次に行くスポットを探すときなどに便利です。',
    },
    {
        id: '2',
        image: touring,
        kind: 'ツーリング',
        title: 'もちろんツーリングも!',
        description: '同じ目的地に行くのであれば、Tamari-Baユーザーとツーリングをしてみませんか？ソロやいつもの仲間で走るより、知らないバイクを間近で見ることやバイカー同士で会話をするツーリングは同じ目的地に行くのでも格別です。',
    },
    {
        id: '3',
        image: custom,
        kind: 'カスタム',
        title: 'あなたのバイクはこう変わる',
        description: 'Tamari-Baユーザーの愛車を見ることができます。そこには今乗っている愛車と同じバイクもあるはずです。まだ手を入れていないあなたの愛車もカスタムをすることでさらに愛着が湧くはずです。',
    },
    {
        id: '4',
        image: communicate,
        kind: '交流',
        title: 'バイカー専用SNS',
        description: 'Tamari-Baはバイク専用のSNSです。ユーザーの愛車やお気に入りの道の投稿に対してコメントすることができます。投稿へのコメントから一緒にツーリングに行くキッカケがうまれます。積極的にコメントすることでTamari-Baすることができます。',
    },
    {
        id: '5',
        image: other,
        kind: 'バイク✕？？',
        title: 'バイクと組み合わせる',
        description: 'Tamari-Baではバイクを入り口に、カフェや道の駅、バイクと組み合わせてできる趣味の仲間を見つけることができます。そこではバイクが軸となり広がっていくTamari-Baがあります。バイクをキッカケにキャンプやカメラ、釣りなど相性の良い趣味の幅を広げていきましょう。',
    },
    {
        id: '6',
        image: enjoy,
        kind: 'Enjoy',
        title: '見るだけで楽しい!',
        description: 'もしまだ愛車がなくても大歓迎!バイクの免許を取りに行こうとしている、次に買うバイクを悩んでいる、ただただバイクを見ることが好きだ!そんな方でも、次のバイクの検討や憧れのバイクを見つけて楽しめます。',
    },
]


function Welcome() {

    const [LoadedRoads, setLoadedRoads] = useState([]);

    useEffect(
        () => {
            axios
                .get('/api/welcome')
                .then((res) => {
                    setLoadedRoads(res.data.data);
                })
                .catch((e) => {
                    console.log(e);
                })
        }, []);

    return (
        <Fragment>
            <Swiper />
            <Main roads={LoadedRoads} purposes={PURPOSE_DATA}/>
        </Fragment>
    )
}

export default Welcome;
