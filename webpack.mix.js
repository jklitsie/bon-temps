let mix = require('laravel-mix');

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
//
// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');



mix
// Base Scripts
    .js('resources/assets/js/jquery-3.2.1.min.js',  'public/js/jquery.min.js')
    .js('resources/assets/js/bootstrap.js',         'public/js/bootstrap.js')
    .js('resources/assets/js/popper.min.js',        'public/js/popper.min.js')
    .js('resources/assets/js/mdb.js',           'public/js/mdb.js')

    .sass('resources/assets/scss/mdb.scss',             'public/css')
    .sass('resources/assets/scss/bootstrap/bootstrap.scss',             'public/css/bootstrap.css')

    // Modules
    .version();