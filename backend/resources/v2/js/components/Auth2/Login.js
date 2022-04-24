import React, { useState } from "react";
import { useNavigate, Link } from 'react-router-dom';

import swal from "sweetalert";
import axios from 'axios';

function Login() {
    const navigate = useNavigate();

    const [loginInput, setLogin] = useState({
        email: '',
        password: '',
        error_list: [],
    });

    const handleInput = (e) => {
        e.persist();
        setLogin({ ...loginInput, [e.target.name]: e.target.value });
    }

    const loginSubmit = (e) => {
        e.preventDefault();

        const data = {
            email: loginInput.email,
            password: loginInput.password,
        }

        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post(`api/login`, data).then(res => {
                if (res.data.status === 200) {
                    localStorage.setItem('auth_token', res.data.token);
                    localStorage.setItem('auth_name', res.data.username);
                    swal("ログイン成功", res.data.message, "success");
                    navigate('/');
                    // location.reload();
                } else if (res.data.status === 401) {
                    swal("注意", res.data.message, "warning");
                } else {
                    setLogin({ ...loginInput, error_list: res.data.validation_errors });
                }
            });
        });
    }

    return (
        <div className="p-4 max-w-screen-sm mx-auto">
            <h1 className="text-center text-xl font-bold pb-4 icon-color">ログイン</h1>
            <p className="auth-other-message">
                <Link to="/register" className="text-sm c-link">アカウントを持っていない方はこちら</Link>
            </p>
            <form className="py-4" onSubmit={loginSubmit}>
                <div className="py-4">
                    <input
                        className="input"
                        variant="outlined"
                        type="email"
                        placeholder="メールアドレス"
                        name="email"
                        onChange={handleInput}
                        value={loginInput.email}
                        autoComplete="username"
                    />
                    {loginInput.error_list.email && <span className="block text-red-400">{loginInput.error_list.email}</span>}
                </div>
                <div className="py-4">
                    <input
                        className="input"
                        id="password"
                        type="password"
                        variant="outlined"
                        placeholder="パスワード"
                        name="password"
                        onChange={handleInput}
                        value={loginInput.password}
                        autoComplete="current-password"
                    />
                    {loginInput.error_list.password && <span className="block text-red-400">{loginInput.error_list.password}</span>}
                </div>
                <div className="text-center">
                    <div>
                        <button className="auth-button" type="submit" variant="contained">
                            Login
                        </button>
                    </div>
                    {loginInput.error_list.submit && <span className="block text-red-400">{loginInput.error_list.submit}</span>}
                </div>
            </form>
        </div>
    );
}

export default Login;
