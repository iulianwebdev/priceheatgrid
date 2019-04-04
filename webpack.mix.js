let mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
const url = 'househeat.test'
mix.browserSync({
  host: url,
  proxy: url,
  notify: false,
  files: [
    './resources/assets/js/*.js',
    './resources/assets/js/**/*.js',
    './resources/assets/css/*.css',
    './resources/assets/scss/*.scss',
    './resources/views/*.blade.php'
  ]
})

mix.js('resources/assets/js/main.js', 'dist/app.js')
mix.sass('resources/assets/scss/main.scss', 'dist/app.css')
mix.sourceMaps()
