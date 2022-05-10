import { useNavigate } from "react-router-dom";

const BackButton = () => {
    const navigate = useNavigate();

    const backButton = () => {
        navigate(-1);
    }

    return (
        <div className="flex justify-end mb-2 mr-10">
            <button
                onClick={backButton}
                className="text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg"
            >
                戻る
            </button>
        </div>
    )
};

export default BackButton;
