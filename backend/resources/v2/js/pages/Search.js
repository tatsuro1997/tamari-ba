import React, { useState, useEffect } from 'react';
import { useLocation } from 'react-router-dom';

import RoadsPaginate from '../components/roads/RoadsPaginate';
import SearchModal from '../components/ui/SearchModal';
import { PrefectureEnum } from './PrefectureEnum';


const PREFECTURE = PrefectureEnum();

const Search = () => {
    const location = useLocation();
    const { data } = location.state;

    const [searchedRoads, setSearchedRoads] = useState([]);

    useEffect(() => {
        axios
            .get('/api/search_roads', {
                params: {
                    search: data
                }
            })
            .then((res) => {
                setSearchedRoads(res.data.data);
            })
            .catch((e) => {
                console.log(e);
            })
    }, [data])

    return (
        <>
            <SearchModal keyword={PREFECTURE} />
            {/* <div className='w-1/2 mx-auto'>
                <input
                    id="search-keyword"
                    type="text"
                    placeholder={"北海道, 東京, 沖縄, ビーナスライン, スカイライン"}
                    onChange={searchChangeHandler}
                    className="search"
                />
            </div> */}
            <RoadsPaginate
                roadsPerPage={12}
                roads={
                    searchedRoads.sort(function (a, b) {
                        return (a.updated_at > b.updated_at) ? -1 : 1;
                    })
                }
            />
        </>
    );
};

export default Search;
