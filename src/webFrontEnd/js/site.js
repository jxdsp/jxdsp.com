// 显示页面
const a_body = document.body.querySelector('#body')
if (a_body) {
  a_body.removeAttribute('hidden')
}

// funDebug反馈
const funDebugFeedback = (errorName, errorResult) => {
  if (fundebug) {
    const options = {
      metaData: {
        location: document.location,
        errorResult
      }
    }
    fundebug.notify(errorName, errorResult, options)
    bModal(
      '',
      createSmallCenterText('本次异常已经自动反馈给管理员。', 'success'),
      '',
      'sm',
      true
    )
  }
}

// 共用Ajax请求异常反馈
const commonAjaxErrorFeedback = data => {
  if (fundebug) {
    funDebugFeedback('Ajax出现请求错误，请关注。', data)
    bModal(
      '',
      createSmallCenterText('抱歉，请求出错，请重新试一下。', 'danger'),
      '',
      'sm',
      true
    )
  }
}

// 页脚时间
const footerCurrentTime = () => {
  const span = document.createElement('span')
  span.className = 'd-block text-secondary text-nowrap small'
  span.id = 'current_time'
  span.innerHTML = '&nbsp'

  dayjs.locale('zh-cn')
  setInterval(() => {
    span.innerHTML = dayjs().format('YYYY年M月D日 dddA H点mm分s秒')
  }, 1000)

  return span
}

// ICP备案和公网安备
const footerRecordIcpNo = (icpNo = '') => {
  const a = document.createElement('a')

  a.className = 'mx-sm-2 small text-secondary text-decoration-none'
  a.href = 'process.env.LINK_GOV_ICP'
  a.target = '_blank'
  a.rel = 'noreferrer nofollow'
  a.title = 'ICP备案'
  a.innerHTML = icpNo

  return a
}

const footerRecordCode = (codeNumber = '', codeArea = '') => {
  const a = document.createElement('a')

  a.className = 'mx-sm-2 small text-secondary text-decoration-none'
  a.href = 'process.env.LINK_GOV_GONGAN' + codeNumber
  a.target = '_blank'
  a.rel = 'noreferrer nofollow'
  a.title = '公网安备号'
  a.innerHTML = codeArea + '公网安备&nbsp' + codeNumber + '号'

  return a
}

const footerRecord = () => {
  const div = document.createElement('div')

  div.className = 'd-flex flex-column flex-sm-row align-items-center small'
  div.id = 'footer_record'

  div.append(footerRecordIcpNo('process.env.BEIAN_ICP'))
  div.append(footerRecordCode('process.env.BEIAN_GONGAN', 'process.env.BEIAN_AREA'))
  return div
}

// 页脚二维码
const footerQrCodeModalTip = () => {
  const div = document.createElement('div')
  const a = document.createElement('a')
  const svg = document.createElement('svg')

  div.className = 'mt-2'

  a.className = 'text-decoration-none'
  a.href = 'javascript:'
  a.innerHTML = '&nbsp说明'

  svg.className = 'text-secondary far fa-question-circle fa-lg'

  new bootstrap.Popover(a, {
    trigger: 'focus hover',
    container: 'body',
    placement: 'top',
    // customClass: 'animate__animated animate__fadeInUp animate__faster',
    html: true,
    content: popoverContentInner('1.截屏或者保存二维码图片，通过扫一扫功能，快速打开当前页面。<br>2.点击二维码图片，复制本页地址。')
  })

  a.insertBefore(svg, a.firstChild)
  div.append(a)
  return div
}

const clipboardJsLocationHref = (event, container) => {
  const url = document.location.href
  const clipboard = new ClipboardJS(event, {
    container: document.querySelector('#Modal_' + container),
    text: function () {
      return url
    }
  })
  clipboard.on('success', () => {
    bModal(
      '',
      createSmallCenterText('网址复制成功', 'success'),
      '',
      'sm',
      true
    )
  })
  clipboard.on('error', () => {
    bModal(
      '',
      createSmallCenterText('网址复制失败', 'danger'),
      '',
      'sm',
      true
    )
    clipboard.destroy()
  })
}

const footerModalQrCode = () => {
  const url = document.location.href
  const div = document.createElement('div')
  const title = document.createElement('div')
  const img = document.createElement('img')
  const qrcodeOption = {
    errorCorrectionLevel: 'H',
    type: 'image/jpeg',
    margin: 2,
    width: 300,
    quality: 0.3,
    color: {
      dark: '#222222',
      light: '#ffffff'
    }
  }

  div.className = 'text-center'

  title.innerHTML = '二维码直达【' + document.title + '】'
  title.className = 'text-success'

  div.append(title)

  div.append(img)
  div.append(footerQrCodeModalTip())
  QRCode.toDataURL(url, qrcodeOption, (err, imgBase64) => {
    if (err) {
      throw err
    }

    img.src = imgBase64
    img.alt = document.title + '地址二维码'
  })

  const x = bModal('', div, '', '', true)
  clipboardJsLocationHref(img, x)
}

const footerQrCode = () => {
  const div = document.createElement('div')
  const span = document.createElement('span')
  const svg = document.createElement('svg')

  div.className = 'my-2'
  div.id = 'current_page_QR_code'

  span.className = 'hvr-icon-spin'
  span.title = '当前页面二维码'
  span.style.cursor = 'pointer'
  span.addEventListener('click', footerModalQrCode)

  svg.className = 'fa-2x fa-fw fas fa-qrcode hvr-icon'

  span.append(svg)
  div.append(span)

  return div
}

// 免责声明
const disclaimer = (text = '') => {
  const span = document.createElement('span')

  span.className = 'mx-n-3 text-secondary small'
  span.innerHTML = text

  return span
}

function copyRight(text = '') {
  const span = document.createElement('span')

  span.className = 'text-secondary small'
  span.innerHTML = text

  return span
}

const footerAddX = () => {
  const footerX = document.querySelector('#footer_x')

  footerX.append(footerQrCode())
  footerX.append(
    disclaimer('视频归相关网站及作者所有，本站不存储、不编辑任何视频及图片。')
  )
  footerX.append(footerRecord())
  footerX.append(footerCurrentTime())
  footerX.append(copyRight('2019 - 2021 &copy process.env.DOMAIN_ROOT'))
}

$().ready(() => {
  footerAddX()
})

// 防镜像
const domainCheck = () => {
  const currentHost = document.location.host
  const hosts = ['process.env.DOMAIN_WWW']
  let result = true
  if (hosts.includes(currentHost)) {
    result = false
  }

  return result
}

const antiMirror = () => {
  setTimeout(() => {
    if (domainCheck()) {
      if (fundebug) {
        fundebug.notify('发现镜像', document.location.href, {
          metaData: {
            location: document.location
          }
        })
      }

      setTimeout(() => {
        window.location.href = window.location.href.replace(document.location.host, 'process.env.DOMAIN_WWW')
      }, 3000)
    }
  }, 1000)
}

$().ready(() => {
  antiMirror()
})

/* headroom.js */
const header = document.querySelector('#jx_header')
const HeadroomOptions = {
  onPin: () => {
  },
  onUnpin: () => {
  },
  onTop: () => {
    header.classList.remove('header--fixed', 'headroom--pinned')
  },
  onNotTop: () => {
    header.classList.add('header--fixed')
  },
  onBottom: () => {
  },
  onNotBottom: () => {
  }
}
const headroom = new Headroom(header, HeadroomOptions)
headroom.init()

/* lozad.js */
const observer = lozad()
observer.observe()
