import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import Map from "../components/roads/Map";

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
                <img
                    className="lazyload w-full bg-cover"
                    loading="lazy"
                    src={road.filename}
                    alt="road_image"
                />
                <Map lat={road.latitude} lng={road.longitude} />
            </div>
            <div className="flex justify-around mt-4">
                <h3 className="title-font lg:text-lg text-4xl font-medium text-gray-900 mb-3">{road.title}</h3>
                <p className="leading-relaxed lg:text-lg text-xl">{road.created_at}</p>
            </div>
        </section>
    );
};

export default RoadDetail;
