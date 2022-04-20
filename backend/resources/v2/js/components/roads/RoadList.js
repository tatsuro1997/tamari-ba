import Container from "../ui/ListContainer";
import RoadItem from "./RoadItem";
import RoadsPaginate from "../ui/RoadsPaginate";

const RoadList = (props) => {
    return (
        <Container>
            <RoadsPaginate roadsPerPage={4} roads={props.roads} />
        </Container>
    );
};

export default RoadList;
