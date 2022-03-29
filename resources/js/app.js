require('./bootstrap');

import { createApp } from 'vue';
import Inicio from './components/Inicio'

createApp({})
    .component('navbar',require('./components/navbar.vue').default)
    .mount('#ppa')
    
createApp(Inicio).mount("#inicio")