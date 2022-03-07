import Categories from '@/components/Categories'
import Work from '@/components/Work'

import VueRouter from 'vue-router'

const routes = [
    //{ path: '/', component: Acceuil },
    { path: '/categories', component: Categories },
    { path: '/work', component: Work },
  ]

const router = new VueRouter({routes})

export default router;