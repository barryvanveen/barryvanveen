
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
            'bower_components/markdown-js/lib/markdown.js',
            'bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
			'resources/assets/js/main.js'
		],
		ie8: [
			'bower_components/html5shiv/dist/html5shiv.js',
			'bower_components/respond/dest/respond.matchmedia.addListener.src.js'
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
	gulp.src(config.scripts.src)
        .pipe(plumber({
            errorHandler: onError
        }))
		.pipe(uglify())
		.pipe(concat('main.min.js'))
		.pipe(gulp.dest('public_html/js'));

	gulp.src(config.scripts.ie8)
        .pipe(plumber({
            errorHandler: onError
        }))
		.pipe(uglify())
		.pipe(concat('main.ie8.min.js'))
		.pipe(gulp.dest('public_html/js'));
});

/**
 * move some files around
 */
gulp.task('move', function () {
    // move favicon files to public_html
	gulp.src('resources/assets/fonts/icomoon/fonts/*')
		.pipe(gulp.dest('public_html/fonts'));

    gulp.src('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')
        .pipe(rename("bootstrap-datetimepicker.scss"))
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
gulp.task('default', ['build-sass', 'build-js', 'watch-sass', 'watch-js']);