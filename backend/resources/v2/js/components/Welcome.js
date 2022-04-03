import React, { useState, useEffect, Fragment } from 'react';
import ReactDOM from 'react-dom';

import RoadList from './roads/RoadList';

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
            <RoadList roads={LoadedRoads} />
        </Fragment>
    )
}

export default Welcome;
