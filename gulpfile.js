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
    // font
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts/bootstrap');

    // styles
    mix.sass('app.scss');
    mix.sass('auth.scss');
    mix.copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 'public/css');
    mix.copy('node_modules/at.js/dist/css/jquery.atwho.min.css', 'public/css');
    mix.styles([
        "app.css",
        "bootstrap-datepicker.min.css",
        "jquery.atwho.min.css"
    ], 'public/css/base.css', 'public/css');
    mix.styles([
        "app.css",
        "bootstrap-datepicker.min.css"
    ], 'public/css/analytics.css', 'public/css');

    // scripts
    mix.browserify('app.js');
    mix.browserify('internal.project.js');
    mix.browserify('analytics.dashboard.js');
    mix.copy('node_modules/at.js/dist/js/jquery.atwho.js', 'public/js');
    mix.copy('node_modules/jquery.caret/dist/jquery.caret.min.js', 'public/js');
    mix.scripts([
        "jquery.caret.min.js",
        "jquery.atwho.js",
        "internal.project.js"
    ], 'public/js/internal.project.union.js', 'public/js');
});
