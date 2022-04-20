import { Link } from 'react-router-dom';

import Card from "../ui/Card";
import noImage from '../../../../../public/images/no_image.webp';

const RoadItem = (props) => {
    return (
        <Card>
            <div key={props.id}>
                <Link to={`/v2/roads/${props.id}`}>
                    { !props.filename &&
                        <img
                            className="lazyload w-full lg:max-h-60 max-h-80 mx-auto bg-cover"
                            src={noImage}
                        />
                    }
                    <img
                        className="lazyload w-full lg:max-h-60 max-h-80 mx-auto bg-cover"
                        src={props.filename}
                    />
                </Link>
                <div className="p-6">
                    <h2 className="text-left title-font lg:text-lg text-4xl font-medium text-gray-900 mb-3">
                        {props.title}
                    </h2>
                    <div className="flex justify-end lg:text-lg text-xl">
                        <div className="leading-relaxed text-right">
                            {props.updated_at}
                        </div>
                        <div className="leading-relaxed text-right ml-2">
                            {props.user_name}
                        </div>
                    </div>
                </div>
            </div>
        </Card>
    );
};

export default RoadItem;
