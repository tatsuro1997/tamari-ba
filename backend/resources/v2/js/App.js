import { Route, Routes } from "react-router-dom";

import Layout from './components/layout/Layout';
import Welcome from './pages/Welcome';

function App() {
    return (
        <div>
            <Layout>
                <Routes>
                    <Route path="v2/welcome" element={<Welcome />} />
                    <Route path="roads" element={<Welcome />} />
                    <Route path="bikes" element={<p>Bikes</p>} />
                </Routes>
            </Layout>
        </div>
    );
}

export default App;
