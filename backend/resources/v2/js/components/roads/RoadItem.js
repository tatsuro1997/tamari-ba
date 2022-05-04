import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';

import Card from "../ui/Card";
import noImage from '../../../../../public/images/no_image.webp';

const RoadItem = (props) => {
    const [like, setLike] = useState('');

    let roadId = {
        'id': props.id,
    };

    useEffect(() => {
        setLike(props.road_like)
    }, [])

    const likeHandler = () => {
        axios
            .post('/api/road_like', roadId)
            .then((res) => {
                setLike(res.data);
            })
            .catch((e) => {
                console.log(e);
            })
    }

    let likeButton;

    if (like === true ) {
        likeButton = "行きたい済み"
    } else {
        likeButton = "行きたい"
    }

    return (
        <Card>
            <div key={props.id}>
                <Link to={`${props.id}`}>
                    { !props.filename &&
                        <img
                            className="lazyload w-full lg:max-h-60 max-h-80 mx-auto bg-cover"
                            src={noImage}
                        />
                    }
                    <img
                        className="lazyload w-full lg:max-h-60 max-h-80 mx-auto bg-cover"
                        src={props.filename}
                    />
                </Link>
                <div className="p-6">
                    <h2 className="text-left title-font lg:text-lg text-4xl font-medium text-gray-900 mb-3">
                        {props.title}
                    </h2>
                    <button onClick={likeHandler}>
                        {likeButton}
                    </button>
                    <div className="flex justify-end lg:text-base text-xl text-gray-600">
                        <div className="leading-relaxed text-right">
                            {props.updated_at}
                        </div>
                        <div className="leading-relaxed text-right ml-2">
                            {props.user_name}
                        </div>
                    </div>
                </div>
            </div>
        </Card>
    );
};

export default RoadItem;
