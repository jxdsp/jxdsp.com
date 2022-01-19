// 封装方法
const createSmallCenterText = (text, color = '') => {
  const div = document.createElement('div')

  div.className = color
    ? 'small text-center text-' + color
    : 'small text-center'
  div.innerHTML = text

  return div
}

const addSpinnerIcon = (
  element = Object,
  spinnerType = null,
  color = null,
  position = null
) => {
  const loadIcon = document.createElement('span')
  switch (spinnerType) {
    case 'grow':
      loadIcon.className = 'ml-1 spinner-grow spinner-grow-sm align-self-center'
      break
    case 'border':
    default:
      loadIcon.className =
        'ml-1 spinner-border spinner-border-sm align-self-center'
  }

  if (color) {
    loadIcon.classList.add('text-' + color)
  }

  toggleDisabledElement(element)

  switch (position) {
    case 'before':
    case 'left':
      element.insertBefore(loadIcon, element.firstChild)
      break
    case 'after':
    case 'right':
    default:
      element.appendChild(loadIcon)
  }
}

const removeSpinnerIcon = (element = Object) => {
  toggleDisabledElement(element)
  // element.firstElementChild ? element.removeChild(element.firstElementChild) : ''
  element.lastElementChild ? element.removeChild(element.lastElementChild) : ''
}

const toggleDisabledElement = (element = Object) => {
  const disabledElementType = ['BUTTON']
  if (disabledElementType.includes(element.tagName)) {
    if (element.hasAttribute('disabled')) {
      element.removeAttribute('disabled')
    } else {
      element.setAttribute('disabled', 'disabled')
    }
  } else {
    if (element.classList.contains('disabled')) {
      element.classList.remove('disabled')
    } else {
      element.classList.add('disabled')
    }
  }
}

const popoverContentInner = innerHTML => {
  const span = document.createElement('span')
  span.className = ''
  span.innerHTML = innerHTML
  return span
}

const addClass = (element, className) => {
  element.classList.add(className)
}

const removeClass = (element, className) => {
  element.classList.remove(className)
}

const replaceClass = (element, oldClassName, newClassName) => {
  if (element.classList.contains(oldClassName)) {
    element.classList.remove(oldClassName)
    element.classList.add(newClassName)
  } else if (element.classList.contains(newClassName)) {
    element.classList.remove(newClassName)
    element.classList.add(oldClassName)
  } else {
    return false
  }

  return true
}

const replaceTitle = (element, oldTitle, newTitle) => {
  const eTitle = element.title
  if (undefined === eTitle) {
    return false
  }

  if (oldTitle === eTitle) {
    element.setAttribute('title', newTitle)
  } else if (newTitle === eTitle) {
    element.setAttribute('title', oldTitle)
  } else {
    return false
  }

  return true
}

/**
 * @param {string|string[]} statusCode
 */
const setCrawlStatus = (statusCode) => {
  const crawlStatus = document.querySelector('#crawlStatus > svg')
  crawlStatus.removeAttribute('class')
  crawlStatus.classList.add('mx-2', 'fa-lg', 'fas', 'fa-circle')
  crawlStatus.classList.add(...statusCode)
}

// js.cookie
const jsCookies = window.Cookies.noConflict()

const setCookie = (key, value = 1, attributes, secure = true) => {
  let jsCookiesAttributes

  jsCookiesAttributes =
    window.location.protocol === 'https'
      ? {
        secure: true,
        expires: 30,
        // httpOnly: true,
        // domain: '',
        // path: '',
        sameSite: 'Strict' // fixme:sameSite值后期待调整
      }
      : {
        expires: 30,
        // httpOnly: true,
        // domain: '',
        // path: '',
        sameSite: 'Strict'
      }

  if (secure === true) {
    const secureJsCookies = jsCookies.withAttributes(jsCookiesAttributes)
    secureJsCookies.set(key, value, attributes)
  } else {
    jsCookies.set(key, value, attributes)
  }

  return jsCookies.get(key) !== undefined
}

const getCookie = key => {
  if (jsCookies.get(key) === undefined) {
    return false
  }

  return jsCookies.get(key)
}

const removeCookie = key => {
  if (jsCookies.get(key) === undefined) {
    return true
  }

  jsCookies.remove(key)
  return true
}

// 动态加载静态文件
const loadJsFile = filePath => {
  const fileRef = document.createElement('script')
  fileRef.setAttribute('type', 'text/javascript')
  fileRef.setAttribute('src', filePath)
  if (typeof fileRef !== 'undefined') {
    document.querySelector('head').appendChild(fileRef)
  }
}

const loadCssFile = filePath => {
  const fileRef = document.createElement('link')
  fileRef.setAttribute('rel', 'stylesheet')
  fileRef.setAttribute('type', 'text/css')
  fileRef.setAttribute('href', filePath)

  if (typeof fileRef !== 'undefined') {
    document.querySelector('head').appendChild(fileRef)
  }
}

// 请空输入框
const dblclickInputClearValue = (HTMLInputId) => {
  const input = document.querySelector('#' + HTMLInputId)
  input.addEventListener('dblclick', () => {
    input.value = ''
  })
}

// 粘贴时清空旧内容
const pasteClearValue = (HTMLInputId) => {
  const input = document.querySelector('#' + HTMLInputId)

  input.addEventListener('paste', event => {
    if (event.clipboardData || event.originalEvent) {
      event.preventDefault()
      const clipboardData = event.clipboardData || window.clipboardData
      input.value = clipboardData.getData('text')
    } else {
      bModal(
        '',
        createSmallCenterText(
          '不支持自动删除旧内容，请手动删除旧内容后再粘贴。'
        ),
        '',
        'sm',
        true
      )
    }
  })
}

// localforage 配置
const localforageDriver = [
  localforage.INDEXEDDB,
  localforage.WEBSQL,
  localforage.LOCALSTORAGE
]
