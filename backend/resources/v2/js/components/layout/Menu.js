import React, { useState } from "react";
import { Link, useNavigate } from 'react-router-dom';
import { slide as Menu } from "react-burger-menu";

import axios from 'axios';
import swal from 'sweetalert';

export default props => {
    const navigate = useNavigate();
    const [uid, setUid] = useState('');

    const logoutSubmit = (e) => {
        e.preventDefault();

        axios.post(`/api/logout`).then(res => {
            if (res.data.status === 200) {
                localStorage.removeItem('auth_token', res.data.token);
                localStorage.removeItem('auth_name', res.data.username);
                swal("ログアウトしました", res.data.message, "success");
                navigate('/');
                location.reload();
            }
        });
    }

    if (localStorage.getItem('auth_token')) {
        axios
            .get('/api/user').then((res) => {
                setUid(res.data.id);
            })
    }

    let AuthButtons = '';

    if (!localStorage.getItem('auth_token')) {
        AuthButtons = (
            <Link to="/login" className="bm-item menu-item my-10 nav-content">ログイン</Link>
        );
    } else {
        AuthButtons = (
                <div className="bm-item menu-item my-10 nav-content">
                    <button onClick={logoutSubmit}>ログアウト</button>
                </div>
        );
    }

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

            {AuthButtons}

            {localStorage.getItem('auth_token') && <div className="mr-4 bm-item menu-item mb-10 nav-content">
                <Link to={/users/ + `${uid}`}>お気に入り一覧</Link>
            </div>}

            <Link
                to="/register"
                className="inline-block font-normal mx-auto text-black bg-orange-400 border-0 focus:outline-none hover:bg-orange-500 rounded-full text-2xl h-12 leading-10 text-center">
                Tamari-Baに参加
            </Link>

        </Menu>
    );
};
