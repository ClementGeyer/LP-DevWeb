import Vue from 'vue'
import VueRouter from 'vue-router'
import VueSidebarMenu from 'vue-sidebar-menu'
import App from './App.vue'

import router from './router'

import AxiosPlugin from 'vue-axios-cors';

Vue.config.productionTip = false

Vue.use(VueSidebarMenu)
Vue.use(VueRouter)
Vue.use(AxiosPlugin)

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')