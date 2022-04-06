import React, { useState, useEffect, Fragment } from 'react';
import ReactDOM from 'react-dom';

import Swiper from './Welcome/Swiper';
import Main from './Welcome/Main';

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
            <Main roads={LoadedRoads} />
        </Fragment>
    )
}

export default Welcome;
