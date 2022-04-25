<template>
<div style="margin-top:5rem;">    
      <h2> {{ title }} </h2>
      <form  @submit.prevent="login()">
        <input type="email" v-model="user.email" placeholder="name@example.com" />
        <input type="password" v-model="user.password" placeholder="password" />
        <input type="submit" value="Submit">
      </form>
      <router-link to="/signup" id="log-in">Registrarse</router-link>
</div>
</template>

<script>
import Signup from './signup.vue';
export default {
    name:'login',
    component: Signup,
    data() {
      return {
        title: 'Iniciar Sesión',   
        user: [
          {email: ''},
          {password: ''}
        ],
        errors:[]
      }
    },
    methods:{
        login(){
            // console.log(this.user);
            // console.log('login');
            axios.post('/login', {email: this.user.email,password: this.user.password}).then(() => {
            // console.log(res);
              window.location.href='/';
            }, function (error) {
                console.log(error.response.data); 
            });
        }
    }
}
</script>

<style>

</style>