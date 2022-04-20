import { useState, useEffect } from 'react';
import ReactPaginate from 'react-paginate';

import RoadItem from '../roads/RoadItem';

const RoadsPaginate = (props) => {
    const [currentRoads, setCurrentRoads] = useState(null);
    const [pageCount, setPageCount] = useState(0);
    const [roadOffset, setroadOffset] = useState(0);
    const [roads, setRoads] = useState([]);

    const roadsPerPage = props.roadsPerPage;

    useEffect(() => {
        setRoads(props.roads);
    }, [props.roads])

    useEffect(() => {
        // Fetch roads from another resources.
        const endOffset = roadOffset + roadsPerPage;
        console.log(`Loading roads from ${roadOffset} to ${endOffset}`);
        setCurrentRoads(roads.slice(roadOffset, endOffset));
        setPageCount(Math.ceil(roads.length / roadsPerPage));
    }, [roadOffset, roadsPerPage, roads]);

    // Invoke when user click to request another page.
    const handlePageClick = (event) => {
        const newOffset = (event.selected * roadsPerPage) % roads.length;
        console.log(
            `User requested page number ${event.selected}, which is offset ${newOffset}`
        );
        setroadOffset(newOffset);
    };

    return (
        <>
            {currentRoads && currentRoads.map(road => (
                <RoadItem
                    key={road.id}
                    id={road.id}
                    title={road.title}
                    filename={road.filename}
                    user_name={road.user_name}
                    description={road.description}
                    created_at={road.created_at}
                    updated_at={road.updated_at}
                />
            ))}
            <ReactPaginate
                breakLabel="..."
                nextLabel="next >"
                onPageChange={handlePageClick}
                pageRangeDisplayed={5}
                pageCount={pageCount}
                previousLabel="< previous"
                renderOnZeroPageCount={null}
            />
        </>
    );
};

    export default RoadsPaginate;
