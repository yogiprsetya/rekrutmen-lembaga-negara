import Vue from 'vue'
import Router from 'vue-router'
import datalamaran from '@/pages/data-lamaran'
import datapelamar from '@/pages/data-pelamar'
import login from '@/pages/login'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'datalamaran',
      component: datalamaran
    },
    {
      path: '/data-pelamar/:id',
      name: 'datapelamar',
      component: datapelamar
    },
    {
      path: '/login',
      name: 'login',
      component: login
    }
  ]
})