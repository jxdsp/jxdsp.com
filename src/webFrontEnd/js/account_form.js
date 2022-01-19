// 部分初始化
const init = () => {

  // 第三方登录提示
  const oauth_sign_in = document.querySelector('#oauth_sign_in')
  if (oauth_sign_in) {
    Array.prototype.slice.call(oauth_sign_in.querySelectorAll('button')).forEach((triggerBtn) => {
      const titleText = triggerBtn.dataset.bsTitle

      new bootstrap.Tooltip(triggerBtn, { title: titleText })

      triggerBtn.addEventListener('click', () => {
        const tip = `<div class='fw-bolder text-center text-orange'>${titleText}功能正在开发中</div>`
        bModal('', tip, '', 'sm', true)
      })

    })
  }

  // 导航栏打开 sign 模态框时，切换选项卡
  Array.prototype.slice.call(document.querySelectorAll('.account_sign')).forEach((accountSignBtnTriggerEL) => {
    accountSignBtnTriggerEL.addEventListener('click', () => {
      const sign = document.querySelector('#sign')
      sign.addEventListener('show.bs.modal', () => {
        const tabTriggerEL = document.querySelector('[data-bs-target="' + accountSignBtnTriggerEL.dataset.tabTarget + '"]')
        bootstrap.Tab.getInstance(tabTriggerEL).show()
      }, { once: true })

      new bootstrap.Modal(sign).show()
    })
  })

  // 账号表单类型切换
  Array.prototype.slice.call(document.querySelectorAll('.sign_modal_tab')).forEach((modalTabTriggerEL) => {
    const x = new bootstrap.Tab(modalTabTriggerEL)
    modalTabTriggerEL.addEventListener('click', () => {
      x.show()
    })
  })

  // 密码明文显示
  Array.prototype.slice.call(document.querySelectorAll('.password_switch')).forEach((triggerIcon) => {
    triggerIcon.addEventListener('click', () => {
      let password_input = triggerIcon.previousElementSibling
      let switchIco = triggerIcon.firstChild

      const { type } = password_input
      switch (type) {
        case 'text':
          password_input.setAttribute('type', 'password')
          break
        case 'password':
        default:
          password_input.setAttribute('type', 'text')
      }

      replaceClass(switchIco, 'fa-eye-slash', 'fa-eye')
      replaceTitle(triggerIcon, '显示密码', '隐藏密码')
    })
  })

  // 手机号前缀选择
  Array.prototype.slice.call(document.querySelectorAll('#signIn_phonePrefixList a')).forEach((triggerPrefix) => {
    triggerPrefix.addEventListener('click', () => {
      document.querySelector('#signIn_phonePrefixBtn').innerHTML = triggerPrefix.innerHTML
    })
  })

}

init()

// 懒加载验证码
const captchaLazyLoad = (element) => {
  const observer = lozad(element)
  observer.observe()
}

// 刷新验证码方法之一
const RefreshCaptcha = () => {
  const captchaImg = document.querySelectorAll('.captchaImg')

  captchaLazyLoad(captchaImg)

  Array.prototype.slice.call(captchaImg).forEach((triggerImg) => {
    triggerImg.addEventListener('click', () => {
      const imgUrl = triggerImg.dataset.backgroundImage
      const now = Date.now()
      const newImgUrl = imgUrl + '?' + now
      triggerImg.style.backgroundImage = 'url(' + newImgUrl + ')'
    })
  })
}

RefreshCaptcha()

/**
 * @param {HTMLElement} element
 */
const elementShow = (element) => {
  element.classList.remove('d-none')
}

/**
 * @param {HTMLElement} element
 */
const elementHide = (element) => {
  element.classList.add('d-none')
}

/**
 * @param {HTMLElement} element
 */
const switchDisplay = (element) => {
  switch (element.classList.contains('d-none')) {
    case true:
      elementShow(element)
      break
    case false:
    default:
      elementHide(element)
      break
  }
}

const showSignButtons = () => {
  Array.prototype.slice.call(document.querySelectorAll('.account_sign')).forEach(triggerElement => {
    elementShow(triggerElement)
  })
}

const hideSignButtons = () => {
  Array.prototype.slice.call(document.querySelectorAll('.account_sign')).forEach(triggerElement => {
    elementHide(triggerElement)
  })
}

const showAccountButtons = () => {
  Array.prototype.slice.call(document.querySelectorAll('.account_sign_out')).forEach(triggerElement => {
    elementShow(triggerElement)
  })
}

const hideAccountButtons = () => {
  Array.prototype.slice.call(document.querySelectorAll('.account_sign_out')).forEach(triggerElement => {
    elementHide(triggerElement)
  })
}

// 本地存储
const userStore = localforage.createInstance({
  driver: localforageDriver,
  name: 'core',
  storeName: 'user',
  description: '用户核心信息'
})

const switchAccountDisplayStatus = () => {
  userStore.getItem('login')
    .then(loginStatus => {
      switch (loginStatus) {
        case true:
          showAccountButtons()
          hideSignButtons()
          listenerLogoutBtn()
          break
        case false:
        default:
          showSignButtons()
          hideAccountButtons()
          removeListenerLogoutBtn()
          break
      }
    })
}

switchAccountDisplayStatus()

