import { Link, useNavigate } from 'react-router-dom';

import axios from 'axios';
import swal from 'sweetalert';
import icon from '../../../../../public/images/icon.webp'

const MainNavigation = () => {
    const navigate = useNavigate();

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

    var AuthButtons = '';

    if (!localStorage.getItem('auth_token')) {
        AuthButtons = (
            <>
                <li className="mr-4 nav-login">
                    <Link to="/login">ログイン</Link>
                </li>
                <li className="nav-signin-button">
                    <Link to="/register">Tamari-Baに参加</Link>
                </li>
            </>
        );
    } else {
        AuthButtons = (
            <li className="mr-4 nav-login">
                <button onClick={logoutSubmit}>ログアウト</button>
            </li>
        );
    }

    return (
        <header className="w-full lg:h-20 h-24 flex justify-between bg-white p-4">
            <div className='flex lg:w-1/4 w-1/2'>
                <img loading="lazy" width="50" height="50" src={icon} alt="icon" className="lazyload h-14 sm:mr-4 sm:pb-2" />
                <Link to="v2/welcome">
                    <button className="lg:text-3xl text-6xl icon-color font-bold leading-10 mt-2">Tamari-Ba</button>
                </Link>
            </div>
            <nav className="lg:w-3/4 w-2/3 flex justify-between leading-8">
                <ul className="flex">
                    <li className="mr-4 nav-content">
                        <Link to="v2/roads">道の投稿</Link>
                    </li>
                    {/* <li className="mr-4 nav-content">
                        <Link to="v2/bikes">バイクの投稿</Link>
                    </li> */}
                    <li className="nav-content">
                        <Link to="v2/boards">コミュニティ</Link>
                    </li>
                </ul>
                <ul className="flex sm:hidden lg:inline-block">
                    {AuthButtons}
                </ul>
            </nav>
        </header>
    );
};

export default MainNavigation;
