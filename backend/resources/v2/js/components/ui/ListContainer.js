const Container = (props) => {
    return (
        <div className="container px-5 py-8 mx-auto">
            <ul className="flex flex-wrap -m-4">
                {props.children}
            </ul>
        </div>
    );
};

export default Container;
