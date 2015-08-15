var gulp = require('gulp');

var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var include = require('gulp-include');
var plumber = require('gulp-plumber');
var rename = require("gulp-rename");
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');

var config = {
    scripts: {
        src: [
            'bower_components/jquery/dist/jquery.js',
            'bower_components/moment/moment.js',
            'bower_components/moment/locale/nl.js',
            'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.js',
            'bower_components/scrollup/dist/jquery.scrollUp.js',
            'bower_components/autosize/dest/autosize.js',
            'bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            'bower_components/ajaxq/ajaxq.js',
            'bower_components/prism/prism.custom.min.js',
            'resources/assets/js/main.js'
        ],
        ie8: [
            'bower_components/html5shiv/dist/html5shiv.js',
            'bower_components/respond/dest/respond.matchmedia.addListener.src.js'
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
        .pipe(sass({
            unixNewlines: true,
            style: 'expanded'
        }))
        .pipe(include())
        .pipe(autoprefixer('last 5 versions'))
        /*.pipe(cmq({
         log: true
         }))*/
        .pipe(gulp.dest('public_html/css'));

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

    gulp.src(config.scripts.ie8)
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(uglify())
        .pipe(concat('main.ie8.min.js'))
        .pipe(gulp.dest('public_html/js'));

    gulp.src(config.scripts.src)
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(uglify())
        .pipe(concat('main.min.js'))
        .pipe(gulp.dest('public_html/js'));
});

/**
 * move some files around
 */
gulp.task('move', function () {
    // move Icomoon font files to public_html
    gulp.src('resources/assets/fonts/icomoon/fonts/*')
        .pipe(gulp.dest('public_html/fonts'));

    // move bootstrap font files to public_html
    gulp.src('bower_components/bootstrap-sass-official/assets/fonts/bootstrap/*')
        .pipe(gulp.dest('public_html/fonts'));

    gulp.src('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')
        .pipe(rename("bootstrap-datetimepicker.scss"))
        .pipe(gulp.dest('resources/assets/scss/bower_components'));

    gulp.src('bower_components/prism/themes/prism-okaidia.css')
        .pipe(rename("prism-okaidia.scss"))
        .pipe(gulp.dest('resources/assets/scss/bower_components'));
});

/**
 * watch for changes in scss-files, then build-sass
 */
gulp.task('watch-sass', function(){
    gulp.watch('resources/assets/scss/**/*.scss', ['build-sass']);
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
gulp.task('default', ['move', 'build-sass', 'build-js', 'watch-sass', 'watch-js']);