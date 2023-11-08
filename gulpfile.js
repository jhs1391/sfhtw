var gulp = require('gulp');
var browserSync = require('browser-sync').create();

// Initialize browser-sync
function serve(done) {
    browserSync.init({
        proxy: "sfhtw.local",
        injectChanges: false, 
        notify: false, 
    });
    
    done();
}

// Watch for changes and reload browser-sync
function watchFiles() {
    gulp.watch('**/*.php').on('change', browserSync.reload);
    gulp.watch('**/*.css').on('change', browserSync.reload);
    gulp.watch('**/*.html').on('change', browserSync.reload);
    gulp.watch('**/*.js').on('change', browserSync.reload);
}

// Export tasks
exports.default = gulp.series(serve, watchFiles);
