var gulp = require('gulp');
var sass = require('gulp-sass');
sass.compiler = require('node-sass');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');

// Compiles, autoprefixes & minifies the sass files
gulp.task('sass', function () {
  return gulp
    .src(['./web/sass/*.scss'])
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(autoprefixer())
    .pipe(cleanCSS({level: 2}))
    .pipe(gulp.dest('./web/css'));
});

// Watches files and auto-refreshes when changes are saved
gulp.task('watch', async function () {
  gulp.watch(['./web/sass/**/*.scss'], gulp.series('sass'));
});

gulp.task('dev', gulp.series('sass', 'watch'));