import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-role-select', IndexField)
  app.component('detail-role-select', DetailField)
  app.component('form-role-select', FormField)
})
