const root = './' // 路径没有问题，当前是为符合nodejs的环境，而不是为了符合gulp的环境。
const node_modules = root + 'node_modules/'
const gulpfile = root + 'gulpfile.js/'
const _cache = root + '.cache/webFrontEnd/'
const src = root + 'src/webFrontEnd/'
const srcTemplate = src + 'template/'
const wwwRoot = root + 'wwwRoot/'
const wwwRootStatic = wwwRoot + 'static/'
const wwwRootApi = wwwRoot + 'api/'

module.exports = {
  paths: {
    root: root,
    node_modules: node_modules,
    _cache: {
      base: _cache,
      html: _cache + 'html/',
      stylelint: _cache + 'stylelint/',
      eslint: _cache + 'eslint/',
      rev: {
        revManifest: _cache + 'revManifest/'
      },
      static: {
        base: _cache + 'static/',
        css: _cache + 'static/css/',
        js: _cache + 'static/js/',
        assets: _cache + 'static/assets/',
        dist: _cache + 'static/dist/'
      },
      template: {
        base: _cache + 'template/',
        loop: _cache + 'template/loop/',
        pages: _cache + 'template/pages/',
        partials: _cache + 'template/partials/'
      }
    },
    gulpfile: gulpfile,
    wwwRoot: wwwRoot,
    wwwRootHtml: wwwRoot + '**/*.html',
    src: {
      css: src + 'css/',
      js: src + 'js/',
      ts: src + 'ts/',
      scss: src + 'scss/',
      assets: src + 'assets/',
      template: {
        base: srcTemplate,
        loop: srcTemplate + 'loop/',
        pages: srcTemplate + 'pages/',
        partials: srcTemplate + 'partials/',
        allHtmlFiles: srcTemplate + '**/*.{html,htm}',
        allFiles: srcTemplate + '**/*.{html,htm,json}'
      }
    },
    wwwRootStatic: {
      base: wwwRootStatic,
      css: wwwRootStatic + 'css/',
      js: wwwRootStatic + 'js/',
      assets: wwwRootStatic + 'assets/',
      dist: wwwRootStatic + 'dist/'
    },
    exclude: {
      exclude_wwwRootStatic: '!' + wwwRootStatic + '**/*.*',
      exclude_wwwRootApi: '!' + wwwRootApi
    }
  }
}
