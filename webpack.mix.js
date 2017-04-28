const { mix } = require('laravel-mix');

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

mix.copy(
        'bower_components/sweetalert/dist/sweetalert-dev.js',
        'resources/assets/js/libs'
    ).copy(
        'bower_components/sweetalert/dist/sweetalert.css',
        'resources/assets/css/libs'
    );

mix.js([
         'resources/assets/js/app.js',
         'resources/assets/js/custom.js'
    ], 'public/assets/js/app.js')
    .sass('resources/assets/sass/app.scss',
         'public/assets/css/app.css')
   .styles([
        'resources/assets/css/libs/sweetalert.css'
    ],  'public/assets/css/libs.css')
   .scripts([
        //'bootstrap.js'
    ],  'public/assets/js/all.js')
    .scripts([
        'resources/assets/js/libs/sweetalert-dev.js'
    ],  'public/assets/js/libs.js');

/* Versioning for production
mix.version([
   'public/assets/css/app.css',
   'public/assets/css/libs.css',
   'public/assets/js/app.js'
   'public/assets/js/all.js'
   'public/assets/js/libs.js'
]); */
