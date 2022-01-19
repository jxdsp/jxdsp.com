var _czc = _czc || []
_czc.push(['_setAccount', 'process.env.ANALYTICS_UMENG'])

const scriptElement = document.createElement('script')
const scriptSrc = 'https://s9.cnzz.com/z_stat.php?id=process.env.ANALYTICS_UMENG&web_id=process.env.ANALYTICS_UMENG'

scriptElement.src = scriptSrc
document.head.appendChild(scriptElement)
