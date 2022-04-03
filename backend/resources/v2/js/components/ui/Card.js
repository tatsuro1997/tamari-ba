const Card = (props) => {
    return (
        <div className="p-4 lg:w-1/3 md:w-1/2 w-full">
            <div className="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                {props.children}
            </div>
        </div>
    );
};

export default Card;
