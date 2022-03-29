require('./bootstrap');
<<<<<<< HEAD
/*
window.Vue = require('vue').default;
*/
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
/*
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
*/
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*
const app = new Vue({
    el: '#app',
});
*/
import { createApp } from 'vue'
import App from './components/App'
import  router from './router/index'

/*
const app = createApp({})
=======
>>>>>>> d9bc9de860373dc9a161fc1c06bb0e0d0849005d

import { createApp } from 'vue';
import Inicio from './components/Inicio'

<<<<<<< HEAD
app.mount('#app')*/
import VueAxios from 'vue-axios'
import axios from 'axios';

export const instance = axios.create({
    baseURL: 'https:/localhost:8000/',
    timeout: 1000,
    headers: {'X-Custom-Header': 'foobar'}
  });
const app =createApp(App)

app.use(router)

app.mount("#app")

