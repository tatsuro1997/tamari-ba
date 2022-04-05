const MainNavigation = () => {
    return (
        <header className="w-full h-16 flex justify-between bg-white p-4">
            <div className="w-1/4 text-2xl icon-color font-bold">Tamari-Ba</div>
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
