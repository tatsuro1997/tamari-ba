const Container = (props) => {
    return (
        <div className="container px-5 py-8 mx-auto">
            <ul className="-m-4">
                {props.children}
            </ul>
        </div>
    );
};

export default Container;
