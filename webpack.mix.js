const mix = require("laravel-mix");
require("dotenv").config();

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
	.js("resources/js/app", "public/js")

	.js("resources/js/pages/cards/import", "public/js/pages/cards/")

	.js("resources/js/pages/batches/show", "public/js/pages/batches/")

	.sass("resources/sass/app.scss", "public/css")
	.sourceMaps(true, "source-map")
	.browserSync({
		proxy: process.env.APP_URL,
		open: false
	});
