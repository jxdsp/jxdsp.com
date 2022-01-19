// 搜索栏
const jxVideoShareLink = ShareLink => {
  const videoShareLink = document.querySelector('#videoShareLink')
  videoShareLink.innerHTML = ShareLink
}

const jxVideoTitle = titleContent => {
  const videoTitle = document.querySelector('#videoTitle')
  videoTitle.innerHTML = titleContent
}

const jxVideoCoverImage = (coverUrl, coverAltText) => {
  const videoCoverImage = document.querySelector('#videoCoverImage')
  videoCoverImage.src = coverUrl
  videoCoverImage.alt = coverAltText
  videoCoverImage.title = coverAltText
}

const insertAuthorAvatar = (avatarUrl, avatarText) => {
  const authorAvatar = document.querySelector('#authorAvatar')
  authorAvatar.src = avatarUrl
  authorAvatar.alt = avatarText
  authorAvatar.title = avatarText
}

const insertAuthorDesc = (descText) => {
  const authorDesc = document.querySelector('#authorDesc')
  authorDesc.innerHTML = descText
}

const insertAuthorName = (nameText) => {
  const authorName = document.querySelector('#authorName')
  authorName.innerHTML = nameText
}

const jxDownloadVideo = videoLink => {
  const downloadVideo = document.querySelector('#downloadVideo')

  downloadVideo.href = videoLink
  downloadVideo.download = location.host + ' ' + Math.round(Date.now() / 1000)

  downloadVideo.addEventListener('click', () => {
  })
}

const jxCopyVideoLink = (videoLink, container) => {
  const copyVideoLink = document.querySelector('#copyVideoLink')
  const clipboard = new ClipboardJS(copyVideoLink, {
    container: document.querySelector('#Modal_' + container),
    text() {
      return videoLink
    }
  })

  clipboard.on('success', e => {
    e.clearSelection()
    bModal('', createSmallCenterText('已经成功复制无水印的视频链接，直接粘贴即可。', 'success'), '', '', true)
  })
  clipboard.on('error', () => {
    bModal('', createSmallCenterText('复制失败，请刷新页面后重新解析。', 'danger'), '', '', true)
    clipboard.destroy()
  })
}

const jxDownloadCover = function(CoverLink, fileName) {
  const downloadCover = document.querySelector('#downloadCover')

  downloadCover.addEventListener('click', () => {
    window.URL = window.URL || window.webkitURL
    const xhr = new XMLHttpRequest()
    xhr.open('get', CoverLink, true)
    // xhr.setRequestHeader('Referer', 'https://douyin.com')
    // xhr.setRequestHeader('origin', 'https://douyin.com')
    xhr.responseType = 'blob'
    xhr.addEventListener('load', function() {
      if (this.status === 200) {
        // 得到一个blob对象
        const blob = this.response
        // console.log("blob", blob)
        // console.log("blob.size", blob.size)
        // console.log("blob.type", blob.type)
        // let oFileReader = new FileReader()
        // oFileReader.onloadend = function (e) {
        //     let base64 = e.target.result
        //     // console.log("方式一》》》》》》》》》", base64)
        // }
        // oFileReader.readAsDataURL(blob)

        const img = document.createElement('img')
        img.addEventListener('load', () => {
          // window.URL.revokeObjectURL(img.src) // 清除释放
          const link = document.createElement('a')
          link.rel = 'noreferrer'
          link.href = window.URL.createObjectURL(blob)
          link.download = fileName
          link.click()
        })
        img.src = window.URL.createObjectURL(blob)
      }
    })
    xhr.send()
  })
}

const jxCopyCoverLink = (CoverLink, container) => {
  const copyCoverLink = document.querySelector('#copyCoverLink')
  const clipboard = new ClipboardJS(copyCoverLink, {
    container: document.querySelector('#Modal_' + container),
    text() {
      return CoverLink
    }
  })

  clipboard.on('success', e => {
    e.clearSelection()
    bModal('', createSmallCenterText('已经成功复制无水印的封面图片链接，直接粘贴即可。', 'success'), '', '', true)
  })
  clipboard.on('error', () => {
    bModal('', createSmallCenterText('复制失败，请刷新页面后重新解析。', 'danger'), '', '', true)
    clipboard.destroy()
  })
}

