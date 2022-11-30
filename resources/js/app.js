import './bootstrap'

import {createApp} from 'vue'
import router from './router'
import Notifications from '@kyvg/vue3-notification'

import App from './App.vue'
import store from './store'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret, faXmark, faCheck , faHome, faSignOut, faTachometer, faSquarePollVertical} from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faXmark, faCheck, faHome, faSignOut, faTachometer, faSquarePollVertical)

createApp(App).component('font-awesome-icon', FontAwesomeIcon).use(router).use(store).use(Notifications).mount('#app')