var elixir      = require('laravel-elixir');

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
var gulp        = require('gulp');
var plugins = {
    scripts : [
        'components/jquery/jquery.js',
        'components/jquery-ui/jquery-ui.min.js',
        'twitter/bootstrap/dist/js/bootstrap.js',
    ],
    styles : [
        'components/jquery-ui/jquery-ui.min.css',
        'twitter/bootstrap/dist/css/bootstrap.min.css',
        'fortawesome/font-awesome/css/font-awesome.min.css',
    ]
};
gulp.task('default', function() {
});
gulp.task('watch', function() {
    elixir(function(mix) {
        mix
            .styles(plugins.styles,"public/app.min.css","vendor")
            .scripts(plugins.scripts,"public/app.min.js","vendor")
            .less('../../../public/less/login.less', 'public/css/login.css');
    });
});