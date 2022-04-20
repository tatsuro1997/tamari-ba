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
            <div className='flex flex-wrap'>
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
            </div>
            {!location.pathname.match(/welcome/) &&
                <ReactPaginate
                    onPageChange={handlePageClick}
                    pageRangeDisplayed={5}
                    pageCount={pageCount}
                    renderOnZeroPageCount={null}

                    containerClassName="pagination justify-center" // ul(pagination本体)
                    pageClassName="page-item" // li
                    pageLinkClassName="page-link rounded-full" // a
                    activeClassName="active" // active.li
                    activeLinkClassName="active" // active.li < a

                    // 戻る・進む関連
                    previousClassName="page-item" // li
                    nextClassName="page-item" // li
                    previousLabel={'<'} // a
                    previousLinkClassName="previous-link"
                    nextLabel={'>'} // a
                    nextLinkClassName="next-link"

                    // 先頭 or 末尾に行ったときにそれ以上戻れ(進め)なくする
                    disabledClassName="disabled-button d-none"

                    // 中間ページの省略表記関連
                    breakLabel="..."
                    breakClassName="page-item"
                    breakLinkClassName="page-link"
                />
            }
        </>
    );
};

    export default RoadsPaginate;
