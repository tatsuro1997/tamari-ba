import { Route, Routes } from "react-router-dom";

import Layout from './components/layout/Layout';
import Inquiry from "./pages/Inquiry";
import RoadDetail from "./pages/RoadDetail";
import Roads from "./pages/Roads";
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
                </Routes>
            </Layout>
        </div>
    );
}

export default App;
