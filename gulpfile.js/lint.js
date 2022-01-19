const { src, lastRun, parallel } = require('gulp')
const gulpEsLint = require('gulp-eslint-new')
const gulpStylelint = require('gulp-stylelint')

const { paths } = require('./gulpfile.paths')

const gulpStylelintOptions = {
  fix: true,
  failAfterError: false,
  reportOutputDir: paths._cache.stylelint,
  reporters: [
    { formatter: 'string', console: true },
    {
      formatter: 'json',
      save: 'stylelintCache_' + new Date().getTime() + '.json'
    }
  ]
}

const lintScss = () => {
  return src([paths.src.scss + '**/*.scss'], { since: lastRun(lintScss) })
    .pipe(gulpStylelint(gulpStylelintOptions))
}

const lintCss = () => {
  return src([paths.src.css + '**/*.css'], { since: lastRun(lintCss) })
    .pipe(gulpStylelint(gulpStylelintOptions))
}

const lintJs = () => {
  return src([paths.src.js + '**/*.js'], { since: lastRun(lintJs) })
    .pipe(gulpEsLint({ fix: true }))
    .pipe(gulpEsLint.format())
}

// Export
module.exports.lints = parallel(lintScss, lintCss, lintJs)
