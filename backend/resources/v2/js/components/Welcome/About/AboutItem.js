const AboutItem = (props) => {
    return (
        <div className="mt-20">
            <h1 className="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                {props.title}
            </h1>
            <p className="lg:w-2/3 mx-auto leading-relaxed text-base">
                {props.description}
            </p>
            {props.image &&
                <img
                    className="w-80 h-80 mx-auto"
                    width="100%"
                    height="100%"
                    src={props.image}
                />
            }
        </div>
    );
};

export default AboutItem;
