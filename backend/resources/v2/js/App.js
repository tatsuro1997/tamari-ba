import { Route, Routes } from "react-router-dom";

import Layout from './components/layout/Layout';
import Welcome from './components/Welcome';

function App() {
    return (
        <div>
            <Layout>
                <Routes>
                    <Route path="v2/welcome/*" element={<Welcome />} />
                    {/* <Route path="roads">
                        <Welcome />
                    </Route> */}
                </Routes>
            </Layout>
        </div>
    );
}

export default App;
