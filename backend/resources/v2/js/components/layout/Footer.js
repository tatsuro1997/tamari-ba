import icon from '../../../../../public/images/icon.webp'

const Footer = () => {
    return (
        <footer className="text-gray-600 body-font">
            <div className="w-full sm:py-10 mx-auto sm:flex sm:justify-around">
                <div className="ml-4 text-center">
                    <div className='flex'>
                        <img loading="lazy" width="50" height="50" srcset={icon} alt="icon" className="lazyload h-14 sm:mr-4 sm:pb-2" />
                        <div className="text-2xl icon-color font-bold leading-10">Tamari-Ba</div>
                    </div>
                    <p className="mt-2 text-sm text-gray-500">あなたの好きが、「たまり場」を創る。</p>
                </div>
                <div className="flex flex-wrap text-center mt-4 sm:pt-20">
                    <div className="w-full px-4">
                        <nav className="list-none mb-10 flex flex-wrap">
                            <li className='footer-nav-content'>
                                お問い合わせ
                            </li>
                            <li className='ml-4 footer-nav-content'>
                                利用規約
                            </li>
                            <li className='ml-4 footer-nav-content'>
                                プライバシーポリシー
                            </li>
                        </nav>
                    </div>
                </div>
            </div>
            <div className="bg-gray-100">
                <div className="container mx-auto py-4 px-5">
                    <p className="text-gray-500 text-sm text-center">Copyright © Tamari-Ba 2022 Rights Reserved.</p>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
