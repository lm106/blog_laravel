require('./bootstrap');

import { createApp } from 'vue';

createApp({})
    .component('example', require('./components/Example.vue').default)
    .component('navbar',require('./components/navbar.vue').default)
    .mount('#ppa')

