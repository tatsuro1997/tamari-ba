import MainNavigation from "./MainNavigation";
import ShowWelcomeSwiper from "../Welcome/ShowWelcomeSwiper";
import Footer from "./Footer";

const Layout = (props) => {
    return (
        <div>
            <MainNavigation />
            <ShowWelcomeSwiper />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            {props.children}
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </div>
    );
};

export default Layout;
