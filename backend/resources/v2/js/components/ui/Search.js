import { useState } from "react";

import Modal from "./Modal";

const Search = () => {
    const [searchIsShown, setSearchIsShown] = useState(false);

    const showSearchHandler = () => {
        setSearchIsShown(true);
    };

    const hideSearchHandler = () => {
        setSearchIsShown(false);
    };

    return (
        <>
            {searchIsShown &&
                <Modal onClose={hideSearchHandler}>
                    検索窓
                </Modal>
            }
            <button onClick={showSearchHandler}>検索</button>
        </>
    );
};

export default Search;
