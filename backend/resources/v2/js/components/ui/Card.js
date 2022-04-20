const Card = (props) => {
    return (
        <div className="p-4 lg:w-1/3 w-full">
            <li className="w-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                {props.children}
            </li>
        </div>
    );
};

export default Card;
