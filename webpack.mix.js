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

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/plantilla/css/nucleo-icons.css',
    'resources/plantilla/css/theme.css'
], 'public/css/plantilla.css')
.scripts([
    'resources/plantilla/js/core/bootstrap.min.js',
    'resources/plantilla/js/core/jquery.min.js',
    'resources/plantilla/js/core/popper.min.js',
    'resources/plantilla/js/plugins/bootstrap-notify.js',
    'resources/plantilla/js/plugins/chartjs.min.js',
    'resources/plantilla/js/plugins/perfect-scrollbar.jquery.min.js',
    'resources/plantilla/js/pace.min.js',
    'resources/plantilla/js/sweetalert2.all.js',
    'resources/plantilla/js/template.js',
    'resources/plantilla/js/theme.js'
], 'public/js/plantilla.js')
.js(['resources/js/app.js'],'public/js/app.js')
.vue();