const jxCopyTitle = (Title, container) => {
  const copyTitle = document.querySelector('#copyTitle')
  const clipboard = new ClipboardJS(copyTitle, {
    container: document.querySelector('#Modal_' + container),
    text() {
      return Title
    }
  })

  clipboard.on('success', e => {
    e.clearSelection()
    bModal('', createSmallCenterText('已经成功复制文案内容，直接粘贴即可。', 'success'), '', '', true)
  })
  clipboard.on('error', () => {
    bModal('', createSmallCenterText('复制失败，请刷新页面后重新解析。', 'danger'), '', '', true)
    clipboard.destroy()
  })
}

const Jx_DownloadCover = () => {
  const a = document.createElement('a')
  a.className = 'my-1 btn btn-sm btn-outline-primary'
  a.target = '_blank'
  a.id = 'downloadCover'
  a.innerHTML = '下载封面'

  return a
}

const Jx_CopyCoverLink = () => {
  const a = document.createElement('a')
  a.className = 'my-1 btn btn-sm btn-outline-primary'
  a.id = 'copyCoverLink'
  a.innerHTML = '复制封面链接'

  return a
}

const jxCoverResult = () => {
  const coverResult = document.createElement('div')

  coverResult.id = 'coverResult'

  coverResult.append(Jx_DownloadCover())
  coverResult.append(Jx_CopyCoverLink())

  return coverResult
}

const Jx_CopyVideoLink = () => {
  const a = document.createElement('a')
  a.className = 'my-1 btn btn-sm btn-outline-primary'
  a.id = 'copyVideoLink'
  a.innerHTML = '复制视频链接'

  return a
}

const jxVideoResult = () => {
  const videoResult = document.createElement('div')

  videoResult.id = 'videoResult'
  videoResult.append(Jx_CopyVideoLink())

  return videoResult
}

const Jx_CopyTitle = () => {
  const a = document.createElement('a')
  a.className = 'my-1 btn btn-sm btn-outline-primary'
  a.id = 'copyTitle'
  a.innerHTML = '复制文案内容'

  return a
}

const jxTitleResult = () => {
  const titleResult = document.createElement('div')

  titleResult.id = 'titleResult'

  titleResult.append(Jx_CopyTitle())

  return titleResult
}

const jxResultBtnList = () => {
  const resultBtnList = document.createElement('div')

  resultBtnList.className = 'mb-1 d-flex flex-wrap justify-content-around'
  resultBtnList.id = 'resultBtnList'

  resultBtnList.append(jxVideoResult())
  resultBtnList.append(jxCoverResult())
  resultBtnList.append(jxTitleResult())

  return resultBtnList
}

const jxVideoInfoPreview = () => {
  const videoInfoPreview = document.createElement('div')
  const videoSourceInfo = document.createElement('span')
  const videoShareLink = document.createElement('span')
  const videoTitle = document.createElement('span')

  videoInfoPreview.className = 'mb-1 d-flex flex-column justify-content-center'
  videoInfoPreview.id = 'videoInfoPreview'

  videoSourceInfo.className = 'text-center'
  videoSourceInfo.id = 'videoSourceInfo'

  videoShareLink.className = 'text-center'
  videoShareLink.id = 'videoShareLink'

  videoTitle.className = 'text-center'
  videoTitle.id = 'videoTitle'

  videoInfoPreview.append(videoSourceInfo)
  videoInfoPreview.append(videoShareLink)
  videoInfoPreview.append(videoTitle)

  return videoInfoPreview
}

const jxVideoImgPreview = () => {
  const videoImgPreview = document.createElement('div')
  const img = document.createElement('img')

  videoImgPreview.className = 'mb-1 d-flex justify-content-center'
  videoImgPreview.id = 'videoImgPreview'

  img.className = 'img-thumbnail bg_square border-3 border-secondary'
  img.src =
    'data:image/gifbase64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'
  img.id = 'videoCoverImage'

  videoImgPreview.append(img)

  return videoImgPreview
}

const authorInfoPreview = () => {
  const authorInfoPreview = document.createElement('div')
  const authorName = document.createElement('span')
  const authorDesc = document.createElement('span')
  const authorAvatarDiv = document.createElement('div')
  const authorAvatar = document.createElement('img')

  authorInfoPreview.className = 'mb-1 d-flex flex-column justify-content-center'
  authorInfoPreview.id = 'authorInfoPreview'

  authorName.className = 'text-center'
  authorName.id = 'authorName'

  authorDesc.className = 'text-center'
  authorDesc.id = 'authorDesc'

  authorAvatarDiv.className = 'mx-auto p-2 rounded-circle border border-primary border-2 overflow-hidden'

  authorAvatar.className = 'img-fluid'
  authorAvatar.width = 70
  authorAvatar.height = 0
  authorAvatar.id = 'authorAvatar'

  authorAvatarDiv.append(authorAvatar)
  authorInfoPreview.append(authorAvatarDiv)
  authorInfoPreview.append(authorName)
  authorInfoPreview.append(authorDesc)

  return authorInfoPreview
}

