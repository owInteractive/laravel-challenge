let mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
let purgeCss = require('purgecss-webpack-plugin');
let glob = require('glob-all');

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

mix.postCss('resources/assets/css/tailwind.css', 'public/css', [tailwindcss])
    .js('resources/assets/js/app.js', 'public/js');

if (mix.inProduction()) {
    mix.webpackConfig({
        plugins: [
            new purgeCss({
                paths: glob.sync([
                    path.join(__dirname, 'resources/views/**/*.blade.php'),
                    path.join(__dirname, 'resources/assets/js/**/*.vue')
                ]),
                extractors: [
                    {
                        extractor: class {
                            static extract(content) {
                                return content.match(/[A-z0-9-:\/]+/g)
                            }
                        },
                        extensions: ['html', 'js', 'php', 'vue']
                    }
                ]
            })
        ]
    })
}
