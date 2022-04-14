import { createRouter, createWebHistory } from 'vue-router'
const router = [
  { 
    path: '/signup', 
    component:  require('../components/user/signup.vue').default 
  },/* ######No va sino lo duplica#####
  {
    path: '/',
    component: require('../components/App.vue').default
  },*/
  {   
    path: '/recetas/:id',
    component: require('../components/recetas/recetamostrar.vue').default

  },
  { 
    path: '/profile/:id', 
    component:  require('../components/user/profile.vue').default 
  }
  
]
/** OTRA FORMA
 * const routes = [
  { path: '/', component: require('./components/ExampleComponent.vue') },
  { path: '/user', component: require('./components/User.vue') }
]
*/

export default createRouter({
  history: createWebHistory('/'),
  routes: router
})