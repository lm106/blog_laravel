<template>
  <div class="section_form">
        <h2> {{ title }}&nbsp;{{ user.name }}</h2>
        <ul class="success">
        <li v-if="getError.message_error_1">{{ getError.message_error_1}}</li> 
        <li v-if="getError.message_error_2">{{getError.message_error_2}}</li> 
        <li v-if="getError.message_error_3">{{getError.message_error_3}}</li> 
        <li v-if="getError.message_error_4">{{getError.message_error_4}}</li>
      </ul>
        <form  class='form_edit_signup' @submit.prevent="update_user()">
        <div id='input_data'>
            <label>Rol:</label><br>
            <select v-model="user.type" id="rol">
                <option value="2">Usuario registrado</option>
                <option value="1">Administrador</option>
            </select><br>
            <label>Nombre:</label><br>
            <input type="text" v-model="user.name"/><br>
            <label>Apellidos:</label><br>
            <input type="text"  v-model="user.name_last"/><br>
            <label>Email:</label><br>
            <input type="email" readonly v-model="user.email"/><br>
            <label >Password:</label><br>
            <input type="password"  v-model="user.password"/><br>
        </div>
        <input type="submit"  id="update" value="Actualizar datos">
        </form> 
        <!-- <p>{{ user }}</p> -->
        <router-link to="/admin_list">Volver atrás</router-link>
    </div>
</template>

<script>
export default {
    name:'editUser',
    props: ["id"],
    beforeCreate(){
        axios.get(`/edit_user/${this.id}`).then(res=> {
            this.user = res.data;
            // console.log(res.data);
            // console.log(this.user);

        },
        (error) => {
            console.log(error.response.data);
        });
    },
    data(){
        return{
            title: 'Editar usuario:',
            user:[],
            message:[{
                message_1:'',
                message_2:'',
                message_3:''
            }]
        }
    },
    computed:{
        getUser(){
            return this.user;
        },
        getError(){
            return this.message[0];
        }
    },
    methods:{
        update_user(){
            if(this.validate()){
                axios.post('/update_user', { id:this.user.id, type:this.user.type, name: this.user.name, name_last: this.user.name_last, email: this.user.email, password: this.user.password}).then((res) => {
                // console.log(res);
                // console.log('saved update');
            }, function (error) {
                console.log(error.response.data); 
                });
            }
        },
        validate(){
        this.getError.message_error_1='';
        this.getError.message_error_2='';
        this.getError.message_error_3='';
        var flag=true;
        if (this.user.name==='') {
          this.getError.message_error_1= "El nombre no puede estar vacío";
          flag= false;
        } 
        if (this.user.email==='') {
          this.getError.message_error_2= " El email no puede estar vacío";
          flag= false;
        }
        if (this.user.password==='') {
          this.getError.message_error_3= " La contraseña no puede estar vacía"
          flag= false;
        }
        return flag;
      }
    }
}
</script>

<style>
#rol, option {
    background: none;
    border: 1px solid #AB8A62;
    border-radius: 4px;
    padding: 2px 10%;
    text-align: start;
}
option{
    background: #ECE5E9;
}
</style>
