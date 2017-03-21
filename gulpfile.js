var gulp = require('gulp');
var elixir = require('laravel-elixir');
var argv = require('yargs').argv;

require('laravel-elixir-imagemin');

elixir.config.assetsPath = 'source/_assets';
elixir.config.publicPath = 'source';
elixir.config.images = {
    folder: 'img',
    outputFolder: 'img'
};

elixir(function (mix) {
    var env = argv.e || argv.env || 'local';
    var port = argv.p || argv.port || 3000;

    mix.less('main.less')
        .imagemin()
        .browserify('app.js')
        .exec('tapestry build --quiet --env=' + env, ['./source/*', './source/**/*', '!./source/_assets/**/*'])
        .browserSync({
            port: port,
            server: {baseDir: 'build_' + env},
            proxy: null,
            files: ['build_' + env + '/**/*']
        });
});