/**
 * 动态加载js文件
 * @params {String} url 动态加载js文件路径
 * @params {Function} callback 加载完js文件之后的回调
 * @params {String} id 动态加载js文件的script标签的id
 * @params {Object} parent 动态加载js文件的script标签放在哪个父元素下，默认值为document.body
 */
function loadScript(url, callback, id, parent) {
  let parentDom = document.body
  parent && (parentDom = parent)

  if (id && parentDom.querySelector(`#${id}`)) {
    callback && callback()
  } else {
    let script = document.createElement('script')
    script.type = 'text/javascript'
    script.async = 'async'
    script.src = url
    id && (script.id = id)
    parentDom.appendChild(script)

    if (script.readyState) {
      // IE
      script.onreadystatechange = function () {
        if (script.readyState === 'complete' || script.readyState === 'loaded') {
          script.onreadystatechange = null
          callback && callback()
        }
      }
    } else {
      // 非IE
      script.onload = function () {
        callback && callback()
      }
    }

  }
}
