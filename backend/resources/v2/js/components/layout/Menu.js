import React from "react";
import { Link } from 'react-router-dom';
import { slide as Menu } from "react-burger-menu";

export default props => {
    return (
        <Menu {...props}>
            <Link to="/" className="menu-item mb-10 nav-content" >
                ホーム
            </Link>

            <Link to="roads" className="menu-item mb-10 nav-content" >
                道の投稿
            </Link>

            {/* <Link to="bikes" className="menu-item mb-4 nav-content" >
                バイクの投稿
            </Link> */}

            <Link to="boards" className="menu-item nav-content" >
                コミュニティ
            </Link>
        </Menu>
    );
};
