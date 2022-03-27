<template>
    <div>
       <h1>{{message}}</h1>
       <router-link to="/signup">Registrarse</router-link>
       <router-view></router-view>
    </div>
</template>

<script>
/*import home from './home.vue'
import signup from './components/signup'*/
export default {
  /*components: { home },*/
  data() {
      return {
        message: " Bienvenido World"
      }
  }

}
</script>
