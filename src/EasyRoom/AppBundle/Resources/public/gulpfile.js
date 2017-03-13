'use strict';

var gulp = require('gulp');
//var path = require('path');
//var ignore = require('gulp-ignore');
var sass = require('gulp-sass');
//var rimraf = require('gulp-rimraf');
var plumber = require('gulp-plumber');
//var concat = require('gulp-concat');
//var minifyCss = require('gulp-clean-css');
//var runSequence = require('run-sequence');
//var useref = require('gulp-useref');
//var gulpIf = require('gulp-if');
//var uglify = require('gulp-uglify');
//var imageMin = require('gulp-imagemin');
//var autoprefixer = require('gulp-autoprefixer');

//CONFIG PATHS
var config = {
    build: 'build/',
    jsp_folder: 'WEB-INF/jsp/'
};

var paths = {
    css_folder : 'dist/css/',
    sass_files: 'sass/**/*.scss',
    image_files : 'images/**/*.+(png|jpg|gif|svg)',
    font_files: 'fonts/**/*'

};

// TASKS

// ------------- Default ---------------
gulp.task('default', ['watch']);

// ------------- Watch ---------------
gulp.task('watch',['compile:sass'], function() {
    gulp.watch([paths.sass_files], ['compile:sass']);
});

// ------------- Build ---------------
/*gulp.task('build', function (callback) {
    runSequence('compile:less', 'useref', 'optimize:images', 'copy:assets', 'clean:css_temp', function(){
            callback();
        }
    )
})*/


// ------------- Less compilation ---------------
gulp.task('compile:sass', function () {
    return gulp.src([paths.sass_files])
        .pipe(plumber())
        .pipe(sass({
            paths: ['sass/']
        }))
       /* .pipe(autoprefixer({
            browsers: ['last 2 versions', '> 5%']
        }))*/
        .pipe(gulp.dest(paths.css_folder));
});

// ------------- Useref ---------------
/*gulp.task('useref', function(){
    return gulp.src(paths.jsp_file)
        .pipe(useref())
        .pipe(gulpIf('*.css', minifyCss()))
        .pipe(gulpIf('*.js', uglify()))
        .pipe(gulp.dest(config.jsp_folder))
});*/

// ------------- Delete css files ---------------
/*gulp.task('clean:css_temp', function(){
    return gulp.src(paths.css_folder, { read: false }) // much faster
        .pipe(plumber())
        //.pipe(ignore('bootstrap.min.css'))
        .pipe(rimraf());
});*/



