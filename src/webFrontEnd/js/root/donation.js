$().ready(() => {
  const donationGroup = document.querySelector('#donationGroup')
  const qrcode = {
    alipay: 'process.env.QRCODE_DONATE_ALIPAY',
    wechat: 'process.env.QRCODE_DONATE_WEIXIN',
    qq: 'process.env.QRCODE_DONATE_QQ',
    paypal: ''
  }

  if (donationGroup) {
    Array.prototype.slice.call(donationGroup.querySelectorAll('a')).forEach((triggerA) => {
      triggerA.addEventListener('click', () => {
        const div = document.createElement('div')
        const img = document.createElement('img')
        const textDiv = document.createElement('div')
        const donationReminder = document.createElement('div')
        const qrcodeOption = {
          errorCorrectionLevel: 'H',
          type: 'image/jpeg',
          margin: 2,
          width: 300,
          quality: 0.3,
          color: {
            dark: '#65a43c',
            light: '#ffffff'
          }
        }

        div.className = 'd-flex flex-column justify-content-center align-items-center'
        textDiv.className = 'fs-3 fw-bolder'

        textDiv.innerHTML = triggerA.title
        donationReminder.className = 'text-danger small'

        donationReminder.innerHTML = '您捐赠的款项将由受赠方自由支配，一旦捐赠不支持退回。其实主要还是用于本站相关服务及其间接技术服务或人力支持费用。'

        QRCode.toDataURL(
          qrcode[triggerA.id],
          qrcodeOption,
          (err, imgBase64) => {
            if (err) throw err
            img.className = 'img-thumbnail'
            img.src = imgBase64
            img.alt = triggerA.innerHTML
            img.title = img.alt
          }
        )

        div.appendChild(textDiv)
        div.appendChild(img)
        div.appendChild(donationReminder)

        bModal('', div, '', '', true)
      })
    })
  }
})
