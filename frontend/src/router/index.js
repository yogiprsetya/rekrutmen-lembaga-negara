import Vue from 'vue'
import Router from 'vue-router'
import listLembaga from '@/pages/list-lembaga'
import listJob from '@/pages/list-job'
import jobDetail from '@/pages/job-detail'
import dataDiri from '@/pages/data-diri'
import editProfil from '@/pages/edit-profil'
import register from '@/pages/register'
import login from '@/pages/login'
import proses from '@/pages/proses'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'listLembaga',
      component: listLembaga,
      meta: { 
        requiresAuth: true
      }
    },
    {
      path: '/jobs/:id',
      name: 'listJob',
      component: listJob,
      meta: { 
        requiresAuth: true
      }
    },
    {
      path: '/job-detail/:id',
      name: 'jobDetail',
      component: jobDetail,
      meta: { 
        requiresAuth: true
      }
    },
    {
      path: '/data-diri',
      name: 'dataDiri',
      component: dataDiri,
      meta: { 
        requiresAuth: true
      }
    },
    {
      path: '/edit-profil',
      name: 'editProfil',
      component: editProfil,
      meta: { 
        requiresAuth: true
      }
    },
    {
      path: '/register',
      name: 'register',
      component: register,
      meta: { 
          guest: true
      }
    },
    {
      path: '/login',
      name: 'login',
      component: login,
      meta: { 
          guest: true
      }
    },
    {
      path: '/proses',
      name: 'proses',
      component: proses,
      meta: { 
          guest: true
      }
    }
  ]
})

// router.beforeEach((to, from, next) => {
//   if(to.matched.some(record => record.meta.requiresAuth)) {
//     if (localStorage.getItem('jwt') == null) {
//       next({ 
//         path: '/login',
//         params: { nextUrl: to.fullPath }
//       })
//     } else {
//       let user = JSON.parse(localStorage.getItem('user'))
//       if(to.matched.some(record => record.meta.is_admin)) {
//         if(user.is_admin == 1){
//             next()
//         }
//         else{
//             next({ name: 'userboard'})
//         }
//       }
//       else {
//       	next()
//       }
//     }
//   } else if(to.matched.some(record => record.meta.guest)) {
// 	    if(localStorage.getItem('jwt') == null){
// 	        next()
// 	    }
// 	    else{
// 	        next({ name: 'userboard'})
// 	    }
//     }else {
//     next() 
//   }
// })

// export default router