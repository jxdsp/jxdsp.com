const { series, parallel } = require('gulp')
const browserSync = require('browser-sync').create()

const { watch } = require('./watch')

const { paths } = require('./gulpfile.paths')

const browserSync_init = () => {
  browserSync.init({
    server: paths.wwwRoot,
  })
  watch()
}

exports.serve = series(browserSync_init)
exports.browserSyncReload = browserSync.reload
