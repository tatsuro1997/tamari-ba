import React, { useState, useEffect, Fragment } from 'react';

import RoadList from "../components/roads/RoadList";

const Roads = () => {

    const [LoadedRoads, setLoadedRoads] = useState([]);

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
            <RoadList roads={LoadedRoads}/>
        </Fragment>
    )
};

export default Roads;
