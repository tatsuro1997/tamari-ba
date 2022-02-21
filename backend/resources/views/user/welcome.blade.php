<x-app-layout>
    <div class="w-full text-center relative z-0">
        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img class="lazyload w-full h-80 sm:h-screen" width="100%" height="100vh" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/main_1.webp') }}"></div>
                <div class="swiper-slide"><img class="lazyload w-full h-80 sm:h-screen" width="100%" height="100vh" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/main_2.webp') }}"></div>
                <div class="swiper-slide"><img class="lazyload w-full h-80 sm:h-screen" width="100%" height="100vh" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/other.webp') }}"></div>
                <div class="swiper-slide"><img class="lazyload w-full h-80 sm:h-screen" width="100%" height="100vh" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/enjoy.webp') }}"></div>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <x-flash-message status="session('status')" />
    <div class="absolute left-10 lg:top-72 top-32 z-10">
        <h1 class="lg:text-6xl text-3xl text-white">Tamari-Ba</h1>
        <h2 class="lg:text-4xl text-xl text-white lg:mt-10 mt-4">あなたの好きが、<br>「たまり場」を創る。</h2>
    </div>
    <div class="p-3 bg-white">
        <section class="text-gray-600 body-font">
            <div class="p-2 w-full my-20">
                <button onclick="location.href='{{ route('user.register') }}'" class="flex font-bold mx-auto text-black bg-orange-400 border-0 py-4 px-10 focus:outline-none hover:bg-orange-500 rounded-full text-lg">Tamari-Baをはじめる</button>
            </div>
            <div class="container px-5 py-16 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                    <div class="mx-auto">
                        <h1 class="text-3xl lg:text-5xl font-medium title-font mb-4 text-gray-900">Tamari-Baとは？</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">バイカー同士の情報共有サイトです。</p>
                        <img class="w-full h-full mx-auto" width="100%" height="100%" src="{{ asset('images/map.webp') }}">
                    </div>
                    <div class="mt-20">
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">愛車の共有</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tamari-Baユーザーのこだわりの愛車を共有可能<br>
                            他のバイクを見て、次に買うバイクを決めたり、カスタムパーツを知ることが可能</p>
                    </div>
                    <div class="mt-20">
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">コアな道の共有</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">大好きなツーリングスポットを共有<br>
                            Tamari-Baユーザーのお気に入りスポットを閲覧<br>
                            次のツーリングスポットを見つけられる</p>
                    </div>
                    <div class="mt-20">
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">ツーリング募集</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">この時期だからこそ、みんなでバイクに乗ろう<br>
                            一人では味わえないツーリングを見つけよう</p>
                    </div>
                    <div class="mt-20">
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Tamari-Ba作成背景</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">バイク乗り達が自分のバイク、好きな道、きつかった道、楽しかった道の駅等を語り合う「たまり場」をイメージして作成。いつも行くあのカフェ、あの道の駅等の集まってダベれる「たまり場」のように好きなスポットについて語り合えるようなサイトです。<br>
                            ツーリングに行く際に、目的地までの道が重要なのだが道を紹介するサイトが少ない（もしくはバイク乗りなら誰でも知っているような内容しかなかった）という課題から、
                            道やスポットを紹介し、交流できる場が必要だと感じ作成。</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-16 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                    <div>
                        <h1 class="sm:text-3xl lg:text-5xl font-medium title-font mb-4 text-gray-900">Tamari-Baの楽しみ方</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">ソロでバイクを楽しみたい、複数人でツーリングに行きたい方やバイクをキッカケに活動の幅を広げていきたい方など、幅広い年代・目的でご利用いただけます。</p>
                    </div>
                </div>
                <div class="flex flex-wrap -m-4">
                    <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <img alt="gallery" class="w-full h-50 object-center lazyload" loading="lazy" width="480" height="270" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/solo.webp') }}">
                        <div class="text-center">
                            <h2 class="w-32 text-sm font-medium my-8 mx-auto py-1 border-b-2 border-orange-500">ソロ</h2>
                            <h1 class="title-font text-3xl font-medium text-gray-900 mb-3">ツーリングスポットはTamari-Baで!</h1>
                            <p class="text-lg">Tamari-Baではユーザーお気に入りのツーリングスポットが数々紹介されています。目的地が決まっていないときや目的地周辺で次に行くスポットを探すときなどに便利です。</p>
                        </div>
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <img alt="gallery" class="w-full h-50 object-center lazyload" loading="lazy" width="480" height="270" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/touring.webp') }}">
                        <div class="text-center">
                            <h2 class="w-32 text-sm font-medium my-8 mx-auto py-1 border-b-2 border-orange-500">ツーリング</h2>
                            <h1 class="title-font text-3xl font-medium text-gray-900 mb-3">もちろんツーリングも!</h1>
                            <p class="text-lg">同じ目的地に行くのであれば、Tamari-Baユーザーとツーリングをしてみませんか？ソロやいつもの仲間で走るより、知らないバイクを間近で見ることやバイカー同士で会話をするツーリングは同じ目的地に行くのでも格別です。</p>
                        </div>
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <img alt="gallery" class="w-full h-50 object-center lazyload" loading="lazy" width="480" height="270" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/custom.webp') }}">
                        <div class="text-center">
                            <h2 class="w-32 text-sm font-medium my-8 mx-auto py-1 border-b-2 border-orange-500">カスタム</h2>
                            <h1 class="title-font text-3xl font-medium text-gray-900 mb-3">あなたのバイクはこう変わる</h1>
                            <p class="text-lg">Tamari-Baユーザーの愛車を見ることができます。そこには今乗っている愛車と同じバイクもあるはずです。まだ手を入れていないあなたの愛車もカスタムをすることでさらに愛着が湧くはずです。</p>
                        </div>
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4 lg:mt-20">
                        <img alt="gallery" class="w-full h-50 object-center lazyload" loading="lazy" width="480" height="270" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/communicate.webp') }}">
                        <div class="text-center">
                            <h2 class="w-32 text-sm font-medium my-8 mx-auto py-1 border-b-2 border-orange-500">交流</h2>
                            <h1 class="title-font text-3xl font-medium text-gray-900 mb-3">バイカー専用SNS</h1>
                            <p class="text-lg">Tamari-Baはバイク専用のSNSです。ユーザーの愛車やお気に入りの道の投稿に対してコメントすることができます。投稿へのコメントから一緒にツーリングに行くキッカケがうまれます。積極的にコメントすることでTamari-Baすることができます。</p>
                        </div>
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4 lg:mt-20">
                        <img alt="gallery" class="w-full h-50 object-center lazyload" loading="lazy" width="480" height="270" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/other.webp') }}">
                        <div class="text-center">
                            <h2 class="w-32 text-sm font-medium my-8 mx-auto py-1 border-b-2 border-orange-500">バイク✕？？</h2>
                            <h1 class="title-font text-3xl font-medium text-gray-900 mb-3">バイクと組み合わせる</h1>
                            <p class="text-lg">Tamari-Baではバイクを入り口に、カフェや道の駅、バイクと組み合わせてできる趣味の仲間を見つけることができます。そこではバイクが軸となり広がっていくTamari-Baがあります。バイクをキッカケにキャンプやカメラ、釣りなど相性の良い趣味の幅を広げていきましょう。</p>
                        </div>
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4 lg:mt-20">
                        <img alt="gallery" class="w-full h-50 object-center lazyload" loading="lazy" width="480" height="270" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/enjoy.webp') }}">
                        <div class="text-center">
                            <h2 class="w-32 text-sm font-medium my-8 mx-auto py-1 border-b-2 border-orange-500">Enjoy</h2>
                            <h1 class="title-font text-3xl font-medium text-gray-900 mb-3">見るだけで楽しい!</h1>
                            <p class="text-lg">もしまだ愛車がなくても大歓迎!バイクの免許を取りに行こうとしている、次に買うバイクを悩んでいる、ただただバイクを見ることが好きだ!そんな方でも、次のバイクの検討や憧れのバイクを見つけて楽しめます。</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-16 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                    <div>
                        <h1 class="sm:text-3xl lg:text-5xl font-medium title-font mb-4 text-gray-900">最近の投稿</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tamari-Baでは全国のバイカーの愛車やおすすめスポットやコアな道を知ることができます。</p>
                    </div>
                    <div class="container px-5 py-8 mx-auto">
                        <x-road.index :roads="$roads" type="welcome" />
                    </div>
                    <div class="mt-20 bg-orange-300 py-10">
                        <h1 class="sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900">Tamari-Baに参加する</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-black">あなたの愛車やおすすめスポットを投稿してTamari-Baを充実させていきましょう!</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="p-2 w-full mb-40">
            <button onclick="location.href='{{ route('user.register') }}'" class="flex font-bold mx-auto text-black bg-orange-400 border-0 py-4 px-10 focus:outline-none hover:bg-orange-500 rounded-full text-lg">Tamari-Baをはじめる</button>
        </div>
    </div>
<script src="{{ mix('js/auto-swiper.js') }}"></script>
</x-app-layout>
