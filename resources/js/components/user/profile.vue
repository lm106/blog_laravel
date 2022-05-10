<template>
    <div class="section_form">
        <h2> {{ title }}</h2>
        <ul class="success">
            <li v-if="getError.message_1">{{ getError.message_1 }}</li>
            <li v-if="getError.message_2">{{ getError.message_2 }}</li>
            <li v-if="error">{{ error }}</li>
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
            <label >Avatar:</label><br>
            <input type="file" class="mb-3" accept=".jpeg,.png,.jpg,.svg" name="avatar" @change="onChange"/>
            <div class="avatar-container mb-3">
            <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/> 
            </div>
            <input type="submit"  class="update mb-3" value="Actualizar datos">
        </div>
        
        </form>
        <form @submit.prevent="delete_user()">
        <input type="submit"  class="update" id="delete" value="Eliminar cuenta">
        </form>
        <!-- <p>{{ user }}</p> -->
    </div>
</template>

<script>
export default {
  
    beforeCreate() {
        axios.get('/profile').then(res => {
            this.user = res.data;
        },
        (error) => {
            console.log(error.response.data);
        })
    },
    name: 'Profile',
    data() {
      return {
            title: 'Mi Perfil',   
            user: [],
            message:[{
                message_1:'',
                message_2:''
            }],
            error:'',
            avatar:'',
            imagePreview: null,
            showPreview: false
        }
    },
    computed:{
        getUser(){
            return (this.user[0])?this.user[0]: this.user;
        },
        getError(){
            return this.message[0];
        }
    }, 
    methods:{
        onChange(event){
            this.avatar = event.target.files[0];
            this.avatar_path = 'images/' + this.avatar.name
            let reader  = new FileReader();

            reader.addEventListener("load", function () {
                this.showPreview = true;
                this.imagePreview = reader.result;
            }.bind(this), false);

            if( this.avatar ){
                if ( /\.(jpe?g|png|gif|svg)$/i.test( this.avatar.name) ) {
                    reader.readAsDataURL( this.avatar );
                }
            }

        },
        oldonChange(){
            this.photo =this.$refs.file.files[0];
            this.photo_path = 'images/' + this.photo.name
            console.log(this.photo)
        },
        update(){
            if(this.validate()){
                axios.post('/edit', { name: this.user.name, name_last: this.user.name_last, email: this.user.email, password: this.user.password}).then((res) => {
                }, function (error) {
                    console.log(error.response.data); 
                });
            }
        },
        validate(){
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
            // console.log(this.message)
            return flag;
        },
        delete_user(){
            axios.post('/delete', { id: this.user.id}).then((res) => {
                console.log(res);
                // console.log('saved update');
                if(res.data) {
                    window.location.href='/';
                }else{
                    this.error="Error: No se ha podido eliminar la cuenta";
                }
            }, function (error) {
                console.log(error.response.data); 
            });
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

 img{
    text-align: center;
  
}
#input_data input {
    width: 100%;
}
#input_data input[type=file]{
    border:none

}

#input_data input[type=file]{
    color: black;
    
}
#input_data label{
    margin: 5px 0px;
}

.avatar-container{
    text-align: center;
}

.update {
   
    background: #D5888D;
    border: none;
    padding: 5px 20px;
    color: white;
}
#delete {
    width: 20%;
    float: right;
    margin-top: 2%;
    background: #AB8A62;
}
.success{
    color:red;
    font-weight: bold;
    list-style: none;
}
</style>