import { Link } from 'react-router-dom';

const Button = () => {
    return (
        <div className="p-2 w-full">
            <Link to="roads">
                <button className="flex lg:font-bold mx-auto text-black bg-orange-400 border-0 py-4 px-10 focus:outline-none hover:bg-orange-500 rounded-full lg:text-lg text-3xl">
                    Tamari-Baをはじめる
                </button>
            </Link>
        </div>
    );
};

export default Button;
