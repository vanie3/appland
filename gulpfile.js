var gulp = require('gulp'),
    watch = require('gulp-watch'),
    less = require('gulp-less'),
    plumber = require('gulp-plumber'),
    notify = require('gulp-notify'),
    livereload = require('gulp-livereload'),
    autoprefixer = require('gulp-autoprefixer'),
    lessSource = './wp-content/themes/appland/static/less/appland.less',
    allLessSource = './wp-content/themes/appland/static/less/*.less';

 
gulp.task('less', function () {
  gulp.src(lessSource)
    .pipe(plumber())
    .pipe(less())
    .pipe(autoprefixer({
        browsers: ['last 10 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('./wp-content/themes/appland/static/css'))
    .pipe(notify('you just got gulped, son!'));

  
});

gulp.task('watch', function () {
    gulp.watch(allLessSource, function (event) {
        return gulp.src(event.path)
            .pipe(livereload());
    });
    livereload.listen()
  
    gulp.watch(allLessSource, ['less']);      
});

gulp.task('default', ['less', 'watch']);
