const { src, dest, lastRun, parallel } = require('gulp')
const notify = require('gulp-notify')
const prettier = require('gulp-prettier')

const { paths } = require('./gulpfile.paths')

const prettierOptions = require('.' + paths.root + '.prettierrc.json')

const formatCss = () => {
  return src(['.' + paths.src.css + '**/*.css'])
    .pipe(prettier(prettierOptions))
    .pipe(dest('.' + paths.src.css))
}

const checkCss = () => {
  return src(['.' + paths.src.css + '**/*.css'])
    .pipe(prettier.check(prettierOptions))
    .pipe(notify('css'))
}

const formatJs = () => {
  return src(['.' + paths.src.js + '**/*.js'])
    .pipe(prettier(prettierOptions))
    .pipe(dest('.' + paths.src.js))
}

const checkJs = () => {
  return src(['.' + paths.src.js + '**/*.js'])
    .pipe(prettier.check(prettierOptions))
    .pipe(notify('js'))
}


module.exports = {
  formatCss,
  checkCss,
  formatJs,
  checkJs
}
