import { useEffect, useState } from "react";

import RoadsPaginate from "../components/roads/RoadsPaginate";

const UserPage = () => {
    // とりあえずお気に入りの一覧だけ表示する

    const [uid, setUid] = useState('');
    const [likedRoads, setLikedRoads] = useState([]);

    useEffect(() => {
        axios
            .get('/api/user').then((res) => {
                setUid(res.data.id);
            })
    }, [])

    useEffect(() => {
        axios
            .get('/api/road_likes', {
                params: {
                    uid: uid
                }
            })
            .then((res) => {
                setLikedRoads(res.data);
            })
            .catch((e) => {
                console.log(e);
            })
    }, [uid])

    return (
        <RoadsPaginate
            roadsPerPage={12}
            roads={
                likedRoads.sort(function (a, b) {
                    return (a.updated_at > b.updated_at) ? -1 : 1;
                })
            }
        />
    )
};

export default UserPage;
