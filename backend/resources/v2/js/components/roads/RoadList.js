import Container from "../ui/ListContainer";
import RoadItem from "./RoadItem";
import Paginate from "../ui/Paginate";
// import PaginatedItems from "../ui/Paginate";

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
                    description={road.description}
                    created_at={road.created_at}
                    updated_at={road.updated_at}
                />
            ))}
            <Paginate roadsPerPage={4} roads={props.roads} />
            {/* <PaginatedItems itemsPerPage={4} /> */}
        </Container>
    );
};

export default RoadList;
