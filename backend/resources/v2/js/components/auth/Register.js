import React, { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import { useForm } from "react-hook-form";

import axios from "axios"

const Register = () => {
    const { register, handleSubmit, setError, formState: { errors } } = useForm();
    const navigate = useNavigate();
    const [loading, setLoading] = useState(false);

    const onSubmit = (data) => {
        setLoading(true)
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/api/register', data).then(() => {
                navigate('home')
            }).catch(error => {
                console.log(error)
                setError('submit', {
                    type: 'manual',
                    message: '登録に失敗しました。再度登録をしてください'
                })
                setLoading(false)
            })
        })
    }

    return (
        <div className="p-4 max-w-screen-sm mx-auto">
            <h1 className="text-center text-xl font-bold icon-color">アカウント作成</h1>
            <p className="auth-other-message">
                <Link to="/v2/login" className="text-sm c-link">アカウントを持っている方はこちら</Link>
            </p>
            <form className="py-4" onSubmit={handleSubmit(onSubmit)}>
                <div className="py-4">
                    <input
                        className="input"
                        variant="outlined"
                        placeholder="名前"
                        type="text"
                        {...register('name', {
                            required: '入力してください'
                        })}
                    />
                    {errors.name && <span className="block text-red-400">{errors.name.message}</span>}
                </div>
                <div className="py-4">
                    <input
                        className="input"
                        variant="outlined"
                        placeholder="メールアドレス"
                        type="email"
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
                            required: '入力してください',
                            minLength: {
                                value: 8,
                                message: '8文字以上で入力してください'
                            }
                        })}
                    />
                    {errors.password && <span className="block text-red-400">{errors.password.message}</span>}
                </div>
                <div className="py-4">
                    <input
                        className="input"
                        type="password"
                        variant="outlined"
                        placeholder="パスワード確認"
                        {...register('password_confirmation', {
                            required: '入力してください',
                            validate: {
                                // match: value => value === (document.getElementById('password') as HTMLInputElement).value || 'パスワードが一致しません'
                            }
                        })}
                    />
                    {errors.password_confirmation && <span className="block text-red-400">{errors.password_confirmation.message}</span>}
                </div>
                <div className="text-center">
                    <button className="auth-button" type="submit" variant="contained">
                        アカウントを作成する
                    </button>
                    {errors.submit && <span className="block text-red-400">{errors.submit.message}</span>}
                </div>
            </form>
        </div>
    )
}

export default Register
