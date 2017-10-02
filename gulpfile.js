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
            'node_modules/html5shiv/dist/html5shiv.js',
            'node_modules/respond.js/dest/respond.matchmedia.addListener.src.js',
            'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
            'node_modules/autosize/dist/autosize.js',
            'node_modules/fingerprintjs2/dist/fingerprint2.min.js',
            'resources/assets/js/prism.custom.js',
            'resources/assets/js/main.js'
        ],
        admin: [
            'resources/assets/js/admin.js'
        ],
        gameoflife: [
            'resources/assets/js/gameoflife.js'
        ],
        prism: [
            // default
            'node_modules/prismjs/components/prism-core.js',
            'node_modules/prismjs/components/prism-markup.js',
            'node_modules/prismjs/components/prism-css.js',
            'node_modules/prismjs/components/prism-css-extras.js',
            'node_modules/prismjs/components/prism-clike.js',
            'node_modules/prismjs/components/prism-javascript.js',
            // custom
            'node_modules/prismjs/components/prism-bash.js',
            'node_modules/prismjs/components/prism-git.js',
            'node_modules/prismjs/components/prism-json.js',
            'node_modules/prismjs/components/prism-markdown.js',
            'node_modules/prismjs/components/prism-php.js',
            'node_modules/prismjs/components/prism-php-extras.js',
            'node_modules/prismjs/components/prism-scss.js',
            'node_modules/prismjs/components/prism-sql.js',
            'node_modules/prismjs/components/prism-yaml.js',
            // plugins
            'node_modules/prismjs/plugins/autolinker/prism-autolinker.js',
            'node_modules/prismjs/plugins/line-numbers/prism-line-numbers.js'
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
    critical.generate({
        base: 'public_html/',
        src: 'http://barryvanveen.app',
        css: config.outputDirs.css+'/screen.css',
        width: 1280,
        height: 600,
        dest: 'critical.css',
        minify: true
    }).then(function() {
        gulp.src('public_html/critical.css')
            .pipe(gulp.dest(config.outputDirs.css));

        gulp.src('public_html/critical.css', {read: false})
         .pipe(clean());
    });
});

gulp.task('clean', function() {
    gulp.src('public_html/tmp-*.html', {read: false})
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
        .pipe(concat('prism.custom.js'))
        .pipe(gulp.dest('resources/assets/js'));

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
    gulp.src('node_modules/bootstrap-sass/assets/fonts/bootstrap/*')
        .pipe(gulp.dest(config.outputDirs.fonts));

    gulp.src('node_modules/prismjs/themes/prism-okaidia.css')
        .pipe(rename("prism-okaidia.scss"))
        .pipe(gulp.dest('resources/assets/scss/vendor'));

    gulp.src('node_modules/gameoflife-es6/dist/gameoflife.min.js')
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