<template>
  <div class="section_form">
        <!-- <h2> {{ title }}&nbsp;{{ user.name }}</h2> -->
        <!-- <ul class="success">
            <li v-if="getError.message_1">{{ getError.message_1 }}</li>
            <li v-if="getError.message_2">{{ getError.message_2 }}</li>
        </ul>
        <form  class='form_edit_signup' @submit.prevent="update()">
        <div id='input_data'>
            <label>Nombre:</label><br>
            <input type="text" v-model="ser.name"/><br>
            <label>Apellidos:</label><br>
            <input type="text"  v-model="user.name_last"/><br>
            <label>Email:</label><br>
            <input type="email" readonly v-model="user.email"/><br>
            <label >Password:</label><br>
            <input type="password"  v-model="user.password"/><br>
        </div>
        <input type="submit"  id="update" value="Actualizar datos">
        </form> --> 
        <!-- <p>{{ user }}</p> -->
        <router-link to="/admin_list">Volver atrás</router-link>
    </div>
</template>

<script>
import profile from '../profile.vue'
export default {
    name:'editUser',
    component: profile,
    data(){
        return{
            title: 'Editar usuario:',
            user:[],
            message:[{
                message_1:'',
                message_2:''
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
        update(){
            console.log(this.validate());
            console.log("eh estoy en update");
        },
        validate(){
            profile.methods.validate();
        }
    }
}
</script>

<style>

</style>