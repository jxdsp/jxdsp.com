const { series, parallel } = require('gulp')

const { cleanCache, cleanWwwRoot, cleanNode_modules, cleanVendor } = require('./clean')
const { copyNpmDist, copyAssets, copyCss, copyJs } = require('./copy')
const { minifyJs, minifyCss, minifyHtml } = require('./minify')
const { revNpmDist, revCss, revJs, revStaticFileName } = require('./rev')
const { pages } = require('./pages')
const { compileScss, compileCss, compileTs, compileJs, watchCompile } = require('./compile')
const { sitemapFiles } = require('./sitemap')
const { formatCss, checkCss, formatJs, checkJs } = require('./prettier')
const { loopPages } = require('./loopPages')
const { replaceAllJs, replaceAllHtml } = require('./replace')

exports.default = series(
  parallel(cleanCache, cleanWwwRoot),
  parallel(compileScss,compileTs),
  parallel(copyNpmDist, copyAssets, copyCss, copyJs),
  compileCss,
  replaceAllJs,
  parallel(minifyJs, minifyCss),
  parallel(revNpmDist, revCss, revJs),
  revStaticFileName,
  replaceAllHtml,
  loopPages,
  pages,
  minifyHtml,
  sitemapFiles
)
exports.clean = parallel(cleanCache, cleanWwwRoot)
exports.cleanX = parallel(cleanCache, cleanWwwRoot, cleanVendor, cleanNode_modules)
exports.lints = require('./lint').lints
exports.watch = require('./watch').watch
exports.serve = require('./serve').serve

exports.formatCss = formatCss
exports.checkCss = checkCss
exports.formatJs = formatJs
exports.checkJs = checkJs
