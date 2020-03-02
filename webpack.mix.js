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
const outputDefault = (addpath = '') => 'public/js' + addpath;
mix
    .js('resources/assets/js/app.js', outputDefault())
    .js('resources/assets/js/events/event-component.js', outputDefault('/events'))
