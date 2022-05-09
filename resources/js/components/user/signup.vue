<template>
  <div class="section_form">
      <h2> {{ title }} </h2>
      <ul class="success">
        <li v-if="getError.message_error_1">{{ getError.message_error_1}}</li> 
        <li v-if="getError.message_error_2">{{getError.message_error_2}}</li> 
        <li v-if="getError.message_error_3">{{getError.message_error_3}}</li> 
        <li v-if="getError.message_error_4">{{getError.message_error_4}}</li>
      </ul>
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
          // {email: ''},
          // {name: ''},
          // {name_last: ''},
          // {password: ''},
          // {repeat_password: ''}
          
        ],
        error_message:[{
          message_error_1:'',
          message_error_2:'',
          message_error_3:'',
          message_error_4:''
        }],
        error:''
      }
    },
    computed:{
      getError(){
        return this.error_message[0];
      }, 
      user(){
        return (this.user[0])? this.user[0] : this.user;
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
         })console.log(this.user.type);*/
         var vm=this;
        if(this.validate(0)){
          axios.post('/signup', { name: this.user.name, name_last: this.user.name_last, email: this.user.email, password: this.user.password, type: '2'}).then(() => {
            console.log('saved');
            window.location.href="/";
          }, function (error) {
            console.log(error.response.data); 
            vm.error=error.response.data.message;
          });
        }
        if(this.error !=='') this.message_error_2="El email tiene que ser único";
      },
      validate(){
        this.getError.message_error_1='';
        this.getError.message_error_2='';
        this.getError.message_error_3='';
        this.getError.message_error_4='';
        var flag=true;
        if (!this.user.name) {
          this.getError.message_error_1= "El nombre no puede estar vacío";
          flag= false;
        } 
        if (!this.user.email) {
          this.getError.message_error_2= " El email no puede estar vacío";
          flag= false;
        }
        if (!this.user.password) {
          this.getError.message_error_3= " La contraseña no puede estar vacía"
          flag= false;
        }
        if (!this.user.repeat_password) {
          this.getError.message_error_4= " Es necesario confirmar la contraseña no puede dejarla vacía";
          flag= false;
        }
        if (this.user.password !== this.user.repeat_password){
            this.message_error_4= " La contraseña no coincide";
            flag= false;
        }
        return flag;
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
