const gulp = require('gulp');
const sass = require('gulp-sass');
const browserSync = require('browser-sync');


// compiling SASS into CSS

function style() {
	// 1. Load the source sass file
	return gulp.src('./sass/**/*.scss', { sourcemaps: true })
	// 2. Pass the sass into gulp sass compiler
		.pipe(sass()).on('error', sass.logError)
		//.pipe(rename("mainstyle.css")) // optionally you can rename your compiled css file
	// 3. set the destination folder (use rename() to rename file if necessary)
		.pipe(gulp.dest('./css/', { sourcemaps: true }))
	// 4. use browser sync for page refreshment and reload etc
		.pipe(browserSync.stream());
}


function watch() {

	// setup browser sync server for auto refresh
	// browserSync.init({
	// 	server:{
	// 		baseDir: './'
	// 	}
	// });

	// watching for changes in sass file to auto compile
	gulp.watch('./sass/**/*.scss', style);
	// watch for changes in any html/js file then reload the browser
	// gulp.watch(['./*.html', './*.js']).on('change', browserSync.reload);

}


exports.style = style;
exports.watch = watch;
exports.default = watch;