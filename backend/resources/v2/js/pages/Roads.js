import React, { useState, useEffect } from 'react';

import RoadsPaginate from '../components/roads/RoadsPaginate';
import SearchModal from '../components/ui/SearchModal';
import { PrefectureEnum } from './PrefectureEnum';

const Roads = () => {
    const [loadedRoads, setLoadedRoads] = useState([]);
    const [filteredRoads, setFilteredRoads] = useState([]);

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

    const PREFECTURE = PrefectureEnum();

    return (
        <>
            <SearchModal keyword={PREFECTURE} />
            <div className='w-1/2 mx-auto'>
                <label>ワード検索</label>
                <input
                    id="search-keyword"
                    type="text"
                    placeholder={"北海道, 東京, 沖縄, ビーナスライン, スカイライン"}
                    onChange={searchChangeHandler}
                    className="search"
                />
            </div>
            <RoadsPaginate
                roads={filteredRoads}
            />
        </>
    )
};

export default Roads;
