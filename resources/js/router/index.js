import signup from '../components/user/signup.vue'
import { createRouter, createWebHistory } from 'vue-router'
const router = [
  { 
    path: '/signup', 
    component: signup 
  },
  {
    path: '/',
    component: require('../components/home.vue').default
  },
  {   
    path: '/recetas/:id',
    component: require('../components/recetas/recetamostrar.vue').default

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