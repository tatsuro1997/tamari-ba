import Container from "../ui/ListContainer";
import RoadItem from "./RoadItem";

const RoadList = (props) => {
    return (
        <Container>
            {props.roads.map(road => (
                <RoadItem
                    key={road.id}
                    id={road.id}
                    title={road.title}
                    filename={road.filename}
                    user_name={road.user_name}
                    created_at={road.created_at}
                    updated_at={road.updated_at}
                />
            ))}
        </Container>
    );
};

export default RoadList;
