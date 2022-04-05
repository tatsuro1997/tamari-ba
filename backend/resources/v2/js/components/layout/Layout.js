import MainNavigation from "./MainNavigation";
import Swiper from "../Welcome/Swiper";
import Footer from "./Footer";

const Layout = (props) => {
    return (
        <div>
            <MainNavigation />
            <Swiper />
            <main>{props.children}</main>
            <Footer />
        </div>
    );
};

export default Layout;
