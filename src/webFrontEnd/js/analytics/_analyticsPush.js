
const _analyticsPush_trackEvent = infoArray => {
  _czc ? _czc.push(['_trackEvent', ...infoArray]) : ''
  _hmt ? _hmt.push(['_trackEvent', ...infoArray]) : ''
}

const _analyticsPush_trackPageview = infoArray => {
  _czc ? _czc.push(['_trackPageview', ...infoArray]) : ''
  _hmt ? _hmt.push(['_trackPageview', ...infoArray]) : ''
}
