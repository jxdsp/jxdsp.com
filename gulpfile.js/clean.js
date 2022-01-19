const del = require('del')

const { paths } = require('./gulpfile.paths')

const cleanCache = () => {
  return del([paths._cache.base])
}

const cleanWwwRoot = () => {
  return del([paths.wwwRoot + '**', paths.exclude.exclude_wwwRootApi + '**'])
}

const cleanVendor = () => {
  return del([paths.root + 'vendor/'])
}

const cleanNode_modules = () => {
  return del([paths.node_modules])
}

module.exports = {
  cleanCache,
  cleanWwwRoot,
  cleanNode_modules,
  cleanVendor
}
