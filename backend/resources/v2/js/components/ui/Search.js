import { useState } from "react";

import Modal from "./Modal";

const Search = (props) => {
    const [searchIsShown, setSearchIsShown] = useState(false);
    const [checkedItems, setCheckedItems] = useState({});

    const showSearchHandler = () => {
        setSearchIsShown(true);
    };

    const hideSearchHandler = () => {
        setSearchIsShown(false);
    };

    const handleChange = (event) => {
        console.log(event.target.id);
        console.log(event.target.checked);

        setCheckedItems({
            ...checkedItems,
            [event.target.value]: event.target.checked
        })

        console.log('checkedItems:', checkedItems)
    };

    const searchSubmit = (event) => {
        event.preventDefault();

        const dataPushArray = Object.entries(checkedItems).reduce((pre, [key, value]) => {
            value && pre.push(key)
            return pre
        }, [])
        console.log("dataPushArray:", dataPushArray)
    };

    return (
        <>
            {searchIsShown &&
                <Modal onClose={hideSearchHandler} >
                    <form onSubmit={searchSubmit}>
                        <div>エリア絞り込み</div>
                        {Object.keys(props.keyword).map((val, index) => (
                            <label
                                className="mr-4 w-20 inline-block"
                                key={index.toString()}
                            >
                                <input
                                    id={index}
                                    value={val}
                                    type="checkbox"
                                    onChange={handleChange}
                                    checked={checkedItems[val.id]}
                                    className="mr-2"
                                />
                                {val}
                            </label>
                        ))}
                        <button type="submit">このエリアで絞り込む</button>
                    </form>
                </Modal>
            }
            <button onClick={showSearchHandler}>検索</button>
        </>
    );
};

export default Search;
