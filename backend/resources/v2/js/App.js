import { Route, Routes } from "react-router-dom";

import Layout from './components/layout/Layout';
import Welcome from './pages/Welcome';
import Roads from "./pages/Roads";
import RoadDetail from "./pages/RoadDetail";
import Board from "./pages/Board";
import Inquiry from "./pages/Inquiry";
import TermsOfService from "./pages/TermsOfService";
import PrivacyPolicy from "./pages/PrivacyPolicy";
import NoMatch from "./pages/NoMatch";
import Search from "./pages/Search";


function App() {
    return (
        <div>
            <Layout>
                <Routes>
                    <Route path="/" element={<Welcome />} />
                    <Route path="roads" element={<Roads />} />
                    <Route path="roads/:roadId" element={<RoadDetail />} />
                    <Route path="roads/search" element={<Search />} />
                    <Route path="boards" element={<Board />} />
                    <Route path="inquiry" element={<Inquiry />} />
                    <Route path="terms_of_service" element={<TermsOfService />} />
                    <Route path="privacy_policy" element={<PrivacyPolicy />} />
                    <Route path="*" element={<NoMatch />} />
                </Routes>
            </Layout>
        </div>
    );
}

export default App;
