const { src, dest, watch, lastRun } = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const autoprefixer = require('gulp-autoprefixer')

// import configuration
const { paths } = require('./gulpfile.paths')

// Plug-in options
const autoprefixerOptions = {
  cascade: false
}

const compileScss = () => {
  return src(paths.src.scss + '**/*.scss', { since: lastRun(compileScss) })
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(dest(paths._cache.static.css))
}

const compileCss = () => {
  return src(paths._cache.static.css + '**/*.css', { since: lastRun(compileCss) })
    .pipe(autoprefixer(autoprefixerOptions))
    .pipe(dest(paths._cache.static.css))
}

const compileTs = () => {
  return src(paths.src.ts + '**/*.ts', { since: lastRun(compileTs) })
    .pipe(dest(paths._cache.static.js))
}

const compileJs = () => {
  return src(paths.src.js + '**/*.js', { since: lastRun(compileJs) })
    .pipe(dest(paths._cache.static.js))
}

const watchCompile = () => {
  watch([paths.src.scss + '**/*.scss'], compileScss)
  watch([paths.src.css + '**/*.css'], compileCss)
  watch([paths.src.ts + '**/*.ts'], compileTs)
  watch([paths.src.js + '**/*.js'], compileJs)
}

module.exports = {
  compileTs,
  compileScss,
  compileCss,
  compileJs,
  watchCompile
}
