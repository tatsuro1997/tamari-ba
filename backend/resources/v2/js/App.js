import { Route, Routes } from "react-router-dom";

import Layout from './components/layout/Layout';
import Roads from "./pages/Roads";
import Welcome from './pages/Welcome';

function App() {
    return (
        <div>
            <Layout>
                <Routes>
                    <Route path="v2/welcome" element={<Welcome />} />
                    <Route path="v2/roads" element={<Roads />} />
                    <Route path="bikes" element={<p>Bikes</p>} />
                </Routes>
            </Layout>
        </div>
    );
}

export default App;
