(function() {
  const bp = document.createElement('script')
  const curProtocol = window.location.protocol.split(':')[0]
  bp.src = curProtocol === 'https' ? 'https://zz.bdstatic.com/linksubmit/push.js' : 'http://push.zhanzhang.baidu.com/push.js'

  const s = document.getElementsByTagName('script')[0]
  s.parentNode.insertBefore(bp, s)
})()
