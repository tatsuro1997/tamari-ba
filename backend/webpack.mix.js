const mix = require('laravel-mix');
const CompressionPlugin = require('compression-webpack-plugin');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    // 下記gz化するときにコンフリクトするのでコメント
    // .js('resources/js/swiper.js', 'public/js')
    // .js('resources/js/auto-swiper.js', 'public/js')
    // .js('resources/js/getLatLng.js', 'public/js')
    // .js('resources/js/setCurrentLocation.js', 'public/js')
    // .js('resources/js/lazyload.min.js', 'public/js')
    .autoload({
        "jquery": ['$', 'window.jQuery'],
    })
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    // gzip圧縮
    .webpackConfig({
        plugins: [
            new CompressionPlugin({
                filename: '[path].gz[query]',
                algorithm: 'gzip',
                test: /\.js$|\.css$|\.html$|\.svg$/,
                threshold: 10240,
                minRatio: 0.8,
            })
        ]
    });
