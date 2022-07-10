import gulp from 'gulp';
import objectFitImages from 'postcss-object-fit-images';
import postCSS from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import { create } from 'browser-sync';
import minifyCSS from 'gulp-minify-css';
import autoprefixer from 'gulp-autoprefixer';
import rename from 'gulp-rename';
import sassGlob from 'gulp-sass-glob';
import sass from 'gulp-sass';
import plumber from 'gulp-plumber';
import gru2 from 'gulp-rollup-2';
import concat from 'gulp-concat';

const browsersync = create();

gulp.task('styles', (done) => {
	gulp.src('scss/style.scss')
		.pipe(sassGlob())
		.pipe(sourcemaps.init())
		.pipe(plumber(function(error) {
			// eslint-disable-next-line no-console
			console.log(error);
			this.emit('end');
		}))
		.pipe(sass())
		.pipe(postCSS([objectFitImages]))
		.pipe(autoprefixer({
			browsers: ['defaults', 'iOS >= 8'],
			grid: false,
		}))
		.pipe(minifyCSS())
		.pipe(rename('style.css'))
		.pipe(sourcemaps.write('/', ''))
		.pipe(gulp.dest('./'))
		.pipe(browsersync.stream());
	done();
});

gulp.task('scripts', function(done) {
	gulp.src('./js/**/*.js')
		.pipe(sourcemaps.init())
		.pipe(gru2.rollup({
			input: 'js/theme.js',
			external: ['window'],
			cache: true,
			output: [
				{
					file: 'theme.bundle.js',
					format: 'es',
					globals: { window: 'window' },
				},
			],
		}))
		.pipe(sourcemaps.write('/', ''))
		.pipe(gulp.dest('./js/dist'));
	done();
});

gulp.task('vendor', (done) => {
	gulp.src('js/vendor/[^_]*.js')
		.pipe(concat('vendor.js'))
		.pipe(gulp.dest('js/dist'))
		.pipe(browsersync.stream());
	done();
});
gulp.task('build', function() {
	browsersync.init({
		proxy: {
			target: 'https://doublee-dev-starter-kit.local/',
		},
		snippetOptions: {
			whitelist: ['/wp-admin/admin-ajax.php'],
			blacklist: ['/wp-admin/**'],
		},
	});

	gulp.watch('scss/**/*.scss', gulp.series('styles'));
	gulp.watch('js/[^_]*.js', gulp.series('scripts'));
	gulp.watch('js/vendor/[^_]*.js', gulp.series('vendor'));
	browsersync.reload();
});

gulp.task('default', gulp.parallel(gulp.series('build')));
