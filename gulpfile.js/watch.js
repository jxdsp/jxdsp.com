const { parallel } = require('gulp')

const { watchPages } = require('./pages')
const { watchStaticAssets } = require('./copy')
const { watchStaticMinifyAssets } = require('./minify')
const { watchSitemapFiles } = require('./sitemap')
const { watchRevStatic } = require('./rev')

exports.watch = parallel(
  watchPages,
  watchStaticAssets,
  watchStaticMinifyAssets,
  watchSitemapFiles,
  watchRevStatic
)
