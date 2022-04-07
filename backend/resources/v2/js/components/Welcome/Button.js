import { Link } from 'react-router-dom';

const Button = () => {
    return (
        <div className="p-2 w-full">
            <Link to="register">
                <button className="flex font-bold mx-auto text-black bg-orange-400 border-0 py-4 px-10 focus:outline-none hover:bg-orange-500 rounded-full text-lg">
                    Tamari-Baをはじめる
                </button>
            </Link>
        </div>
    );
};

export default Button;
