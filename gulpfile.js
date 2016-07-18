var gulp = require('gulp');

var autoprefixer = require('gulp-autoprefixer');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
var cssnano = require('gulp-cssnano');
var critical = require('critical');
var plumber = require('gulp-plumber');
var rename = require("gulp-rename");
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');

var config = {
    scripts: {
        lazyload: [
            'resources/assets/js/lazyload.js'
        ],
        main: [
            'bower_components/html5shiv/dist/html5shiv.js',
            'bower_components/respond/dest/respond.matchmedia.addListener.src.js',
            'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.js',
            'bower_components/scrollup/dist/jquery.scrollUp.js',
            'bower_components/prism/prism.custom.min.js',
            'resources/assets/js/main.js'
        ],
        admin: [
            'bower_components/autosize/dist/autosize.js',
            'bower_components/ajaxq/ajaxq.js',
            'resources/assets/js/admin.js'
        ],
        gameoflife: [
            'resources/assets/js/gameoflife.js'
        ],
        prism: [
            // default
            'bower_components/prism/components/prism-core.js',
            'bower_components/prism/components/prism-markup.js',
            'bower_components/prism/components/prism-css.js',
            'bower_components/prism/components/prism-css-extras.js',
            'bower_components/prism/components/prism-clike.js',
            'bower_components/prism/components/prism-javascript.js',
            // custom
            'bower_components/prism/components/prism-bash.js',
            'bower_components/prism/components/prism-git.js',
            'bower_components/prism/components/prism-markdown.js',
            'bower_components/prism/components/prism-php.js',
            'bower_components/prism/components/prism-php-extras.js',
            'bower_components/prism/components/prism-scss.js',
            'bower_components/prism/components/prism-sql.js',
            // plugins
            'bower_components/prism/plugins/autolinker/prism-autolinker.js',
            'bower_components/prism/plugins/line-numbers/prism-line-numbers.js'
        ]
    },
    outputDirs: {
        base:   'public_html/dist',
        css:    'public_html/dist/css',
        fonts:  'public_html/dist/fonts',
        js:     'public_html/dist/js'
    }
};

var onError = function (err) {
    console.log(err);
};

/**
 * build all sass files into css files
 */
gulp.task('build-sass', function () {
    gulp.src('resources/assets/scss/*.scss')
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            unixNewlines: true
        }))
        .pipe(autoprefixer('> 5%'))
        .pipe(cssnano())
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest(config.outputDirs.css));
});

gulp.task('critical', function() {
    // todo: critical fixen
    critical.generate({
        src: 'http://barryvanveen.app',
        css: config.outputDirs.css+'/screen.css',
        width: 1280,
        height: 600,
        dest: 'public_html/dist/css/critical.css',
        minify: true
    });
});

gulp.task('clean', function() {
    gulp.src('tmp-*.html', {read: false})
        .pipe(clean());
});

/**
 * concatenate all js files
 */
gulp.task('build-js', function () {
    gulp.src(config.scripts.prism)
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(uglify())
        .pipe(concat('prism.custom.min.js'))
        .pipe(gulp.dest('bower_components/prism'));

    gulp.src(config.scripts.main)
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(concat('main.js'))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest(config.outputDirs.js));

    gulp.src(config.scripts.admin)
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(concat('admin.js'))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest(config.outputDirs.js));

    gulp.src(config.scripts.gameoflife)
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(concat('gameoflife.js'))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest(config.outputDirs.js));
});

/**
 * move some files around
 */
gulp.task('move', function () {
    // move Icomoon font files to public_html
    gulp.src('resources/assets/fonts/icomoon/fonts/*')
        .pipe(gulp.dest(config.outputDirs.fonts));

    // move bootstrap font files to public_html
    gulp.src('bower_components/bootstrap-sass-official/assets/fonts/bootstrap/*')
        .pipe(gulp.dest(config.outputDirs.fonts));

    gulp.src('bower_components/prism/themes/prism-okaidia.css')
        .pipe(rename("prism-okaidia.scss"))
        .pipe(gulp.dest('resources/assets/scss/bower_components'));

    gulp.src('bower_components/gameoflife/dist/gameoflife.min.js')
        .pipe(rename("gameoflife.js"))
        .pipe(gulp.dest('resources/assets/js'));
});

/**
 * watch for changes in scss-files, then build-sass
 */
gulp.task('watch-sass', function(){
    gulp.watch('resources/assets/scss/**/*.scss', ['build-sass', 'critical']);
});

/**
 * watch for changes in js-files, then build-js
 */
gulp.task('watch-js', function(){
    gulp.watch('resources/assets/**/*.js', ['build-js']);
});

/**
 * perform these tasks when running just 'gulp'
 */
gulp.task('default', ['clean', 'build-sass', 'build-js', 'critical', 'watch-sass', 'watch-js']);