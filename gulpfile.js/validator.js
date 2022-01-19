const { src, dest } = require('gulp')
const validator = require('gulp-html')

const { paths } = require('./gulpfile.paths')

const validatorOptions = {
  html: {
    html: true,
    verbose: true,
    // NoStream: true,
    // format: 'text',
  },
  svg: {},
  css: {},
}

const validatorWwwRootHtml = () => {
  return src([paths.wwwRootHtml, paths.exclude.exclude_wwwRootStatic])
    .pipe(validator(validatorOptions.html))
    .pipe(dest(paths.wwwRoot))
}

// Export
exports.validatorHtml = validatorWwwRootHtml
