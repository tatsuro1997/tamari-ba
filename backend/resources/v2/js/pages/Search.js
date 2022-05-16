import React, { useState, useEffect } from 'react';
import { useLocation } from 'react-router-dom';

import Roads from './Roads';
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
            <RoadsPaginate
                roads={searchedRoads}
            />
        </>
    );
};

export default Search;
