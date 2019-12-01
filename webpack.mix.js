const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/libs/bootstrap.js', 'public/js')
    .js('resources/js/libs/jquery.js', 'public/app.js')
    .js('resources/js/libs/metisMenu.js', 'public/app.js')
    .js('resources/js/libs/sb-admin-2.js', 'public/app.js')
    .js('resources/js/libs/scripts.js', 'public/app.js')
    .styles([
        'resources/sass/libs/blog-post.css',
        'resources/sass/libs/bootstrap.css',
        'resources/sass/libs/bootstrap.min.css',
        'resources/sass/libs/font-awesome.css',
        'resources/sass/libs/metisMenu.css',
        'resources/sass/libs/sb-admin-2.css',
        'resources/sass/libs/styles.css'
    ],'public/css/app.css');








