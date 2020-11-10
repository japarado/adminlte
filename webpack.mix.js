const mix = require('laravel-mix');
require('dotenv').config();

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

mix
	.js('resources/js/app.js', 'public/js')
	.sass('resources/sass/app.scss', 'public/css')
	.js('resources/js/pages/cards/merge', 'public/js/pages/cards')
	.sourceMaps(true, "source-map")
	.browserSync({
		proxy: process.env.APP_URL,
		open: false
	});
