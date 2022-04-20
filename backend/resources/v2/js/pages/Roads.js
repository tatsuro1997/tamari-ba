import React, { useState, useEffect, Fragment } from 'react';

import RoadList from "../components/roads/RoadList";
import { PrefectureEnum } from './PrefectureEnum';

const Roads = () => {
    const [loadedRoads, setLoadedRoads] = useState([]);
    const [filteredRoads, setFilteredRoads] = useState([]);
    const [searchKeyword, updateSearchKeyword] = useState('');

    useEffect(
        () => {
                axios
                    .get('/api/roads')
                    .then((res) => {
                        setLoadedRoads(res.data.data);
                        setFilteredRoads(res.data.data);
                    })
                    .catch((e) => {
                        console.log(e);
                    })
        }, []);

    const searchChangeHandler = event => {
        updateSearchKeyword(event.target.value);
        let value = event.target.value.toLowerCase();
        let result = [];

        if (value !== '') {
            result = loadedRoads.filter((road) => {
                const PrefectireId = PrefectureEnum()[value];

                switch (true) {
                    case road.title.includes(value):
                        return value;
                    case road.prefecture_id === Number(PrefectireId):
                        return value;
                }
            });
            setFilteredRoads(result);
        } else {
            setFilteredRoads(loadedRoads);
        }
    }

    return (
        <Fragment>
            <div className='w-1/2 mx-auto'>
                <input
                    id="search-keyword"
                    type="text"
                    placeholder={"北海道, 東京, 沖縄, ビーナスライン, スカイライン"}
                    onChange={searchChangeHandler}
                    className="search"
                />
            </div>
            <RoadList
                roads={filteredRoads}
                searchKeyword={searchKeyword}
            />
        </Fragment>
    )
};

export default Roads;
