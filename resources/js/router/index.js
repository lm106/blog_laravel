import { createRouter, createWebHistory } from 'vue-router'
const router = [

  { 
    path: '/', 
    component:  require('../components/Inicio.vue').default
  },
  { 
    path: '/signup', 
    component:  require('../components/user/signup.vue').default 
  },
  {
    path: '/login',
    component: require('../components/user/login.vue').default
  },
  {   
    path: '/recetas/:id',
    component: require('../components/recetas/recetamostrar.vue').default

  },
  { 
    path: '/perfil', 
    component:  require('../components/user/profile.vue').default 
  },
  { 
    path: '/list_users', 
    component:  require('../components/user/admin/list_user.vue').default 
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

  },
  {
    path: '/formulario_contacto',
    component: require('../components/FormContacto.vue').default
  },
  {
    path: '/new_recipe',
    component: require('../components/recipes-manager.vue').default
  }, 
  {
    path: '/edit_user/:id',
    name: 'edit_user',
    props: true,
    component: require('../components/user/admin/edit_user.vue').default
  },
  {
    path: '/lists_private',
    component: require('../components/list_private/lists_private.vue').default
  },
  {
    path: '/list_private/:name_list',
    name: 'list_private',
    props: true,
    component: require('../components/list_private/list_private.vue').default
  },
  {
    path: '/edit_list/:name_list',
    name: 'edit_list_private',
    props: true,
    component: require('../components/list_private/edit_list_private.vue').default
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