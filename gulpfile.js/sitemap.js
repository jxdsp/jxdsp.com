const { src, dest, watch } = require('gulp')
const sitemap = require('gulp-sitemap')

require('dotenv').config({
  path: './env/webFrontEnd/.env'
})

const { paths } = require('./gulpfile.paths')

const sitemapFiles = () => {
  return src([paths.wwwRootHtml, paths.exclude.exclude_wwwRootStatic])
    .pipe(
      sitemap({
        siteUrl: process.env.DOMAIN_PROTOCOL + process.env.DOMAIN_WWW + '/',
        verbose: true,
        noindex: true
        // lastmod: '',
      })
    )
    .pipe(dest(paths.wwwRoot + 'sitemap/'))
}

const watchSitemapFiles = () => {
  watch([paths.wwwRootHtml, paths.exclude.exclude_wwwRootStatic], sitemapFiles)
}

module.exports = {
  sitemapFiles,
  watchSitemapFiles
}
