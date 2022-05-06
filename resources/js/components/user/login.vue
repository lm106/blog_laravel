<template>
<div id="section_login"> 
      <h2> {{ title }} </h2>
      <ul class="success">
            <li v-if="error">{{ error }}</li>
        </ul>
      <form  id='form_login' @submit.prevent="login()">
        <label>Email:</label><br>
        <input type="email" class='input_login' v-model="user.email" placeholder="name@example.com" /><br>
        <label id='label_password'>Contraseña:</label><br>
        <input type="password" class='input_login' v-model="user.password" placeholder="password" /><br>
        <input type="submit" id='submit' value="Iniciar Sesión">
      </form>
      <div id='registrar_login'> ¿No tienes cuentas?<router-link to="/signup" class="signup_login">Créala aqui</router-link></div>
</div>
</template>

<script>
import signup from './signup.vue';
export default {
  components: { signup },
    name:'login',
    component: signup,
    data() {
      return {
        title: 'Iniciar Sesión',   
        user: [
          {email: ''},
          {password: ''}
        ], error:''
      }
    },
    methods:{
        login(){
          this.error='';
            axios.post('/login', {email: this.user.email,password: this.user.password}).then((res) => {
            // console.log(res);
              if(res.data==='ok') {
                window.location.href='/';
              }else{
                this.error="Error: Usuario y/o contraseña no coincide";
              }
            }, function (error) {
                console.log(error.response.data); 
            });
        }
    }
}
</script>

<style>
#section_login {
    width: 50%;
    margin: 5rem auto;
    text-align: center;
    width: 661px;
    height: 539px;
    left: 182px;
    top: 235px;
    background: #F8EBEC;
    padding-top: 50px;
}

#form_login {
    width: 80%;
    text-align: start;
    padding-top: 10%;
    color: #AB8A62;
    margin: 0 auto;
}
#form_login label{
  font-size: 16px;
}
.input_login {
    background: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-radius: 0px;
    width: 100%;
    margin: 5px 0px 10px 0px;
}
#submit {
    font-size: 16px;
    background: #AB8A62;
    color: white;
    margin-left: 38%;
    margin-top: 15%;
    padding: 5px 20px;
}
#label_password{
  margin-top:2%;
}
#registrar_login{
  margin-top: 15px;
  color: #AB8A62;
}
.signup_login{
 color: #AB8A62;
}

</style>