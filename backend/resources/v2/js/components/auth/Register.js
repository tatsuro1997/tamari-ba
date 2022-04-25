import React, { useState } from "react";
import { useNavigate, Link } from 'react-router-dom';

import axios from 'axios';
import swal from 'sweetalert';

function Register() {
    const navigate = useNavigate();

    const [registerInput, setRegister] = useState({
        name: '',
        email: '',
        password: '',
        error_list: [],
    });

    const handleInput = (e) => {
        e.persist();
        setRegister({ ...registerInput, [e.target.name]: e.target.value });
    }

    const registerSubmit = (e) => {
        e.preventDefault();

        const data = {
            name: registerInput.name,
            email: registerInput.email,
            password: registerInput.password,
        }

        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post(`/api/register`, data).then(res => {
                if (res.data.status === 200) {
                    localStorage.setItem('auth_token', res.data.token);
                    localStorage.setItem('auth_name', res.data.username);
                    swal("Success", res.data.message, "success");
                    navigate('/');
                } else {
                    setRegister({ ...registerInput, error_list: res.data.validation_errors });
                }
            });
        });
    }

    return (
        <div className="p-4 max-w-screen-sm mx-auto">
            <h1 className="text-center text-xl font-bold icon-color">アカウント作成</h1>
            <p className="auth-other-message">
                <Link to="/login" className="text-sm c-link">アカウントを持っている方はこちら</Link>
            </p>
            <form className="py-4" onSubmit={registerSubmit}>
                <div className="py-4">
                    <input
                        className="input"
                        variant="outlined"
                        placeholder="名前"
                        type="text"
                        name="name"
                        onChange={handleInput}
                        value={registerInput.name}
                        autoComplete="username"
                    />
                    {registerInput.error_list.name && <span className="block text-red-400">{registerInput.error_list.name}</span>}
                </div>
                <div className="py-4">
                    <input
                        className="input"
                        variant="outlined"
                        placeholder="メールアドレス"
                        type="email"
                        name="email"
                        onChange={handleInput}
                        value={registerInput.email}
                        autoComplete="username"
                    />
                    {registerInput.error_list.email && <span className="block text-red-400">{registerInput.error_list.email}</span>}
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
                        value={registerInput.password}
                        autoComplete="new-password"
                    />
                    {registerInput.error_list.password && <span className="block text-red-400">{registerInput.error_list.password}</span>}
                </div>
                <div className="text-center">
                    <button className="auth-button" type="submit" variant="contained">
                        アカウントを作成する
                    </button>
                    {registerInput.error_list.submit && <span className="block text-red-400">{registerInput.error_list.submit}</span>}
                </div>
            </form>
        </div>
    );
}

export default Register
