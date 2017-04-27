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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
mix.styles([
   'public/css/vendor/normalize.css',
   'public/css/vendor/videojs.css'
], 'public/css/all.css');
mix.scripts([
   '../../../node_modules/jquery/dist/jquery.js',
   '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js'
], 'public/js/all.js');
mix.version([
   'css/all.css',
   'js/all.js'
]);
mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
