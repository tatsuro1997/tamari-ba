import { useLocation } from 'react-router-dom'

import Swiper from './Swiper';

const ShowWelcomeSwiper = () => {
    let location = useLocation();

    if (location.pathname === '/') {
        return <Swiper />;
    }
    return (
        null
    )
}

export default ShowWelcomeSwiper;
