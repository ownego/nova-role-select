Nova.booting((Vue, router, store) => {
  Vue.component('index-role-select', require('./components/IndexField'))
  Vue.component('detail-role-select', require('./components/DetailField'))
  Vue.component('form-role-select', require('./components/FormField'))
})
