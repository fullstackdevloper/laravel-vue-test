import './bootstrap'

import {createApp} from 'vue'
import router from './router'
import Notifications from '@kyvg/vue3-notification'

import App from './App.vue'
import store from './store'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

createApp(App).use(router).use(store).use(Notifications).mount('#app')