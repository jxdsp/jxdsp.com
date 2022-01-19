/* 本地存储 */
const historyStore = localforage.createInstance({
  driver: localforageDriver,
  name: 'core',
  storeName: 'history',
  description: '历史记录'
})

const testArr = [
  [1, 2, 3],
]

historyStore.setItem('testArr', testArr)
  .then(value => {
    // console.log(value)
    // console.log(JSON.parse(JSON.stringify(value)))
  })

const history = document.querySelector('#history')

new bootstrap.Dropdown(history, {
  offset: [10, 200],
  autoClose: 'outside'
})
