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

 mix.styles(['node_modules/fullcalendar/dist/fullcalendar.css', 'node_modules/bootstrap-daterangepicker/daterangepicker.css'], 'public/admin/css/vendor.css')
	.scripts([
		'node_modules/bootstrap-daterangepicker/moment.min.js',
		'node_modules/fullcalendar/dist/fullcalendar.js',
		'node_modules/bootstrap-daterangepicker/daterangepicker.js'
  ], 'public/admin/js/vendor.js');


// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
