import { GoogleMap, LoadScript, Marker } from "@react-google-maps/api";
import { useState, useEffect } from "react";

import LoadingSpinner from "../ui/LoadingSpiner";

const containerStyle = {
    width: "100%",
    height: "25vh",
};

const BASE_POSITION = {
    lat: 35.6585769,
    lng: 139.7454506,
};

const Map = (props) => {
    const [isShowMarker, setIsShowMarker] = useState(false);
    const [center, setCenter] = useState(BASE_POSITION);

    if (isNaN(center.lat) || isNaN(center.lng)) {
        setCenter(BASE_POSITION);
    }

    useEffect(() => {
        const timer = setTimeout(() => {
            if (!isShowMarker) {
                setCenter({ lat: props.lat, lng: props.lng });
                setIsShowMarker(true);
            }
        }, 800);
        return () => {
            clearTimeout(timer);
        };
    }, [props])

    return (
        <LoadScript googleMapsApiKey={process.env.MIX_GOOGLE_MAP_API_KEY}>
            { !isShowMarker && <div className="text-center"><LoadingSpinner /></div> }
            { isShowMarker && <GoogleMap
                mapContainerStyle={containerStyle}
                center={center}
                zoom={15}
            >
                 <Marker position={center} />
            </GoogleMap>}
        </LoadScript>
    );
};

export default Map;
