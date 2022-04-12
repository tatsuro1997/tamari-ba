import React, { useState, useEffect, Fragment } from 'react';

import RoadList from "../components/roads/RoadList";

const Roads = () => {

    const [loadedRoads, setLoadedRoads] = useState([]);

    useEffect(
        () => {
            axios
                .get('/api/roads')
                .then((res) => {
                    setLoadedRoads(res.data.data);
                })
                .catch((e) => {
                    console.log(e);
                })
        }, []);

    return (
        <Fragment>
            <RoadList roads={loadedRoads}/>
        </Fragment>
    )
};

export default Roads;
