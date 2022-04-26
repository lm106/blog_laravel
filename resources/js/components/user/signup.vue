<template>
  <div class="section_form">
      <h2> {{ title }} </h2>
      <p id="success">{{message_error}}</p>
      <form  class='form_edit_signup' @submit.prevent="signUp">
        <label class="label_signup">Nombre:</label><br>
        <input type="text" class="input_signup" v-model="user.name" placeholder="name" /><br>
        <label class="label_signup">Apellidos:</label><br>
        <input text="text" class="input_signup" v-model="user.name_last" placeholder="name_last" /><br>
        <label class="label_signup">Email:</label><br>
        <input type="email" class="input_signup" v-model="user.email" placeholder="name@example.com" /><br>
        <label class="label_signup">Contraseña:</label><br>
        <input type="password" class="input_signup" v-model="user.password" placeholder="password" /><br>
        <label class="label_signup">Confirmar contraseña:</label><br>
        <input type="password" class="input_signup" v-model="user.repeat_password" placeholder="repeat password" /><br>
        <!-- <input type="hidden" v-model="user.type" value="2"/> -->
        <input type="submit" id='btn_signup' value="Registrarse">
      </form>
      <div class='signup'>Si tienes cuenta <router-link to="/login" class="signup_login">Iniciar sesión</router-link></div>
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
        ],
        message_error:''
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
         if(this.user.password ===this.user.repeat_password){
            axios.post('/signup', { name: this.user.name, name_last: this.user.name_last, email: this.user.email, password: this.user.password, type: '2'}).then(() => {
              console.log('saved');
              window.location.href="/";
            }, function (error) {
              console.log(error.response.data); 
          });
         }else{
           this.message_error="La contraseña no coincide";
         }
      }
    }

}
</script>

<style>
.input_signup{
  padding-right:40%;
}
#btn_signup {
    margin-top: 20%;
    /* text-align: center; */
    /* margin: 0 auto; */
    margin-left: 30%;
    color: white;
    padding: 5px 25px;
    background: #AB8A62;
}
.label_signup {
    margin: 5px 0px;
}
.signup{
  padding: 5px 0px 15px 0px;
  color:#AB8A62;
}
</style>