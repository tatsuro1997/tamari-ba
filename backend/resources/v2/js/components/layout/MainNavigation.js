import { Link } from 'react-router-dom';

import icon from '../../../../../public/images/icon.webp'

const MainNavigation = () => {
    return (
        <header className="w-full lg:h-20 h-24 flex justify-between bg-white p-4 border-b">
            <div className='flex lg:w-1/4 w-1/2'>
                <img loading="lazy" width="50" height="50" src={icon} alt="icon" className="lazyload h-14 sm:mr-4 sm:pb-2" />
                <Link to="/">
                    <button className="lg:text-3xl text-6xl icon-color font-bold leading-10 mt-2">Tamari-Ba</button>
                </Link>
            </div>
            <nav className="lg:w-3/4 w-2/3 flex justify-between leading-8">
                <ul className="flex">
                    <li className="mr-4 nav-content">
                        <Link to="roads">道の投稿</Link>
                    </li>
                    {/* <li className="mr-4 nav-content">
                        <Link to="v2/bikes">バイクの投稿</Link>
                    </li> */}
                    <li className="nav-content">
                        <Link to="boards">コミュニティ</Link>
                    </li>
                </ul>
                {/* <ul className="flex">
                    <li className="mr-4 nav-login">
                        <Link to="v2/login">ログイン</Link>
                    </li>
                    <li className="nav-signin-button">
                        <Link to="v2/register">Tamari-Baに参加</Link>
                    </li>
                </ul> */}
            </nav>
        </header>
    );
};

export default MainNavigation;
