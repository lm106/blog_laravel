<template>
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
export default {
  /*components: { home },*/
  data() {
      return {
        message: " Bienvenido World",
        login:false
      }
  }

}
</script>
