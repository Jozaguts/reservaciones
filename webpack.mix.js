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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/users.scss', 'public/css')
   .sass('resources/sass/login-resposive.scss', 'public/css')

   mix.browserSync({
      proxy:'reservaciones-dev.com'
   });
   
   mix.scripts([
      'resources/js/main.js'],
         'public/js/all.js');
         mix.scripts([
            'resources/js/admin.js'],
               'public/js/admin.js');