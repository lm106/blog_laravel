<template>
    <div class="section_form">
        <h2> {{ title }}</h2>
        <ul class="success">
            <li v-if="getError.message_1">{{ getError.message_1 }}</li>
            <li v-if="getError.message_2">{{ getError.message_2 }}</li>
        </ul>
        <form  class='form_edit_signup' @submit.prevent="update()">
        <!-- <img> -->
        <div id='input_data'>
            <label>Nombre:</label><br>
            <input type="text" v-model="getUser.name"/><br>
            <label>Apellidos:</label><br>
            <input type="text"  v-model="getUser.name_last"/><br>
            <label>Email:</label><br>
            <input type="email" readonly v-model="getUser.email"/><br>
            <label >Password:</label><br>
            <input type="password"  v-model="getUser.password"/><br>
        </div>
        <input type="submit"  id="update" value="Actualizar datos">
        </form>
        <!-- <p>{{ user }}</p> -->
    </div>
</template>

<script>
export default {
    beforeCreate() {
        /* Para ver todos los usuarios */
        // axios.get('/profile').then(res => {
        //     vm.user = res.data;
        //     console.log(res);
        // })
        //  console.log(this.user_id);
        axios.get('/profile').then(res => {
            this.user = res.data[0];
            // console.log(res);
            // console.log(this.user);

        },
        (error) => {
            console.log(error.response.data);
        })

        // axios.get('/profile')
        // .then(function (response) {
        //     // handle success
        //     this.user=response.data;
        //     console.log(response);
        // })
        // .then((response) => {
        //     this.user = response.data;
        // })
        // console.log("usuario:" + vm.user)
    },
    name: 'Profile',
    data() {
      return {
            title: 'Perfil',   
            user: [],
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
            console.log("---");
            console.log(this.user);
            // var user_new=this.user;
            if(this.validate()){
                axios.post('/edit', { name: this.user.name, name_last: this.user.name_last, email: this.user.email, password: this.user.password}).then((res) => {
                    // console.log(res);
                console.log('saved update');
            }, function (error) {
                console.log(error.response.data); 
                });
            }
        },
        validate(){
            console.log('he');
            this.getError.message_1='';
            this.getError.message_2='';
            var flag=true;
            if (this.getUser.name==='') {
                this.getError.message_1= "El nombre no puede estar vacío";
                flag=false;
            } 
            if (this.getUser.password==='') {
                this.getError.message_2= " La contraseña no puede estar vacía"
                flag=false;
            }
            console.log(this.message)
            return flag;
        }

    }
}
</script>

<style>
.section_form {
    width: 750px;
    left: 91px;
    top: 155px;
    margin: 5rem auto;
    background: #ECE5E9;
    padding-top: 2%;
    text-align: center;
    box-shadow: 0px 5px 5px #80808070;
}
.form_edit_signup {
    width: 40%;
    margin: 0 auto;
    text-align: start;
    color: #AB8A62;
}
#input_data input{
    padding-right: 40%;
}
#input_data label{
    margin: 5px 0px;
}
#update {
    margin: 30% 0% 10% 30%;
    background: #D5888D;
    border: none;
    padding: 5px 20px;
    color: white;
}
</style>