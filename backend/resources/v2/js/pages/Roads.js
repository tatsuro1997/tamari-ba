import React, { useState, useEffect, Fragment } from 'react';

import RoadList from "../components/roads/RoadList";

const Roads = () => {
    const [loadedRoads, setLoadedRoads] = useState([]);
    const [searchKeyword, updateSearchKeyword] = useState('');

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

    const searchChangeHandler = event => {
        updateSearchKeyword(event.target.value);
        let value = event.target.value.toLowerCase();
        let result = [];
        console.log(value);

        result = loadedRoads.filter((road) => {
            return road.title.includes(value);
        });
        setLoadedRoads(result);
    }

    return (
        <Fragment>
            <div>
                <label htmlFor="search-keyword">Search</label>
                <input
                    id="search-keyword"
                    type="text"
                    placeholder={"検索"}
                    onChange={searchChangeHandler}
                />
            </div>
            <RoadList
                roads={loadedRoads}
                searchKeyword={searchKeyword}
            />
        </Fragment>
    )
};

export default Roads;
