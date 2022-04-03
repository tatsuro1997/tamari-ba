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
            {/* {
                roads.map((road) => {
                    return (
                        <div key={road.id}>
                            <h2>タイトル:{road.title}</h2>
                            <p>投稿日:{road.created_at}</p>
                            <img src={road.filename} />
                        </div>
                    );
                })
            } */}
        </Fragment>
    )
}

export default Welcome;
