import React, { useState } from "react";
import { Link } from "react-router-dom";
import { useForm } from "react-hook-form";
import { useNavigate } from "react-router";

import axios from "axios"

const Login = () => {
    const { register, handleSubmit, setError, clearErrors, formState: { errors } } = useForm();
    const navigate = useNavigate();
    const [loading, setLoading] = useState(false);

    const onSubmit = (data) => {
        setLoading(true)
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/api/login', data).then(() => {
                navigate('home')
            }).catch(error => {
                console.log(error)
                setError('submit', {
                    type: 'manual',
                    message: 'ログインに失敗しました'
                })
                setLoading(false)
            })
        })
    }

    return (
        <div className="p-4 max-w-screen-sm mx-auto">
            <h1 className="text-center text-xl font-bold pb-4 icon-color">ログイン</h1>
            <p className="auth-other-message">
                <Link to="/register" className="text-sm c-link">アカウントを持っていない方はこちら</Link>
            </p>
            <form className="py-4" onSubmit={e => { clearErrors(); handleSubmit(onSubmit)(e) }}>
                <div className="py-4">
                    <input
                        className="input"
                        variant="outlined"
                        type="email"
                        placeholder="メールアドレス"
                        {...register('email', {
                            required: '入力してください'
                        })}
                    />
                    {errors.email && <span className="block text-red-400">{errors.email.message}</span>}
                </div>
                <div className="py-4">
                    <input
                        className="input"
                        id="password"
                        type="password"
                        variant="outlined"
                        placeholder="パスワード"
                        {...register('password', {
                            required: '入力してください'
                        })}
                    />
                    {errors.password && <span className="block text-red-400">{errors.password.message}</span>}
                </div>
                <div className="text-center">
                    <div>
                        <button className="auth-button" type="submit" variant="contained">
                            Login
                        </button>
                    </div>
                    {errors.submit && <span className="block text-red-400">{errors.submit.message}</span>}
                </div>
            </form>
        </div>
    )
}

export default Login
