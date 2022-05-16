
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

        hideSearchHandler();
        navigate('/roads/search', { state: { data: dataPushArray } });
    };

    return (
        <>
            {searchIsShown &&
                <Modal onClose={hideSearchHandler} >
                    <form onSubmit={searchSubmit}>
                        <div className="text-3xl lg:text-lg font-bold text-center my-6 lg:my-2">エリア絞り込み</div>
                        <hr className="my-2" />
                        <div className="px-4 text-4xl lg:text-lg">
                            {Object.keys(props.keyword).map((val, index) => (
                                <label
                                    className="mr-6 w-30 inline-block py-1"
                                    key={index.toString()}
                                >
                                    <input
                                        id={index}
                                        value={val}
                                        type="checkbox"
                                        onChange={handleChange}
                                        checked={checkedItems[val.id]}
                                        className="mr-2 text-red-50 w-8 lg:w-6 h-8 lg:h-6 rounded-md checked:bg-orange-400"
                                    />
                                    {val}
                                </label>
                            ))}
                        </div>
                        <hr className="mt-4" />
                        <button
                            type="submit"
                            className="w-full rounded-b-lg text-3xl lg:text-lg font-bold mx-auto text-black bg-orange-400 border-0 py-4 px-10 focus:outline-none hover:bg-orange-500 "
                        >
                            このエリアで絞り込む
                        </button>
                    </form>
                </Modal>
            }
            <button
                onClick={showSearchHandler}
                className="flex lg:font-bold mx-auto text-black bg-orange-400 border-0 py-4 px-10 focus:outline-none hover:bg-orange-500 rounded-full lg:text-lg text-3xl mb-4"
            >
                都道府県で検索
            </button>
        </>
    );
};

export default SearchModal;
