import Card from "../ui/Card";

const RoadItem = (props) => {
    return (
        <li>
            <Card>
                <div key={props.id}>
                    <h2>タイトル:{props.title}</h2>
                    <p>投稿日:{props.created_at}</p>
                    <img src={props.filename} />
                </div>
            </Card>
        </li>
    );
};

export default RoadItem;
