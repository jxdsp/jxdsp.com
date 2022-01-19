const { src, dest, watch, lastRun } = require('gulp')
const npmDist = require('gulp-npm-dist')

// import configuration
const { paths } = require('./gulpfile.paths')

// Plug-in options
const npmDistConfig = {
  nodeModulesPath: paths.root,
  packageJsonPath: paths.root
}

// begin
const copyNpmDist = () => {
  return src(npmDist(npmDistConfig), { base: paths.node_modules })
    .pipe(dest(paths._cache.static.dist))
}

const copyAssets = () => {
  return src([paths.src.assets + '**'], { since: lastRun(copyAssets) })
    .pipe(dest(paths.wwwRoot))
}

const copyCss = () => {
  return src([paths.src.css + '**/*.css'], { since: lastRun(copyCss) })
    .pipe(dest(paths._cache.static.css))
}

const copyJs = () => {
  return src([paths.src.js + '**/*.js'], { since: lastRun(copyJs) })
    .pipe(dest(paths._cache.static.js))
}

const watchStaticAssets = () => {
  watch([paths.src.assets + '**'], copyAssets)
  watch([paths.src.css + '**/*.css'], copyCss)
  watch([paths.src.js + '**/*.js'], copyJs)
}

module.exports = {
  copyNpmDist,
  copyAssets,
  copyCss,
  copyJs,
  watchStaticAssets
}
