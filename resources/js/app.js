import './bootstrap';
import './assets/sass/app.scss'

import {createApp} from 'vue'
import App from './app/App.vue'
const app = createApp(App)

import router from "./router/index.js";
app.use(router)

app.mount("#app")
