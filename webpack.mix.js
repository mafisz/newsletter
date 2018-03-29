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

mix.setPublicPath('public_html/');

mix.js('resources/assets/js/app.js', 'js')
   .sass('resources/assets/sass/app.scss', 'css');

mix.copy('node_modules/tinymce/skins', 'js/skins');
mix.copy('node_modules/tinymce/plugins', 'js/plugins');
mix.copy('node_modules/tinymce/themes', 'js/themes');
mix.copy('node_modules/tinymce/langs', 'js/langs');

if (mix.inProduction()) {
    mix.version();
}