import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";

import Map from "../components/roads/Map";
import noImage from '../../../../public/images/no_image.webp';

const RoadDetail = () => {
    const { roadId } = useParams();
    const [road, setRoad] = useState('');

    const query = `/${roadId}`;

    useEffect(
        () => {
            axios
                .get('/api/road' + query)
                .then((res) => {
                    setRoad(res.data.data[0]);
                    console.log(res.data.data[0]);
                })
                .catch((e) => {
                    console.log(e);
                })
        }, [roadId]);

    return (
        <section>
            <div className="text-center mx-auto w-full lg:w-1/2">
                {!road.filename
                    ?
                        <img
                            className="lazyload w-full bg-cover"
                            src={noImage}
                        />
                    :
                        <img
                            className="lazyload w-full bg-cover"
                            loading="lazy"
                            src={road.filename}
                            alt="road_image"
                        />
                }
                <Map lat={road.latitude} lng={road.longitude} />
            </div>
            <div className="mt-4">
                <h3 className="title-font lg:text-xl text-4xl font-medium text-gray-900 mb-3">{road.title}</h3>
                <div class="flex justify-between">
                    <p class="leading-relaxed mb-3 px-4 lg:text-lg text-2xl">{ road.description}</p>
                    <div>
                        <p className="leading-relaxed lg:text-lg text-xl text-gray-600">{road.updated_at}</p>
                        <p className="leading-relaxed lg:text-lg text-xl text-gray-600 text-right">{road.user_name}</p>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default RoadDetail;