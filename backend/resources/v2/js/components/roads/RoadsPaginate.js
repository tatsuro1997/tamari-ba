import { useState, useEffect } from 'react';
import ReactPaginate from 'react-paginate';

import RoadList from './RoadList';
import LoadingSpinner from '../ui/LoadingSpiner';

const RoadsPaginate = (props) => {
    const [currentRoads, setCurrentRoads] = useState([]);
    const [pageCount, setPageCount] = useState(0);
    const [roadOffset, setroadOffset] = useState(0);
    const [roads, setRoads] = useState([]);

    const ROADSPERPAGE = 12;

    useEffect(() => {
        setRoads(props.roads.sort(function (a, b) {
            return (a.updated_at > b.updated_at) ? -1 : 1;
        }));
    }, [props.roads])

    useEffect(() => {
        // Fetch roads from another resources.
        const endOffset = roadOffset + ROADSPERPAGE;
        setCurrentRoads(roads.slice(roadOffset, endOffset));
        setPageCount(Math.ceil(roads.length / ROADSPERPAGE));
    }, [roadOffset, ROADSPERPAGE, roads]);

    // Invoke when user click to request another page.
    const handlePageClick = (event) => {
        const newOffset = (event.selected * ROADSPERPAGE) % roads.length;
        setroadOffset(newOffset);
    };

    return (
        <>
            {currentRoads.length === 0 && <div className="text-center"><LoadingSpinner /></div>}
            {currentRoads.length === 0 && <div className="text-center">まだ投稿がありません。。。</div>}
            {currentRoads && <RoadList
                roads={currentRoads}
            />}
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
