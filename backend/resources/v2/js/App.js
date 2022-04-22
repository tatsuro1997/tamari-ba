import { Route, Routes } from "react-router-dom";

import Layout from './components/layout/Layout';
import Welcome from './pages/Welcome';
import Roads from "./pages/Roads";
import RoadDetail from "./pages/RoadDetail";
import Board from "./pages/Board";
import Inquiry from "./pages/Inquiry";
import TermsOfService from "./pages/TermsOfService";
import PrivacyPolicy from "./pages/PrivacyPolicy";
import Register from "./components/auth/Register";
import Login from "./components/auth/login";


function App() {
    return (
        <div>
            <Layout>
                <Routes>
                    <Route path="v2/welcome" element={<Welcome />} />
                    <Route path="v2/roads" element={<Roads />} />
                    <Route path="v2/roads/:roadId" element={<RoadDetail />} />
                    <Route path="v2/boards" element={<Board />} />
                    <Route path="inquiry" element={<Inquiry />} />
                    <Route path="terms_of_service" element={<TermsOfService />} />
                    <Route path="privacy_policy" element={<PrivacyPolicy />} />
                    <Route path="v2/register" element={<Register />} />
                    <Route path="v2/login" element={<Login />} />
                </Routes>
            </Layout>
        </div>
    );
}

export default App;
