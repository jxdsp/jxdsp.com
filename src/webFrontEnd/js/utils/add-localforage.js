import localforage from 'localforage'

// 添加 localforage记录
const addLocalforageArray = (itemName, value) => {
  const itemArray = localforage.getItem(itemName)
  if (undefined === itemArray) localforage.setItem(itemName, value)
}
