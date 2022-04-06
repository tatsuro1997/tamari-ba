import MainNavigation from "./MainNavigation";
import Footer from "./Footer";

const Layout = (props) => {
    return (
        <div>
            <MainNavigation />
            <main className="py-16 mx-auto">
                {props.children}
            </main>
            <Footer />
        </div>
    );
};

export default Layout;
