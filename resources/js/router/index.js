import { createRouter, createWebHistory } from 'vue-router'
const router = [

  { 
    path: '/', 
    component:  require('../components/Inicio.vue').default
  },
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
  }, 
  {   
    path: '/recetas',
    component: require('../components/Receta.vue').default

  },
  {   
    path: '/recipe_description/:id',
    name: 'recipe_description',
    props: true,
    component: require('../components/Recipe-description.vue').default

  },
  {
    path: '/recipes_manager',
    component: require('../components/recipes-manager.vue').default

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