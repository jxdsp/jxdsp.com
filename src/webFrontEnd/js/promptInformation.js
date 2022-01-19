const promptInformation_1 = () => {
  const promptTitle =
    '<div class="fw-bolder text-blueviolet">重要提示</div>'
  const promptContent =
    '<div class="fw-bolder">' +
    '<div class="py-1 small">目前不支持解析长视频地址。</div>' +
    '<div class="py-1 small">注册账号后使用更多功能。</div>' +
    '<div class="py-1 small">短视频地址请通过浏览器访问后，再复制地址栏的对应地址进行解析。</div>' +
    '<div class="py-1 small">有任何需求，请联系唯一的群主QQ 1372616066</div>' +
    '<div class="py-1 d-flex justify-content-end">2021.12.8 十一月初五</div>' +
    '</div>'
  const promptFooter = '' +
    '<button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal" aria-label="关闭">' +
    '<span class="small">关闭</span>' +
    '</button>'

  let modalOpts = {
    backdrop: 'static',
    keyboard: false,
  }
  return bModal(promptTitle, promptContent, promptFooter, 'default', true, null, null, null, modalOpts)
}

const promptInformation_2 = () => {
  const promptTitle =
    '<div class="fw-bolder text-blueviolet">功能介绍</div>'
  const promptContent =
    '<div class="fw-bolder">' +
    '<div class="py-1 small">页面底部二维码图标可以获取对应页面的二维码。</div>' +
    '<div class="py-1 small">解析记录将会存储到当前设备，注册会员可存储到账号下。</div>' +
    '<div class="py-1 d-flex justify-content-end">更新于 2021.12.8 十一月初五</div>' +
    '</div>'
  const promptFooter = '' +
    '<button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal" aria-label="关闭">' +
    '<span class="small">关闭</span>' +
    '</button>'

  let modalOpts = {
    backdrop: 'static',
    keyboard: false,
  }
  return bModal(promptTitle, promptContent, promptFooter, 'default', true, null, null, null, modalOpts)
}

promptInformation_2()
promptInformation_1()
