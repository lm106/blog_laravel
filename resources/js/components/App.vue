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
    
<div>
  <h1>{{message}}</h1>
  <router-link to="/profile/1">Perfil</router-link> <!--v-if="login" --><br>
  <router-link to="/login">Iniciar Sesión</router-link>
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
        message: " Bienvenido World",
        login:false
      }
  }

}
</script>
