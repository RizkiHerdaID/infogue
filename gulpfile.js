var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('style.scss');

    mix.scripts([
        'library/jquery/dist/jquery.js',
        'main.js',
        'resize.js',
        'infinite.js'
    ]).scripts([
        'library/jquery/dist/jquery.js',
        'admin.js',
        'admin-resize.js',
        'admin-validate.js'
    ]);

    mix.browserSync();

});
