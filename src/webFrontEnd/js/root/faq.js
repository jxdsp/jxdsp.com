$().ready(() => {
  const communityAccount = document.querySelector('#communityAccount')
  if (communityAccount) {
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
    const communityAccountList = communityAccount.querySelectorAll('a')

    Array.prototype.slice.call(communityAccountList).forEach(triggerA => {
      triggerA.addEventListener('click', () => {
        const img = document.createElement('img')
        const qrcodeString = triggerA.dataset.qrcode
        QRCode.toDataURL(
          qrcodeString,
          qrcodeOption,
          (err, imgBase64) => {
            if (err) throw err
            img.className = 'img-thumbnail d-block mx-auto'
            img.src = imgBase64
            img.alt = triggerA.title
            img.title = img.alt
          }
        )

        bModal(triggerA.title, img, '', 'sm', true)
      })
    })

  }
})
