import RoadList from '../roads/RoadList';
import Button from './Button';
import PurposeList from './Purpose/PurposeList';
import AboutList from './About/AboutList';

const Main = (props) => {
    return (
        <div className="p-3 bg-white">
            <AboutList abouts={props.abouts} />
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
