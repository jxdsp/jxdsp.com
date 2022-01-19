const { src, dest, lastRun, watch, series, parallel } = require('gulp')
const fileInclude = require('gulp-file-include')

const { paths } = require('./gulpfile.paths')

const fileIncludeOptions = {
  production: {
    indent: true,
    prefix: '@@',
    basepath: paths._cache.template.partials,
    context: {
      environment: 'production'
    }
  },
  development: {
    indent: true,
    prefix: '@@',
    basepath: paths._cache.template.partials,
    context: {
      environment: 'development'
    }
  }
}

const pages = () => {
  return src([paths._cache.template.pages + '**/*.html'])
    .pipe(fileInclude(fileIncludeOptions.production))
    .pipe(dest(paths._cache.html))
}

const watchPages = () => {
  watch([paths._cache.rev.revManifest + '**/*.json', paths.src.template.allFiles], pages)
}

module.exports = {
  pages,
  watchPages
}
