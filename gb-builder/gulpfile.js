
// Paths
var themepath = '../wp-content/themes/gb-wp-boilerplate/';

// Dependencies
var gulp = require('gulp')

	// Sourcemaps
	, sourcemaps = require('gulp-sourcemaps')

	// CSS
	, postcss = require('gulp-postcss')
	, sass = require('gulp-sass')
	, sasslint = require('gulp-sass-lint')
	, autoprefixer = require('autoprefixer')
	, mqpacker = require('css-mqpacker')
	, cssnano = require('cssnano')

	// Javascript
	, uglify = require('gulp-uglify')
	, concat = require('gulp-concat')

	// Images
	, imagemin = require('gulp-imagemin')

	// Other
	, rename = require('gulp-rename')
	, notify = require('gulp-notify')

	// Plumber
	, plumber = require('gulp-plumber')

	// Live reload
	, livereload = require('gulp-livereload')
	;

// Assets
var paths = {
	assets: {
		styles: 'assets/styles/**/*.scss',
		js: {
			files: [
				// These files remain separate but are still minified and are output as *.min.js
			],
			concatfiles: [
				// These files get concatenated into one file.
				// 'assets/js/libs/jquery.fitvids.js',
				// 'assets/js/libs/jquery.bxslider.js',
				// 'assets/js/libs/retina.js',
				'assets/js/script.js',
			]
		},
		images: 'assets/images/**/*'
	},
	public: {
		styles: themepath+'css',
		js: themepath+'js',
		images: themepath+'images',
	}
}

// Styles task
gulp.task('styles', function() {
	var processors = [
		autoprefixer({
			browsers: ['last 5 versions']
		})
		, mqpacker({
			sort: true // Only sorts min-width media queries
		})
		, cssnano
	];
	gulp.src(paths.assets.styles)
		.pipe(plumber())
		.pipe(sourcemaps.init())
			.pipe(sass())
			.pipe(postcss(processors))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(paths.public.styles))
		.pipe(livereload())
		.pipe(notify({
			message: 'Style task complete!'
			, onLast: true
		}))
		;
});

// SASS Linter
gulp.task('sass-lint', function() {
	gulp.src(paths.assets.styles)
		.pipe(sasslint({
			configFile: './.sass-lint.yml'
			, files: {
				ignore: [
					'assets/styles/generic/_normalize.scss'
					, 'assets/styles/tools/libs/**/*'
				]
			}
		}))
		.pipe(sasslint.format())
		.pipe(sasslint.failOnError())
		;
});

// Javascript task
gulp.task('js', function() {
	gulp.src(paths.assets.js.files)
		.pipe(plumber())
		.pipe(sourcemaps.init())
			.pipe(uglify())
		.pipe(sourcemaps.write('.'))
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(gulp.dest(paths.public.js))
		.pipe(livereload())
		.pipe(notify({
			message: 'JS task complete!'
			, onLast: true
		}))
		;
});

// Javascript concat task
gulp.task('js-concat', function() {
	gulp.src(paths.assets.js.concatfiles)
		.pipe(plumber())
		.pipe(sourcemaps.init())
			.pipe(uglify())
			.pipe(concat('script.min.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(paths.public.js))
		.pipe(livereload())
		.pipe(notify({
			message: 'Concat JS task complete!'
			, onLast: true
		}))
		;
});

// Image task
gulp.task('images', function() {
	gulp.src(paths.assets.images)
		.pipe(plumber())
		.pipe(imagemin({
			optimizationLevel: 3
			, progressive: true
			, interlaced: true
		}))
		.pipe(gulp.dest(paths.public.images))
		;
});

// Watch task
gulp.task('watch', function() {
	livereload.listen();
	gulp.watch(paths.assets.styles, ['styles', 'sass-lint']);
	gulp.watch(paths.assets.js.files, ['js']);
	gulp.watch(paths.assets.js.concatfiles, ['js-concat']);
	gulp.watch(paths.assets.images, ['images']);
});

// Default task
gulp.task('default', function() {
	gulp.start(
		'styles'
		, 'sass-lint'
		, 'js'
		, 'js-concat'
		, 'images'
		, 'watch'
	);
});
