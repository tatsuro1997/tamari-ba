import React from "react";
import { Link } from 'react-router-dom';
import { slide as Menu } from "react-burger-menu";

export default props => {
    return (
        <Menu {...props}>
            <Link to="/v2/welcome" className="menu-item mb-10 nav-content" >
                ホーム
            </Link>

            <Link to="v2/roads" className="menu-item mb-10 nav-content" >
                道の投稿
            </Link>

            {/* <Link to="v2/bikes" className="menu-item mb-4 nav-content" >
                バイクの投稿
            </Link> */}

            <Link to="/v2/boards" className="menu-item nav-content" >
                ツーリング掲示板
            </Link>
        </Menu>
    );
};
