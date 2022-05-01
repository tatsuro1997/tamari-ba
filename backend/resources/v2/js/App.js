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
import Login from "./components/auth/Login";
import NoMatch from "./pages/NoMatch";

import axios from 'axios';

axios.defaults.baseURL = "http://localhost:8080/";
axios.defaults.headers.post['Content-Type'] = 'application/json';
axios.defaults.headers.post['Accept'] = 'application/json';
axios.defaults.withCredentials = true;
axios.interceptors.request.use(function (config) {
    const token = localStorage.getItem('auth_token');
    config.headers.Authorization = token ? `Bearer ${token}` : '';
    return config;
});

function App() {
    return (
        <div>
            <Layout>
                <Routes>
                    <Route path="/" element={<Welcome />} />
                    <Route path="roads" element={<Roads />} />
                    <Route path="roads/:roadId" element={<RoadDetail />} />
                    <Route path="boards" element={<Board />} />
                    <Route path="inquiry" element={<Inquiry />} />
                    <Route path="terms_of_service" element={<TermsOfService />} />
                    <Route path="privacy_policy" element={<PrivacyPolicy />} />
                    <Route path="register" element={<Register />} />
                    <Route path="login" element={<Login />} />
                    <Route path="*" element={<NoMatch />} />
                </Routes>
            </Layout>
        </div>
    );
}

export default App;
