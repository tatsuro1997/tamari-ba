import RoadList from '../roads/RoadList';
import Button from './Button';
import PurposeList from './Purpose/PurposeList';

import map from '../../../../../public/images/map.webp';

const Main = (props) => {
    return (
        <div className="p-3 bg-white">
            <section className="text-gray-600 body-font">
                <Button />
                <div className="container px-5 py-16 mx-auto">
                    <div className="flex flex-col text-center w-full mb-20">
                        <div className="mx-auto">
                            <h1 className="text-3xl lg:text-5xl font-medium title-font mb-4 text-gray-900">Tamari-Baとは？</h1>
                            <p className="lg:w-2/3 mx-auto leading-relaxed text-base">バイカー同士の情報共有サイトです。</p>
                            <img className="w-full h-full mx-auto" width="100%" height="100%" src={map} />
                        </div>
                        <div className="mt-20">
                            <h1 className="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">愛車の共有</h1>
                            <p className="lg:w-2/3 mx-auto leading-relaxed text-base">Tamari-Baユーザーのこだわりの愛車を共有可能<br/>
                                他のバイクを見て、次に買うバイクを決めたり、カスタムパーツを知ることが可能</p>
                        </div>
                        <div className="mt-20">
                            <h1 className="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">コアな道の共有</h1>
                            <p className="lg:w-2/3 mx-auto leading-relaxed text-base">大好きなツーリングスポットを共有<br/>
                                Tamari-Baユーザーのお気に入りスポットを閲覧<br/>
                                次のツーリングスポットを見つけられる</p>
                        </div>
                        <div className="mt-20">
                            <h1 className="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">ツーリング募集</h1>
                            <p className="lg:w-2/3 mx-auto leading-relaxed text-base">この時期だからこそ、みんなでバイクに乗ろう<br/>
                                一人では味わえないツーリングを見つけよう</p>
                        </div>
                        <div className="mt-20">
                            <h1 className="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Tamari-Ba作成背景</h1>
                            <p className="lg:w-2/3 mx-auto leading-relaxed text-base">バイク乗り達が自分のバイク、好きな道、きつかった道、楽しかった道の駅等を語り合う「たまり場」をイメージして作成。いつも行くあのカフェ、あの道の駅等の集まってダベれる「たまり場」のように好きなスポットについて語り合えるようなサイトです。<br/>
                                ツーリングに行く際に、目的地までの道が重要なのだが道を紹介するサイトが少ない（もしくはバイク乗りなら誰でも知っているような内容しかなかった）という課題から、
                                道やスポットを紹介し、交流できる場が必要だと感じ作成。</p>
                        </div>
                    </div>
                </div>
            </section>
            <PurposeList purposes={props.purposes} />
            <section className="text-gray-600 body-font">
                <div className="container px-5 py-16 mx-auto">
                    <div className="flex flex-col text-center w-full mb-20">
                        <div>
                            <h1 className="sm:text-3xl lg:text-5xl font-medium title-font mb-4 text-gray-900">最近の投稿</h1>
                            <p className="lg:w-2/3 mx-auto leading-relaxed text-base">Tamari-Baでは全国のバイカーの愛車やおすすめスポットやコアな道を知ることができます。</p>
                        </div>
                        <RoadList roads={props.roads}/>
                        <div className="mt-20 bg-orange-300 py-10">
                            <h1 className="sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900">Tamari-Baに参加する</h1>
                            <p className="lg:w-2/3 mx-auto leading-relaxed text-base text-black">あなたの愛車やおすすめスポットを投稿してTamari-Baを充実させていきましょう!</p>
                        </div>
                    </div>
                </div>
            </section>
            <Button />
        </div>
    );
};

export default Main;
