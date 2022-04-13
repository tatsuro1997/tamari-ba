const mix = require('laravel-mix');
const dotenvExpand = require('dotenv-expand');
const CompressionPlugin = require('compression-webpack-plugin');

mix.js('resources/js/app.js', 'public/js')
    .react()
    .sass('resources/sass/app.scss', 'public/css')
// 下記gz化するときにコンフリクトするのでコメント
    .js('resources/js/swiper.js', 'public/js')
    .js('resources/js/auto-swiper.js', 'public/js')
    .js('resources/js/getLatLng.js', 'public/js')
    .js('resources/js/setCurrentLocation.js', 'public/js')
    .js('resources/js/lazyload.min.js', 'public/js')
    .autoload({
        "jquery": ['$', 'window.jQuery'],
    })
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    // gzip圧縮
    // .webpackConfig({
    //     plugins: [
    //         new CompressionPlugin({
    //             filename: '[path].gz[query]',
    //             algorithm: 'gzip',
    //             test: /\.js$|\.css$|\.html$|\.svg$/,
    //             threshold: 10240,
    //             minRatio: 0.8,
    //         })
    //     ]
    // });
    
// .env.devの読み込み
dotenvExpand(require('dotenv').config({ path: './.env.dev'/*, debug: true*/ }));
