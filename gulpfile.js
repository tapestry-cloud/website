//
// Based upon http://stackoverflow.com/questions/26580683/caching-image-optimization-tasks-in-gulp
//

var gulp         = require('gulp'),
    gutil        = require('gulp-util'),
    chalk        = require('chalk'),
    yargs        = require('yargs'),               // https://www.npmjs.com/package/yargs
    exec         = require('child_process').exec,  // https://www.npmjs.com/package/gulp-exec
    imagemin     = require('gulp-imagemin'),       // https://github.com/sindresorhus/gulp-imagemin
    plumber      = require('gulp-plumber'),        // https://www.npmjs.com/package/gulp-plumber
    notify       = require("gulp-notify"),         // https://www.npmjs.com/package/gulp-notify
    size         = require('gulp-size'),           // https://github.com/sindresorhus/gulp-size
    less         = require('gulp-less'),           // https://www.npmjs.com/package/gulp-less
    sourcemaps   = require('gulp-sourcemaps'),     // https://www.npmjs.com/package/gulp-sourcemaps
    autoprefixer = require('gulp-autoprefixer'),   // https://www.npmjs.com/package/gulp-autoprefixer
    cleanCSS     = require('gulp-clean-css'),      // https://github.com/scniro/gulp-clean-css
    rename       = require("gulp-rename"),         // https://www.npmjs.com/package/gulp-rename
    browserSync  = require('browser-sync'),        // https://www.npmjs.com/package/browser-sync
    browserify   = require('browserify'),          // https://github.com/gulpjs/gulp/blob/master/docs/recipes/browserify-uglify-sourcemap.md
    babelify     = require('babelify'),
    reactify     = require('reactify'),
    uglify       = require('gulp-uglify'),         // https://www.npmjs.com/package/gulp-uglify
    source       = require('vinyl-source-stream'),
    buffer       = require('vinyl-buffer'),        // https://www.npmjs.com/package/vinyl-buffer
    rev          = require('gulp-rev'),            // https://www.npmjs.com/package/gulp-rev
    htmlmin      = require('gulp-htmlmin'),        // https://github.com/jonschlinkert/gulp-htmlmin
    runSequence  = require('run-sequence'),
    reload       = browserSync.reload;

var onError  = function(err) {
    gutil.beep();
    gutil.log(gutil.colors.green(err + '\n'));
};

var argv = yargs.alias('v', 'verbose')
    .alias('e', 'env')
    .alias('p', 'port')
    .argv;

var env = argv.env || 'local';
var port = argv.port || 3000;
var verbose = argv.verbose || false;

gutil.log('Environment', chalk.magenta(env));

gulp.task('tapestry', function (cb) {
    var cmd = 'tapestry build' + ((verbose) ? '' : ' --quiet --clear') +' --env=' + env;
    gutil.log('Executing:', chalk.magenta(cmd));
    exec(cmd, function (err, stdout, stderr) {
        if (verbose && stdout.length > 0){
            console.log(stdout);
        }
        if (stderr.length > 0) {
            console.log(stderr);
        }
        cb(err);
    });
});

gulp.task('javascript', function() {
    var bundler = browserify('./source/_assets/js/app.js', {
        // entry:         true,
        debug:         true,
        "transform": [["babelify", { "presets": ["es2015"] }]]
    });

    return bundler
        .bundle()
        .pipe(source('all.js'))
        .pipe(buffer())
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(uglify())
        .pipe(rev())
        .pipe(sourcemaps.write('./'))
        .pipe(size())
        .pipe(gulp.dest('./source/js/'))
        .pipe(rev.manifest({merge: true}))
        .pipe(gulp.dest('./'));
});

gulp.task('image-min', function () {
    return gulp.src('./source/_assets/img/**/*')
        .pipe(plumber({errorHandler: onError}))
        .pipe(imagemin([], {verbose: verbose}))
        .pipe(gulp.dest('./source/img'));
});

gulp.task('image-reload', ['image-min'], function () {
    return gulp.src('./source/img/')
        .pipe(plumber({errorHandler: onError}))
        .pipe(reload({stream: true}));
});

gulp.task('less', function() {
    return gulp.src('./source/_assets/less/main.less')
        .pipe(plumber({errorHandler: onError}))
        .pipe(less())
        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], {cascade: true}))
        .pipe(gulp.dest('./source/css'));
});

gulp.task('less-min', ['less'], function() {
    return gulp.src('./source/css/main.css')
        .pipe(plumber({errorHandler: onError}))
        .pipe(sourcemaps.init())
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(rev())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./source/css'))
        .pipe(rev.manifest({merge: true}))
        .pipe(gulp.dest('./'));
});

gulp.task('browser-sync', function() {
    browserSync({
        port: port,
        server: {baseDir: './build_' + env},
        files: ['build_' + env + '/**/*']
    });
});

gulp.task('watch', ['build', 'browser-sync'], function () {
    gulp.watch('./source/_assets/img/**/*', ['image-min']);
    gulp.watch('./source/_assets/js/**/*', ['javascript']);
    gulp.watch('./source/_assets/less/main.less', ['less-min']);
    gulp.watch(['./source/**/*', '!./source/_assets/**/*'], ['tapestry']);
});

gulp.task('html-min', function(){
    return gulp.src('./build_' + env + '/**/*.html')
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest('./build_' + env));
});

gulp.task('build', function(cb){
    runSequence('javascript', 'less-min', 'image-min', 'tapestry', 'html-min',cb);
});