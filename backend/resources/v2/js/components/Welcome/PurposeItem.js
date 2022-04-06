const PurposeItem = (props) => {
    return (
        <div className="lg:w-1/3 sm:w-1/2 p-4">
            <img alt="gallery" className="w-full h-50 object-center lazyload" loading="lazy" width="480" height="270" src={props.image} />
            <div className="text-center">
                <h2 className="w-32 text-sm font-medium my-8 mx-auto py-1 border-b-2 border-orange-500">
                    {props.kind}
                </h2>
                <h3 className="title-font text-3xl font-medium text-gray-900 mb-3">
                    {props.title}
                </h3>
                <p className="text-lg">
                    {props.description}
                </p>
            </div>
        </div>
    );
};

export default PurposeItem;
