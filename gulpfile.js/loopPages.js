const { src, dest, lastRun, watch, series, parallel } = require('gulp')
const fileInclude = require('gulp-file-include')
const rename = require('gulp-rename')

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

const loopPage_index = (newName) => {
  return src([paths._cache.template.loop + '**/index.html'])
    .pipe(fileInclude(fileIncludeOptions.production))
    .pipe(rename({
      basename: newName
    }))
    .pipe(dest(paths._cache.html + 'loop'))
}

const loopPages = (done) => {
  const { fileName } = require('.' + paths._cache.template.loop + 'json/index.json')
  for (let i = 0, x = fileName.length; i < x; i++) {
    loopPage_index(fileName[i])
  }
  done()
}

// Export
module.exports = {
  loopPages
}
