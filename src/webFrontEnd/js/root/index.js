const submitLinkParse = async (linkUrl = '', triggerElement = Object) => {
  const url = 'process.env.DOMAIN_API/v2/'

  const data = {
    link: linkUrl,
    token: await userStore.getItem('token', (err, xx) => xx),
    video: 's'
  }
  $.ajax({
    method: 'post',
    url,
    cache: false,
    dataType: 'json',
    timeout: 6e3,
    data,
    success: successData => {
      _analyticsPush_trackPageview(['/ShortVideoParseResultModal', document.location])

      setTimeout(() => {
        removeSpinnerIcon(triggerElement)
      }, 4e3)

      // getVideoJsFiles()
      getResult(successData, data.link)
    },
    error: errorData => {
      removeSpinnerIcon(triggerElement)
      commonAjaxErrorFeedback(errorData)
    }
  })
}

const parseInputText = (input = Object, temp = Object) => {
  const reg = /(http:\/\/|https:\/\/)((\w|=|\?|\.|\/|&|:|#!|!!|#\/?|-)+)/g
  const link = $.trim(input.value).match(reg)

  if (!link) {
    bModal('', createSmallCenterText('您输入的内容不包含正确的网址。', 'danger'), '', '', true)
    removeSpinnerIcon(temp)
  } else {
    input.value = link[0]
    submitLinkParse(link[0], temp)
  }
}

$().ready(() => {
  const videoUrlBtn = document.querySelectorAll('#videoUrlBtn button')

  Array.prototype.slice.call(videoUrlBtn).forEach(currentBtn => {
    currentBtn.addEventListener('click', () => {
      if (currentBtn.classList.contains('videoParse')) {
        const jxInput = document.querySelector('#jxInput')
        addSpinnerIcon(currentBtn)
        parseInputText(jxInput, currentBtn)
      }
    })
  })
})

$().ready(() => {
  dblclickInputClearValue('jxInput')
  pasteClearValue('jxInput')
})
