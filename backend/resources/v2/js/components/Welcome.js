import React, { useState, useEffect, Fragment } from 'react';

import Swiper from './Welcome/Swiper';
import Main from './Welcome/Main';

import solo from '../../../../public/images/solo.webp';
import touring from '../../../../public/images/touring.webp';
import custom from '../../../../public/images/custom.webp';
import communicate from '../../../../public/images/communicate.webp';
import other from '../../../../public/images/other.webp';
import enjoy from '../../../../public/images/enjoy.webp';

const ABOUT_DATA = [
    {
        id: '1',
        title: 'Tamari-Baとは？',
        description: 'バイカー同士の情報共有サイトです。',
    },
    {
        id: '2',
        title: '愛車の共有',
        description: 'Tamari-Baユーザーのこだわりの愛車を共有可能\n他のバイクを見て、次に買うバイクを決めたり、カスタムパーツを知ることが可能',
    },
    {
        id: '3',
        title: 'コアな道の共有',
        description: '大好きなツーリングスポットを共有\nTamari- Baユーザーのお気に入りスポットを閲覧\n次のツーリングスポットを見つけられる',
    },
    {
        id: '4',
        title: 'ツーリング募集',
        description: 'この時期だからこそ、みんなでバイクに乗ろう\n一人では味わえないツーリングを見つけよう',
    },
    {
        id: '5',
        title: 'Tamari-Ba作成背景',
        description: 'バイク乗り達が自分のバイク、好きな道、きつかった道、楽しかった道の駅等を語り合う「たまり場」をイメージして作成。いつも行くあのカフェ、あの道の駅等の集まってダベれる「たまり場」のように好きなスポットについて語り合えるようなサイトです。\nツーリングに行く際に、目的地までの道が重要なのだが道を紹介するサイトが少ない（もしくはバイク乗りなら誰でも知っているような内容しかなかった）という課題から、道やスポットを紹介し、交流できる場が必要だと感じ作成。',
    },
]


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
            <Main
                abouts={ABOUT_DATA}
                purposes={PURPOSE_DATA}
                roads={LoadedRoads}
            />
        </Fragment>
    )
}

export default Welcome;
