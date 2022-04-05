import icon from '../../../../../public/images/icon.webp'

const MainNavigation = () => {
    return (
        <header className="w-full h-20 flex justify-between bg-white p-4">
            <div className='flex w-1/4'>
                <img loading="lazy" width="50" height="50" src={icon} alt="icon" className="lazyload h-14 sm:mr-4 sm:pb-2" />
                <div className="text-2xl icon-color font-bold leading-10">Tamari-Ba</div>
            </div>
            <nav className="w-3/4 flex justify-between leading-8">
                <ul className="flex">
                    <li className="mr-4 nav-content">
                        道の投稿
                    </li>
                    <li className="mr-4 nav-content">
                        バイクの投稿
                    </li>
                    <li className="nav-content">
                        ツーリング掲示板
                    </li>
                </ul>
                <ul className="flex">
                    <li className="mr-4 nav-login">ログイン</li>
                    <li className="nav-signin-button">Tamari-Baに参加</li>
                </ul>
            </nav>
        </header>
    );
};

export default MainNavigation;