const Jx_DownloadVideo = () => {
  const videoResult = document.querySelector('#videoResult')
  const a = document.createElement('a')
  a.className = 'my-1 btn btn-sm btn-outline-primary'
  a.target = '_blank'
  a.innerHTML = '观看/下载视频'

  videoResult.append(a) // todo:当前未使用，等调整好直接使用按钮进行下载视频后，把本函数改为和复制视频链接一样的格式写法。
}

const jxSourceInfo = sourceCode => {
  const videoSourceInfo = document.querySelector('#videoSourceInfo')
  const source = {
    douyin: '抖音',
    kuaishou: '快手',
    xiaohongshu: '小红书',
    weibo: '微博',
    ulikecam: '剪映',
    xigua: '西瓜视频',
    huoguo: '火锅短视频',
    huoshan: '火山小视频',
    toutiao: '今日头条',
    qutoutiao: '趣头条',
    weishi: '微视',
    tiktok: 'tiktok',
    pipix: '皮皮虾',
    qqkandian: 'QQ看点',
    haokan: '好看视频',
    meipai: '美拍',
    oasis: '绿洲',
    instagram: 'instagram',
    shuabao: '刷宝短视频',
    quanmin: '全民小视频',
    izuiyou: '最右',
    youtube: 'Youtube',
    bilibili: 'B站',
    bbq: '轻视频',
    immomo: '陌陌',
    pearvideo: '梨视频',
    eyepetizer: '开眼',
    ippzone: '皮皮搞笑',
    '163music': '网易云音乐',
    kandian: '看点视频',
    acfun: 'AcFun',
    liwo: '梨涡',
    ttaidu: '魔豆',
    uc: 'UC浏览器',
    mgtv: '茄子短视频',
    vuevideo: 'VUE',
    xinpianchang: '新片场',
    vmovier: '场库',
    miaopai: '秒拍',
    moviebase: '巴塞电影',
    keep: 'keep',
    kg: '全民k歌',
    wide: 'WIDE',
    xiaokaxiu: '小影',
    uwpp: '灵感'
  }

  videoSourceInfo.innerHTML = source[sourceCode.toLowerCase()]
}

const getResult = (data, link) => {
  if (undefined === data.code || data.code !== 0) {
    _analyticsPush_trackEvent(['解析', '解析失败', link, data.msg])

    return bModal('', createSmallCenterText(data.msg, 'danger'), '', 'sm', true)
  }

  if (data.code !== 0) {
    return bModal('', createSmallCenterText('抱歉，短视频解析失败，请重试。'), '', 'sm', true)
  }

  _analyticsPush_trackEvent(['解析', '解析成功', link])

  const modalId = bModal('解析结果', '', '', 'full')
  const modalBody = document.querySelector('#modalBody_' + modalId)
  modalBody.append(jxResultBtnList())
  modalBody.append(jxVideoInfoPreview())
  modalBody.append(authorInfoPreview())
  modalBody.append(jxVideoImgPreview())

  let videoResult = ''
  let video_title = ''
  let video_cover_url = ''
  let video_source = ''
  let video_play_url = ''
  let author = {}

  videoResult = data.body
  video_cover_url = videoResult.video_info.cover
  video_source = videoResult.platform
  video_title = videoResult.text
  video_play_url = videoResult.video_info.url
  author = videoResult.author ?? ''
  if (author) {
    insertAuthorName(author.name)
    insertAuthorAvatar(author.avatar, author.name)
    insertAuthorDesc(author.desc)
  }
  let video_raw_share_url = videoResult.url
  jxSourceInfo(video_source)
  jxVideoShareLink(video_raw_share_url)
  jxVideoTitle(video_title)
  jxVideoCoverImage(video_cover_url, video_title)
  jxCopyTitle(video_title, modalId)
  jxCopyCoverLink(video_cover_url, modalId)
  jxDownloadCover(video_cover_url, video_title)
  jxCopyVideoLink(video_play_url, modalId)
  // jxDownloadVideo(video_play_url)
}

const getVideoJsFiles = () => {
  loadJsFile('/static/dist/video.js/dist/video.min.js')
  loadCssFile('/static/dist/video.js/dist/video-js.min.css')
  // $.getScript('/static/video_js/video.min.js')
  // if (videojs === undefined) $.getScript('/static/video_js/video.min.js')
}
