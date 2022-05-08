import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

import RoadsPaginate from '../components/roads/RoadsPaginate';
import { PrefectureEnum } from './PrefectureEnum';

const Roads = () => {
    const [loadedRoads, setLoadedRoads] = useState([]);
    const [filteredRoads, setFilteredRoads] = useState([]);
    const [searchKeyword, updateSearchKeyword] = useState('');

    const navigate = useNavigate();

    if (localStorage.getItem('auth_token')) {
        useEffect(() => {
            axios
                .get('/api/user').then((res) => {
                    axios
                        .get('/api/roads', {
                            params: {
                                uid: res.data.id
                            }
                        })
                        .then((res) => {
                            setLoadedRoads(res.data.data);
                            setFilteredRoads(res.data.data);
                        })
                        .catch((e) => {
                            console.log(e);
                        })
                }).catch(() => {
                    navigate('/login');
                })
        }, [])
    }

    if (!localStorage.getItem('auth_token')) {
        useEffect(() => {
            axios
                .get('/api/roads')
                .then((res) => {
                    setLoadedRoads(res.data.data);
                    setFilteredRoads(res.data.data);
                })
                .catch((e) => {
                    console.log(e);
                })
        }, [])
    }

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
        <>
            <div className='w-1/2 mx-auto'>
                <input
                    id="search-keyword"
                    type="text"
                    placeholder={"北海道, 東京, 沖縄, ビーナスライン, スカイライン"}
                    onChange={searchChangeHandler}
                    className="search"
                />
            </div>
            <RoadsPaginate
                roadsPerPage={12}
                roads={
                    filteredRoads.sort(function (a, b) {
                        return (a.updated_at > b.updated_at) ? -1 : 1;
                    })
                }
                searchKeyword={searchKeyword}
            />
        </>
    )
};

export default Roads;
