const { src, dest } = require('gulp')
const map = require('map-stream')

require('dotenv').config({
  path: './env/webFrontEnd/.env'
})

const { paths } = require('./gulpfile.paths')

const processEnv = {
  domain: {
    root: process.env.DOMAIN_ROOT,
    www: process.env.DOMAIN_WWW,
    api: process.env.DOMAIN_PROTOCOL + process.env.DOMAIN_API,
    static: process.env.DOMAIN_PROTOCOL + process.env.DOMAIN_STATIC,
    image: process.env.DOMAIN_PROTOCOL + process.env.DOMAIN_IMAGE
  },
  beian: {
    icp: process.env.BEIAN_ICP,
    gongan: process.env.BEIAN_GONGAN,
    gongan_area: process.env.BEIAN_AREA
  },
  link: {
    gov: {
      icp: process.env.LINK_GOV_ICP,
      gongan: process.env.LINK_GOV_GONGAN
    }
  },
  qrcode: {
    donate: {
      alipay: process.env.QRCODE_DONATE_ALIPAY,
      weixin: process.env.QRCODE_DONATE_WEIXIN,
      qq: process.env.QRCODE_DONATE_QQ
    },
    group: {
      alipay: process.env.QRCODE_GROUP_ALIPAY,
      weixin: process.env.QRCODE_GROUP_WEIXIN,
      qq: process.env.QRCODE_GROUP_QQ
    },
    id: {
      alipay: process.env.QRCODE_ALIPAY,
      weixin: process.env.QRCODE_WEIXIN,
      qq: process.env.QRCODE_QQ
    }
  },
  funDebugApi: process.env.FUNDEBUG_APIKEY,
  google: {
    gtagId: process.env.G00GLE_GTAGID
  },
  analytics: {
    baidu: process.env.ANALYTICS_BAIDU,
    umeng: process.env.ANALYTICS_UMENG
  }
}

const replaceAllJs = () => {
  return src(paths._cache.static.js + '**/*.js')
    .pipe(map(function(file, done) {
      let contents = file.contents.toString()
      contents = contents.replace(/process.env.DOMAIN_ROOT/g, `${processEnv.domain.root}`)
      contents = contents.replace(/process.env.DOMAIN_WWW/g, `${processEnv.domain.www}`)
      contents = contents.replace(/process.env.DOMAIN_API/g, `${processEnv.domain.api}`)
      contents = contents.replace(/process.env.BEIAN_ICP/g, `${processEnv.beian.icp}`)
      contents = contents.replace(/process.env.BEIAN_GONGAN/g, `${processEnv.beian.gongan}`)
      contents = contents.replace(/process.env.BEIAN_AREA/g, `${processEnv.beian.gongan_area}`)
      contents = contents.replace(/process.env.LINK_GOV_ICP/g, `${processEnv.link.gov.icp}`)
      contents = contents.replace(/process.env.LINK_GOV_GONGAN/g, `${processEnv.link.gov.gongan}`)
      contents = contents.replace(/process.env.ANALYTICS_BAIDU/g, `${processEnv.analytics.baidu}`)
      contents = contents.replace(/process.env.ANALYTICS_UMENG/g, `${processEnv.analytics.umeng}`)
      contents = contents.replace(/process.env.QRCODE_DONATE_ALIPAY/g, `${processEnv.qrcode.donate.alipay}`)
      contents = contents.replace(/process.env.QRCODE_DONATE_WEIXIN/g, `${processEnv.qrcode.donate.weixin}`)
      contents = contents.replace(/process.env.QRCODE_DONATE_QQ/g, `${processEnv.qrcode.donate.qq}`)
      file.contents = Buffer.from(contents)
      done(null, file)
    }))
    .pipe(dest(paths._cache.static.js))
}

const replaceAllHtml = () => {
  return src(paths._cache.template.base + '**/*.*')
    .pipe(map(function(file, done) {
      let contents = file.contents.toString()
      contents = contents.replace(/process.env.DOMAIN_API/g, `${processEnv.domain.api}`)
      contents = contents.replace(/process.env.FUNDEBUG_APIKEY/g, `${processEnv.funDebugApi}`)
      contents = contents.replace(/process.env.G00GLE_GTAGID/g, `${processEnv.google.gtagId}`)
      contents = contents.replace(/process.env.QRCODE_GROUP_ALIPAY/g, `${processEnv.qrcode.group.alipay}`)
      contents = contents.replace(/process.env.QRCODE_GROUP_WEIXIN/g, `${processEnv.qrcode.group.weixin}`)
      contents = contents.replace(/process.env.QRCODE_GROUP_QQ/g, `${processEnv.qrcode.group.qq}`)
      contents = contents.replace(/process.env.QRCODE_ID_ALIPAY/g, `${processEnv.qrcode.id.alipay}`)
      contents = contents.replace(/process.env.QRCODE_ID_WEIXIN/g, `${processEnv.qrcode.id.weixin}`)
      contents = contents.replace(/process.env.QRCODE_ID_QQ/g, `${processEnv.qrcode.id.qq}`)
      file.contents = Buffer.from(contents)
      done(null, file)
    }))
    .pipe(dest(paths._cache.template.base))
}

module.exports = {
  replaceAllJs,
  replaceAllHtml
}
