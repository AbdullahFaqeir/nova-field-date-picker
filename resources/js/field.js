import VCalendar from 'v-calendar';
import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
    app.use(VCalendar);
    app.component('index-v-calendar', IndexField)
    app.component('detail-v-calendar', DetailField)
    app.component('form-v-calendar', FormField)
})