const loginAfter = data => {
  const { token, login, nickname, length } = data

  if (token) {
    const x = bootstrap.Modal.getInstance(document.querySelector('#sign'))
    x.hide()

    _analyticsPush_trackEvent(['登录', '成功'])

    userStore.setItem('token', token)
    userStore.setItem('nickname', nickname)
    userStore.setItem('login', login)
      .then(loginStatus => {
        if (loginStatus) {
          bModal(null, createSmallCenterText('登录成功'), null, 'sm', true)
          switchAccountDisplayStatus()
        } else {
          bModal(null, createSmallCenterText('登录失败'), null, 'sm', true)
        }
      })
  } else {
    for (let i = 0, x = length; i < x; i++) {
      const { msg } = data[i] ? data[i] : '未知错误'
      bModal(null, createSmallCenterText(msg), null, 'sm', true)
    }
  }
}

const logoutAfter = data => {
  for (let i = 0, x = data.length; i < x; i++) {
    const { msg } = data[i] ? data[i] : '未知错误'
    bModal(null, createSmallCenterText(msg), null, 'sm', true)
  }
  userStore.removeItem('token')
  userStore.removeItem('nickname')
  userStore.setItem('login', false, switchAccountDisplayStatus)
}

const logoutBefore = () => {
  userStore.getItem('token')
    .then(tokenValue => {
      const data = {
        token: tokenValue
      }
      $.ajax({
        type: 'post',
        url: 'process.env.DOMAIN_API/user/logout/',
        dataType: 'json',
        timeout: 3000,
        data,
        success(data) {
          logoutAfter(data)
        },
        error(errorData) {
          console.log(errorData)
        }
      })
    })
}

const listenerLogoutBtn = () => {
  const exit = document.querySelector('#account_sign_exit')
  exit.addEventListener('click', logoutBefore)
}

const removeListenerLogoutBtn = () => {
  const exit = document.querySelector('#account_sign_exit')
  exit.removeEventListener('click', logoutBefore)
}

const registerAfter = data => {
  const { code, length } = data

  if (code === 0) {
    const x = bootstrap.Modal.getInstance(document.querySelector('#sign'))
    x.hide()

    _analyticsPush_trackEvent(['注册', '成功'])

    bModal('感谢', createSmallCenterText('注册成功，快使用新账号登录吧。'), '', 'sm', true)
  } else {
    for (let i = 0, x = length; i < x; i++) {
      const { msg } = data[i] ? data[i] : '未知错误'
      bModal(null, createSmallCenterText(msg), null, 'sm', true)
    }
  }
}

/*
 表单校验
 fixme:等到全局动态化后调整为仅限模态框生成后触发
*/
const wasNeedsValidations = needsValidationInput => {
  const addWasValidated = needsValidationInput.parentElement
  needsValidationInput.addEventListener('input', e => {
    if (e.target.value.length > 0) {
      addWasValidated.classList.add('was-validated')
    } else {
      addWasValidated.classList.remove('was-validated')
    }
  })
}
const needsValidations = document.querySelectorAll('.needs-validation')

Array.prototype.slice.call(needsValidations).forEach(triggerNeedsValidation => {
  wasNeedsValidations(triggerNeedsValidation)
})
// 登录

const tabSignIn = document.querySelector('#tab-sign_in')

if (tabSignIn) {
  const username = document.querySelector('#signIn_username')
  const password = document.querySelector('#signIn_password')
  const captchaCode = document.querySelector('#signIn_captchaCode')
  const rememberMe = document.querySelector('#rememberMe')

  const submit = document.querySelector('#signIn_submit')
  submit.addEventListener('click', () => {
    const data = {
      username: username.value,
      password: password.value,
      captchaCode: captchaCode.value,
      rememberMe: rememberMe.checked
    }
    $.ajax({
      type: 'post',
      url: 'process.env.DOMAIN_API/user/login/',
      dataType: 'json',
      timeout: 3000,
      data,
      success(data) {
        loginAfter(data)
      },
      error(errorData) {
        console.log(errorData)
      }
    })
  })

}

// 手机号登录

// 注册
const tabSignUp = document.querySelector('#tab-sign_up')
if (tabSignUp) {
  const username = document.querySelector('#signUp_username')
  const email = document.querySelector('#signUp_email')
  const password = document.querySelector('#signUp_password')
  const rePassword = document.querySelector('#signUp_rePassword')
  const captchaCode = document.querySelector('#signUp_captchaCode')
  const userTermsOfService = document.querySelector('#signUp_userTermsOfService')
  const privacyStatement = document.querySelector('#signUp_privacyStatement')
  const submit = document.querySelector('#signUp_submit')

  submit.addEventListener('click', () => {
    const data = {
      username: username.value,
      email: email.value,
      password: password.value,
      rePassword: rePassword.value,
      captchaCode: captchaCode.value,
      userTermsOfService: userTermsOfService.checked,
      privacyStatement: privacyStatement.checked
    }
    $.ajax({
      type: 'post',
      url: 'process.env.DOMAIN_API/user/register/',
      dataType: 'json',
      timeout: 3000,
      data,
      success(data) {
        registerAfter(data)
      },
      error(errorData) {
        console.log(errorData)
      }
    })
  })
}


// 找回密码
