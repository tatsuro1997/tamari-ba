import { useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faHeart } from '@fortawesome/free-solid-svg-icons';

import Card from "../ui/Card";
import noImage from '../../../../../public/images/no_image.webp';

const RoadItem = (props) => {
    const [like, setLike] = useState('');
    const [uid, setUid] = useState('');
    const navigate = useNavigate();

    useEffect(() => {
        setLike(props.road_like)
    }, [])

    useEffect(() => {
        if (localStorage.getItem('auth_token')) {
        axios
            .get('/api/user').then((res) => {
                setUid(res.data.id);
            }).catch(() => {
                navigate('/');
            })
        }
    }, [])

    let likeData = {
        'id': props.id,
        'uid': uid,
    };

    const likeHandler = () => {
        if (!localStorage.getItem('auth_token')) {
            navigate('/login');
        } else {
            axios
                .post('/api/road_like', likeData)
                .then((res) => {
                    setLike(res.data);
                })
                .catch((e) => {
                    console.log(e);
                })
        }
    }

    let likeButton;

    if (like === true ) {
        likeButton = <div className='text-red-600'><FontAwesomeIcon icon={faHeart} size="lg" /></div>
    } else {
        likeButton = <div><FontAwesomeIcon icon={faHeart} size="lg" /></div>
    }

    return (
        <Card>
            <div key={props.id}>
                <Link to={`/roads/${props.id}`} >
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
                    <div className='flex justify-between'>
                        <h2 className="text-left title-font lg:text-lg text-4xl font-medium text-gray-900 mb-3">
                            {props.title}
                        </h2>
                        <button onClick={likeHandler}>
                            {likeButton}
                        </button>
                    </div>
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
