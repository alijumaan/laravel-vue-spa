require('./bootstrap')
import { createApp } from "vue"
import {store} from "./store/store"
import {router} from "./router/router"
import App from './App.vue'
import './plugins/sweetaler2'
import CKEditor from './plugins/ckeditor.js'
import pagination from 'v-pagination-3'

const app = createApp(App);

app.use(store);
app.use(router);
app.use( CKEditor );
app.component('pagination', pagination);
app.mount('#app');

document.title = store.state.app_title
