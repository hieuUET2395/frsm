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
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/user/table.scss', 'public/css/user')
   .sass('resources/assets/sass/candidate/table.scss', 'public/css/candidate')
   .sass('resources/assets/sass/setting/table.scss', 'public/css/setting')
   .copy('node_modules/autosize/dist/autosize.min.js', 'public/js');
