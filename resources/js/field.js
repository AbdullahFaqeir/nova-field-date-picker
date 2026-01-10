import VCalendar from 'v-calendar';
import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
    app.use(VCalendar);
    app.component('index-super-date-picker', IndexField)
    app.component('detail-super-date-picker', DetailField)
    app.component('form-super-date-picker', FormField)
})
