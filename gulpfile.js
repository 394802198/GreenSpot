var gulp = require('gulp');

// HTML Plugins
var minifyHTML = require('gulp-minify-html');

// JS Plugins
var uglify = require('gulp-uglify');
var jshint = require('gulp-jshint');
var stylish = require('jshint-stylish');
var concat = require('gulp-concat');

// Image Plugins
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');

// CSS Plugins
var prefix = require('gulp-autoprefixer');
var minifyCSS = require('gulp-minify-css');
var concatCSS = require('gulp-concat-css');

// Reload
var browserSync = require('browser-sync');

var opts = {
    empty: true, conditionals: true, spare:true
};
// modifies html
gulp.task('index', function () {
    gulp.src('origin/index.html')
        .pipe(minifyHTML(opts))
        .pipe(gulp.dest('app/'));
});
// modifies pages
gulp.task('pages', function () {
    gulp.src('origin/pages/**/*.html')
        .pipe(minifyHTML(opts))
        .pipe(gulp.dest('app/pages/'));

    gulp.src('origin/pages/**/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter(stylish))
        .pipe(jshint.reporter('fail'))
        .on('error', function () {
            this.emit('end');
        })
        .pipe(uglify())
        .pipe(gulp.dest('app/pages/'));
});

// modifies vendor styles
gulp.task('styles:vendor', function () {
    gulp.src('origin/css/vendor/**/*.css')
        .on('error', function () {
            this.emit('end');
        })
        .pipe(concatCSS('styles-vendor.min.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('origin/css/'))
        .pipe(gulp.dest('app/css/'));

    gulp.src('origin/css/vendor/**/*.png')
        .on('error', function () {
            this.emit('end');
        })
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('origin/css'))
        .pipe(gulp.dest('app/css'));
});
// modifies custom styles
gulp.task('styles:custom', function () {
    gulp.src('origin/css/custom/**/*.css')
        .on('error', function () {
            this.emit('end');
        })
        .pipe(concatCSS('styles-custom.min.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('origin/css/'))
        .pipe(gulp.dest('app/css/'));
});

// modifies vendor scripts
gulp.task('scripts:vendor', function () {
    gulp.src([
            'origin/js/vendor/jquery.js',
            'origin/js/vendor/bootstrap.min.js',
            'origin/js/vendor/angular.js',
            'origin/js/vendor/**/*.js'
        ])
        .pipe(concat('scripts-vendor.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('origin/js/'))
        .pipe(gulp.dest('app/js/'));
});
// modifies custom scripts
gulp.task('scripts:custom', function () {
    gulp.src([
            'origin/js/custom/app.module.js',
            'origin/js/custom/**/*.module.js',
            'origin/js/custom/**/*.js'
        ])
        .pipe(jshint())
        .pipe(jshint.reporter(stylish))
        .pipe(jshint.reporter('fail'))
        .on('error', function () {
            this.emit('end');
        })
        .pipe(uglify())
        .pipe(concat('scripts-custom.min.js'))
        .pipe(gulp.dest('origin/js/'))
        .pipe(gulp.dest('app/js/'));
});

// optimizes images
gulp.task('image', function () {
    return gulp.src('origin/img/**/*.*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('app/img/'));
});

// watches files
gulp.task('watch-vendor', function () {

    // Serve files from the root of this project
    browserSync.init(['./app/**.*'], {
        server: {
            baseDir: "./app"
        }
    });

    gulp.watch(['origin/pages/**/*.*', 'origin/index.html'], ['pages', 'index']);
    //gulp.watch(['origin/index.html'], ['index']);
    //gulp.watch('origin/pages/*.html', ['pages']);

    gulp.watch(['origin/css/vendor/**/*.css'], ['styles:vendor']);
//    gulp.watch(['origin/css/custom/**/*.css'], ['styles:custom', 'pages', 'index']);

    gulp.watch(['origin/js/vendor/**/*.js'], ['scripts:vendor']);
//    gulp.watch(['origin/js/custom/**/*.js'], ['scripts:custom', 'pages', 'index']);

    gulp.watch(['origin/img/**/*.*'], ['image', 'pages', 'index']);
});

// watches files
gulp.task('watch-custom', function () {

    // Serve files from the root of this project
    browserSync.init(['./app/**.*'], {
        //server: {
        //    baseDir: "./app"
        //},
        proxy: 'localhost'
    });

    gulp.watch(['origin/pages/**/*.*', 'origin/index.html'], ['pages', 'index']);
    //gulp.watch(['origin/index.html'], ['index']);
    //gulp.watch('origin/pages/*.html', ['pages']);

    //gulp.watch(['origin/css/vendor/**/*.css', 'origin/css/custom/**/*.css'], ['styles:vendor', 'styles:custom']);
    gulp.watch(['origin/css/custom/**/*.css'], ['styles:custom', 'pages', 'index']);

    //gulp.watch(['origin/js/vendor/**/*.js', 'origin/js/custom/**/*.js'], ['scripts:vendor', 'scripts:custom']);
    gulp.watch(['origin/js/custom/**/*.js'], ['scripts:custom', 'pages', 'index']);

    //gulp.watch(['origin/img/**/*.*'], ['image', 'pages', 'index']);
});