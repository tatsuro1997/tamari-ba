import { Route, Routes } from "react-router-dom";

import Layout from './components/layout/Layout';
import Inquiry from "./pages/Inquiry";
import PrivacyPolicy from "./pages/PrivacyPolicy";
import RoadDetail from "./pages/RoadDetail";
import Roads from "./pages/Roads";
import TermsOfService from "./pages/TermsOfService";
import Welcome from './pages/Welcome';


function App() {
    return (
        <div>
            <Layout>
                <Routes>
                    <Route path="v2/welcome" element={<Welcome />} />
                    <Route path="v2/roads" element={<Roads />} />
                    <Route path="v2/roads/:roadId" element={<RoadDetail />} />
                    <Route path="inquiry" element={<Inquiry />} />
                    <Route path="terms_of_service" element={<TermsOfService />} />
                    <Route path="privacy_policy" element={<PrivacyPolicy />} />
                </Routes>
            </Layout>
        </div>
    );
}

export default App;
