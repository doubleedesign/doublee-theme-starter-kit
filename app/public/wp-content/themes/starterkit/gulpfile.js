const gulp 				= require('gulp');
const plumber 			= require('gulp-plumber');
const sass 				= require('gulp-sass');
const sassGlob 			= require('gulp-sass-glob');
const rename 			= require('gulp-rename');
const autoprefixer 		= require('gulp-autoprefixer');
const minifyCSS       	= require('gulp-minify-css');
const uglify          	= require('gulp-uglify');
const concat          	= require('gulp-concat');
const browsersync     	= require('browser-sync').create();
const sourcemaps      	= require('gulp-sourcemaps');
const postCSS         	= require('gulp-postcss');
const objectFitImages 	= require('postcss-object-fit-images');


gulp.task('styles',  done =>  {
	gulp.src('scss/style.scss')
		.pipe(sassGlob())
		.pipe(sourcemaps.init())
		.pipe(plumber(function (error) {
			console.log(error);
			this.emit('end');
		}))
		.pipe(sass())
		.pipe(postCSS([objectFitImages]))
		.pipe(autoprefixer({
			browsers: ['defaults', 'iOS >= 8'],
			grid: false
		}))
		.pipe(minifyCSS())
		.pipe(rename('style.css'))
		.pipe(sourcemaps.write('/'))
		.pipe(gulp.dest('./'))
		.pipe(browsersync.stream())
	done();
});

gulp.task('scripts', done => {
	gulp.src('js/[^_]*.js')
		.pipe(concat('theme.js'))
		.pipe(rename({suffix: '.min'}))
		.pipe(uglify().on('error', function(error){
			console.log(error);
			this.emit('end');
		}))
		.pipe(gulp.dest('js/dist'))
		.pipe(browsersync.stream())
	done();
});

gulp.task('vendor', done => {
	gulp.src('js/vendor/[^_]*.js')
		.pipe(concat('vendor.js'))
		.pipe(rename({suffix: '.min'}))
		.pipe(uglify().on('error', function(error){
			console.log(error);
			this.emit('end');
		}))
		.pipe(gulp.dest('js/dist'))
		.pipe(browsersync.stream())
	done();
});

gulp.task('build', function() {
	browsersync.init({
		proxy: {
			target: 'https://http://doublee-dev-starter-kit.local/'
		},
		snippetOptions: {
			whitelist: ['/wp-admin/admin-ajax.php'],
			blacklist: ['/wp-admin/**']
		}
	});

	gulp.watch('scss/**/*.scss', gulp.series('styles'));
	gulp.watch('js/[^_]*.js', gulp.series('scripts'));
	gulp.watch('js/vendor/[^_]*.js', gulp.series('vendor'));
	browsersync.reload();
});

gulp.task('default', gulp.parallel(gulp.series('build')));