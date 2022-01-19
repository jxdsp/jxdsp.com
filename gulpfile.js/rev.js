const { src, dest, watch, lastRun, series, parallel } = require('gulp')
const rev = require('gulp-rev')
const revCollector = require('gulp-rev-collector')

// import configuration
const { paths } = require('./gulpfile.paths')

// Plug-in options
const revManifestOptions = {
  css: {
    path: 'css.json',
    merge: true
  },
  js: {
    path: 'js.json',
    merge: true
  },
  img: {
    path: 'img.json',
    merge: true
  },
  dist: {
    path: 'dist.json',
    merge: true
  }
}

// begin
const revNpmDist = () => {
  return src([paths._cache.static.dist + '**/*.*'], { since: lastRun(revNpmDist) })
    .pipe(rev())
    .pipe(dest(paths.wwwRootStatic.dist))
    .pipe(rev.manifest(revManifestOptions.dist))
    .pipe(dest(paths._cache.rev.revManifest))
}

const revCss = () => {
  return src([paths._cache.static.css + '**/*.css'], { since: lastRun(revCss) })
    .pipe(rev())
    .pipe(dest(paths.wwwRootStatic.css))
    .pipe(rev.manifest(revManifestOptions.css))
    .pipe(dest(paths._cache.rev.revManifest))
}

const revJs = () => {
  return src([paths._cache.static.js + '**/*.js'], { since: lastRun(revJs) })
    .pipe(rev())
    .pipe(dest(paths.wwwRootStatic.js))
    .pipe(rev.manifest(revManifestOptions.js))
    .pipe(dest(paths._cache.rev.revManifest))
}

const revStaticFileName = () => {
  return src([paths._cache.rev.revManifest + '**/*.json', paths.src.template.allFiles])
    .pipe(revCollector({
      replaceReved: true
    }))
    .pipe(dest(paths._cache.template.base))
}

const watchRevStatic = () => {
  watch([paths._cache.static.dist + '**/*.*'], parallel(revNpmDist))
  watch([paths._cache.static.css + '**/*.css'], parallel(revCss))
  watch([paths._cache.static.js + '**/*.js'], parallel(revJs))
}

module.exports = {
  revNpmDist,
  revCss,
  revJs,
  revStaticFileName,
  watchRevStatic
}
