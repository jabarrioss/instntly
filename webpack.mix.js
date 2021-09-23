const { copyDirectory } = require('laravel-mix');
const mix = require('laravel-mix');

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
    // .copyDirectory('resources/assets', 'public/black')
    .copyDirectory('resources/js', 'public/assets/js')
    .copyDirectory('resources/css', 'public/assets/css')
    .copyDirectory('resources/img', 'public/assets/img')
    .copyDirectory('resources/fonts', 'public/assets/fonts')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
