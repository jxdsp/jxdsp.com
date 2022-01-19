const { src, dest, watch, lastRun, series, parallel } = require('gulp')
const cleanCss = require('gulp-clean-css')
const terser = require('gulp-terser')
const htmlMin = require('gulp-html-minifier-terser')
const rename = require('gulp-rename')

// import configuration
const { paths } = require('./gulpfile.paths')

// Plug-in options
const gulpTerserOptions = {
  sourceMap: true
}
const cleanCssOptions = {
  format: {
    breakWith: 'lf'
  }
}
const renameOptions = {
  minify: {
    suffix: '.min'
  },
  rtl: {
    suffix: '.rtl'
  }
}
const htmlMinOptions = {
  collapseWhitespace: true,  //从字面意思应该可以看出来，清除空格，压缩html，这一条比较重要，作用比较大，引起的改变压缩量也特别大。
  collapseBooleanAttributes: true,  //省略布尔属性的值，比如：<input checked="checked"/>,那么设置这个属性后，就会变成 <input checked/>。
  removeComments: true,  //清除html中注释的部分，我们应该减少html页面中的注释。
  removeEmptyAttributes: true,  //清除所有的空属性。
  removeScriptTypeAttributes: true,  //清除所有script标签中的type="text/javascript"属性。
  removeStyleLinkTypeAttributes: true,  //清楚所有Link标签上的type属性。
  minifyJS: true,  //压缩html中的javascript代码。
  minifyCSS: true  //压缩html中的css代码。
}

// begin
const minifyCss = () => {
  return src([paths._cache.static.css + '**/*.css'], { since: lastRun(minifyCss) })
      .pipe(cleanCss(cleanCssOptions))
      .pipe(rename(renameOptions.minify))
      .pipe(dest(paths._cache.static.css))
}

const minifyJs = () => {
  return src([paths._cache.static.js + '**/*.js'], { since: lastRun(minifyJs) })
    .pipe(terser(gulpTerserOptions))
    .pipe(rename(renameOptions.minify))
    .pipe(dest(paths._cache.static.js))
}

const minifyHtml = () => {
  return src([paths._cache.html + '**/*.html'])
    .pipe(htmlMin(htmlMinOptions))
    .pipe(dest(paths.wwwRoot))
}

const watchStaticMinifyAssets = () => {
  watch([paths._cache.static.css + '**/*.css'], minifyCss)
  watch([paths._cache.static.js + '**/*.js'], minifyJs)
  watch([paths._cache.html + '**/*.html'], minifyHtml)
}

module.exports = {
  minifyCss,
  minifyJs,
  minifyHtml,
  watchStaticMinifyAssets
}
