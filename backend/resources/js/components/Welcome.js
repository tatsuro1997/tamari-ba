import React, { useState, useEffect, Fragment } from 'react';
import ReactDOM from 'react-dom';

function Welcome() {
    const [roads, setRoads] = useState([]);

    useEffect(
        () => {
            axios
                .get('/api/welcome')
                .then((res) => {
                    setRoads(res.data.data);
                })
                .catch((e) => {
                    console.log(e);
                })
        }, []);

    return (
        <Fragment>
            {
                roads.map((road) => {
                    return (
                        <div key={road.id}>
                            <h2>タイトル:{road.title}</h2>
                            <p>投稿日:{road.created_at}</p>
                            <img src={road.filename} />
                        </div>
                    );
                })
            }
        </Fragment>
    )
}

ReactDOM.render(
    <Welcome />,
    document.getElementById('welcome')
)
