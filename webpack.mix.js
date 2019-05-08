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
    .sass('resources/sass/hamburger-menu.scss', 'public/css')
   .sass('resources/sass/login-resposive.scss', 'public/css')
   .sass('resources/sass/tipoequipounidad.scss', 'public/css')
   .sass('resources/sass/equiposyunidades.scss', 'public/css')
   .sass('resources/sass/tipoactividades.scss', 'public/css')
   .sass('resources/sass/activities.scss', 'public/css')

   mix.browserSync({
      proxy:'reservaciones-dev.com'
   });
   
      mix.scripts([
      'resources/js/main.js'],
      'public/js/all.js');
      mix.scripts([
      'resources/js/admin.js'],
      'public/js/admin.js');
      mix.scripts([
      'resources/js/reservations.js'],
      'public/js/reservations.js');
      mix.scripts([
      'resources/js/hamburgerMenu.js'],
      'public/js/hamburgerMenu.js');
      mix.scripts([
      'resources/js/tipounidad.js'],
      'public/js/tipounidad.js');
      mix.scripts([
      'resources/js/equiposyunidades.js'],
      'public/js/equiposyunidades.js');
      mix.scripts([
      'resources/js/tipoactividades.js'],
      'public/js/tipoactividades.js');
      mix.scripts([
      'resources/js/activities.js'],
      'public/js/activities.js');
      mix.scripts([
      'resources/js/test.js'],
         'public/js/test.js');