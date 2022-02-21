import Vue from 'vue'
import App from './App.vue'
import VueSidebarMenu from 'vue-sidebar-menu'

Vue.use(VueSidebarMenu)

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')