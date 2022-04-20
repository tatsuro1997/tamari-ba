import main_1 from "../../../../../public/images/main_1.webp";
import main_2 from "../../../../../public/images/main_2.webp";
import main_3 from "../../../../../public/images/other.webp";
import main_4 from "../../../../../public/images/enjoy.webp";

const Swiper = () => {
    return (
        <div>
            <div className="w-full h-1/2 lg:h-full text-center relative z-0">
                <div className="swiper-container">
                    <div className="swiper-wrapper">
                        <div className="swiper-slide">
                            <img className="w-full lg:h-screen sm:h-full" width="360" height="320" src={main_1} alt="mainImage1" />
                        </div>
                        <div className="swiper-slide">
                            <img className="lazyload w-full lg:h-screen sm:h-full" width="360" height="320" loading="lazy" src={main_2} alt="mainImage1" />
                        </div>
                        <div className="swiper-slide">
                            <img className="lazyload w-full lg:h-screen sm:h-full" width="360" height="320" loading="lazy" src={main_3} alt="mainImage1"/>
                        </div>
                        <div className="swiper-slide">
                            <img className="lazyload w-full lg:h-screen sm:h-full" width="360" height="320" loading="lazy" src={main_4} alt="mainImage1"/>
                        </div>
                    </div>
                    <div className="swiper-pagination"></div>
                </div>
            </div>
            <div className="absolute left-10 lg:top-72 top-32 z-10">
                <h1 className="lg:text-6xl text-8xl text-white">Tamari-Ba</h1>
                <h2 className="lg:text-4xl text-5xl text-white lg:mt-10 mt-4">あなたの好きが、<br/>「たまり場」を創る。</h2>
            </div>
        </div>
    );
};

export default Swiper;
