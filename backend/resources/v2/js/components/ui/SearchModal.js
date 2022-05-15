
import { useState } from "react";
import { useNavigate } from "react-router-dom";

import Modal from "./Modal";

const SearchModal = (props) => {
    const [searchIsShown, setSearchIsShown] = useState(false);
    const [checkedItems, setCheckedItems] = useState({});
    const navigate = useNavigate();

    const showSearchHandler = () => {
        setSearchIsShown(true);
    };

    const hideSearchHandler = () => {
        setSearchIsShown(false);
    };

    const handleChange = (event) => {
        setCheckedItems({
            ...checkedItems,
            [event.target.id]: event.target.checked
        })
    };

    const searchSubmit = (event) => {
        event.preventDefault();

        const dataPushArray = Object.entries(checkedItems).reduce((pre, [key, value]) => {
            value && pre.push(Number(key) + 1)
            return pre
        }, [])

        hideSearchHandler;
        navigate('/roads/search', { state: { data: dataPushArray } });
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

export default SearchModal;
