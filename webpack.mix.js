const mix = require('laravel-mix');
const path = require('path');

mix.browserSync({
    open: false,
    proxy: process.env.APP_URL
});

mix.webpackConfig({
    resolve: {
        alias: {
            ziggy: path.resolve('vendor/tightenco/ziggy/src/js/route.js'),
        },
    },
});

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/scripts.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version();
