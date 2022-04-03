import RoadItem from "./RoadItem";

const RoadList = (props) => {
    return (
        <ul>
            {props.roads.map(road => (
                <RoadItem
                    key={road.id}
                    id={road.id}
                    title={road.title}
                    filename={road.filename}
                    created_at={road.created_at}
                />
            ))}
        </ul>
    );
};

export default RoadList;
