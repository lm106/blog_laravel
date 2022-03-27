<template>
    <div>
       <h1>{{message}}</h1>
      <router-view></router-view>  
    </div>
</template>

<script>
import home from './home.vue'
/*ççimport signup from './components/signup'*/
export default {
  components: { home },
  data() {
      return {
        message: " Bienvenido World"
      }
  }

}
</script>
