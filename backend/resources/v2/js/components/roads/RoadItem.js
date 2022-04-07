import Card from "../ui/Card";

const RoadItem = (props) => {
    return (
        <Card>
            <div key={props.id}>
                <img
                    className="lazyload w-full sm:max-h-60 max-h-52 mx-auto bg-cover"
                    src={props.filename}
                />
                <div className="p-6">
                    <h2 className="text-left title-font text-lg font-medium text-gray-900 mb-3">
                        {props.title}
                    </h2>
                    <div className="flex justify-end">
                        <div className="leading-relaxed text-right">
                            {props.created_at}
                        </div>
                        <div className="leading-relaxed text-right ml-2">投稿者名</div>
                    </div>
                </div>
            </div>
        </Card>
    );
};

export default RoadItem;
