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
mix.js("resources/js/dashboard/app.js", "public/js/d")
    .js("resources/js/dashboard/modernizr.min.js", "public/js/d")
    .js("resources/js/dashboard/jquery.app.js", "public/js/d")
    .js("resources/js/dashboard/jquery.slimscroll.js", "public/js/d")
    .sass("resources/sass/dashboard/app.scss", "public/css/d");

mix.styles(
    [
        "resources/css/dashboard/bootstrap.min.css",
        "resources/css/dashboard/style.css",
        "resources/css/dashboard/print.css",
        "resources/css/dashboard/icons.css"
    ],
    "public/css/d/schedule.css"
);

mix.styles(
    [
        "resources/css/dashboard/dataTables.bootstrap4.min.css",
        "resources/css/dashboard/buttons.bootstrap4.min.css",
        "resources/css/dashboard/responsive.bootstrap4.min.css"
    ],
    "public/css/d/datatable.min.css"
);

mix.scripts(
    [
        "resources/js/dashboard/jquery.dataTables.min.js",
        "resources/js/dashboard/dataTables.bootstrap4.min.js",
        "resources/js/dashboard/dataTables.buttons.min.js",
        "resources/js/dashboard/buttons.bootstrap4.min.js",
    ],
    "public/js/d/datatable.min.js"
);

mix.copy(
    "resources/css/dashboard/plugins/jquery.steps.css",
    "public/css/d/plugins"
);
mix.copy(
    "resources/css/dashboard/plugins/magnific-popup.css",
    "public/css/d/plugins"
);

mix.copy("resources/fonts/*", "public/fonts");

mix.version();