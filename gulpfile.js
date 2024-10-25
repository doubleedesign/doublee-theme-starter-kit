import { readFile, writeFile } from 'fs';
import path from 'path';
import gulp from 'gulp';
import sassGlob from 'gulp-sass-glob';
import jsonToScss from '@valtech-commerce/json-to-scss';
import sass from 'gulp-dart-sass';
import sourcemaps from 'gulp-sourcemaps';
import header from 'gulp-header';
import { rollup } from 'gulp-rollup-2';
import multiEntry from '@rollup/plugin-multi-entry';
import postcss from "gulp-postcss";
import discardComments from "postcss-discard-comments";


// Generate SCSS variables from theme-vars.json file
function variables(done) {
	readFile(`./theme-vars.json`, 'utf8', async (error, theme) => {
		if (error) {
			console.log(error);
			done();
		} else {
			const scss = jsonToScss.convert(`${theme}`);
			if (scss) {
				await writeFile('common/scss/_variables.scss', scss, '', () => {
					console.log('theme-vars.json converted to SCSS variables');
					done();
				});
			} else {
				console.log('Problem with converting theme-vars.json to SCSS variables');
				done();
			}
		}
	});
}

// Compile core shared styles into a file for Storybook
function common() {
	return gulp.src('common/scss/styles-common.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
		.pipe(postcss([discardComments({ removeAll: true })]))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./'));
}

// Bundle up component + module styles to be served on the front-end
function theme() {
	return gulp.src('common/scss/style.scss')
		.pipe(sourcemaps.init())
		.pipe(sassGlob())
		.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
		.pipe(postcss([discardComments({ removeAll: true })]))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./'));
}

// Compile individual component styles for use in Storybook
function components() {
	return gulp.src('components/**/*.scss', { base: 'components' })
		// .on('data', function(file) {
		// 	console.log('Found file:', path.relative('modules', file.path));
		// })
		.pipe(sourcemaps.init())
		.pipe(header('@import "../common";')) // Prepend core SCSS imports to each file
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(file => {
			const relativePath = path.relative('components', file.base);
			return path.join('components', relativePath);
		}))
}

// Compile individual ACF module styles to be used in the back-end previews and in Storybook
function acf_module_styles() {
	return gulp.src('modules/**/*.scss', { base: 'modules' })
		// .on('data', function(file) {
		// 	console.log('Found file:', path.relative('modules', file.path));
		// })
		.pipe(sourcemaps.init())
		.pipe(header('@import "../common";')) // Prepend core SCSS to each file
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(file => {
			const relativePath = path.relative('modules', file.base);
			return path.join('modules', relativePath);
		}))
}

// Bundle ACF module scripts to be served on the front-end
function acf_module_scripts() {
	return gulp.src(['modules/**/*.js', '!modules/modules.bundle.js'], { base: 'modules' })
		.pipe(sourcemaps.init())
		.pipe(
			rollup({
				plugins: [multiEntry()],
				external: ['window'],
				input: 'modules/**/*.js',
				output: {
					file: 'modules.bundle.js',
					format: 'es',
					globals: { window: 'window' },
				},
			})
		)
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('modules'));
}

// Compile subset of core shared styles to also be loaded in the editor
function editor() {
	return gulp.src('common/scss/styles-editor.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./'));
}

// Compile admin CSS customisations
function admin() {
	return gulp.src('common/scss/styles-admin.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./'));
}


function watchFiles() {
	const options = { events: ['change', 'add', 'unlink'], ignoreInitial: false};

	// Recompile everything if the theme variables change
	gulp.watch('theme-vars.json', options, gulp.series(variables, components, acf_module_styles, theme, editor, admin));

	// Compile the whole-theme stylesheets and editor styles when anything other than _variables.scss changes
	gulp.watch(['common/scss/**/*.scss', 'components/**/*.scss', 'modules/**/*/scss', '!**/_variables.scss'], options, gulp.parallel(theme, editor));

	// General UI components
	gulp.watch('components/**/*.scss', options, components);

	// Flexible content modules SCSS
	gulp.watch('modules/**/*.scss', options, acf_module_styles);

	// Watch JavaScript files, excluding the output bundle
	gulp.watch(['modules/**/*.js', '!modules/**/*.bundle.js'], options, acf_module_scripts);

	// Admin and editor styles
	gulp.watch('common/scss/styles-admin.scss', options, gulp.parallel(admin));
	gulp.watch('common/scss/styles-editor.scss', options, gulp.parallel(editor));
}

function modules(cb) {
	return gulp.parallel(acf_module_styles, acf_module_scripts)(cb);
}

export {
	variables,
	common,
	theme,
	components,
	modules,
	editor,
	admin
};

export default watchFiles;
