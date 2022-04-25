<template>
  <div class="section">
      <h2> {{ title }} </h2>
      <p id="success"></p>
      <form  @submit.prevent="signUp">
        <input type="text" v-model="user.name" placeholder="name" />
        <input text="text" v-model="user.name_last" placeholder="name_last" />
        <input type="email" v-model="user.email" placeholder="name@example.com" />
        <input type="password" v-model="user.password" placeholder="password" />
        <input type="password" v-model="user.repeat_password" placeholder="repeat password" />
        <!-- <input type="hidden" v-model="user.type" value="2"/> -->
        <input type="submit" value="Submit">
      </form>

      <!-- <button @click="showUser()">Mostrar datos</button> -->
  </div>
</template>

<script>
// import axios from 'axios'
export default {
    name:'signup',
    data() {
      return {
        title: 'Registrate',   
        user: [
          {email: '',
          name: '',
          name_last: '',
          password: '',
          repeat_password: ''
          }
        ]
      }
    },
    methods: {
      showUser(){
        console.log(this.user);
      },
      signUp(){/*
         axios.get('/user', {
            name: this.user.name

         }).then(() => {
           console.log('saved');
         }).catch((error)=>{
            this.errors=error.response.data.errors;
         })*/console.log(this.user.type);
          axios.post('/signup', { name: this.user.name, name_last: this.user.name_last, email: this.user.email, password: this.user.password, type: '1'}).then(() => {
            console.log('saved');
            window.location.href="/";
          }, function (error) {
            console.log(error.response.data); 
        });
      }
    }

}
</script>

<style>
.section{
  margin-top:5rem;
}
</style>