<template>
  <inicio></inicio>

  <div>
    <br>
    <br>
    <br>
    sadf

    <br>
    asdfsadfsadf 
    <br>
    asdfasdf 
    <br>
    asdfasdf 
    <br>
    <h1>{{message}}</h1>
    <router-link to="/signup">Registrarse</router-link>
    <router-view></router-view>
  </div>
    
</template>

<script>
/*import home from './home.vue'
import signup from './components/signup'*/
import inicio from './Inicio.vue'
export default {
  /*components: { home },*/
  components: {inicio},
  data() {
      return {
        message: " Bienvenido World"
      }
  }

}
</script>
