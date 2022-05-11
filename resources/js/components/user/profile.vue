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
            <input type="file" class="mb-3" accept=".jpeg,.png,.jpg,.svg" name="photo" @change="onChange" ref="file"/>
            <div class="avatar-container mb-3">
                <img v-bind:src="imagePreview" width="102" height="102" v-show="showPreview" class="rounded-circle" /> 
            </div>
            <input type="submit"  class="update mb-3" value="Actualizar datos">
        </div>
        
        </form>
        <form @submit.prevent="delete_user()">
            <input type="submit"  class="update" id="delete" value="Eliminar mi cuenta">
        </form>

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
            avatar: '',
            avatar_path:'',
            title: 'Mi Perfil',   
            user: [{
                name: '',
                name_last: '',
                email: '',
                password: '',
                id: '',
                photo: ''
            }],
            message:[{
                message_1:'',
                message_2:''
            }],
            error:'',
            imagePreview: null,
            showPreview: false,
            
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
        onChange(){
            this.avatar = this.$refs.file.files[0];
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

            this.getUser.photo = this.avatar_path

        },
        
        update(){
            this.checkIfExistImage()
            if(this.validate()){
                const formData = new FormData()

                formData.append('name',  this.getUser.name)
                formData.append('name_last', this.getUser.name_last)
                formData.append('email',  this.getUser.email)
                formData.append('password',  this.getUser.password)
                formData.append('id',  this.getUser.id)
                formData.append('type', this.getUser.type)
                if(this.avatar){
                    formData.append('photo', this.avatar)
                }
                formData.append('avatar_path',  this.getUser.photo)
                const headers = { 'Content-Type': 'multipart/form-data' };
                axios.post('/edit', formData, {headers}).then(() => {
                    console.log("updated")
                    window.location.href="/perfil";
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
    
            return flag;
        },
        delete_user(){
            axios.post('/delete', { id: this.getUser.id}).then((res) => {
                console.log(res);
           
                if(res.data) {
                    window.location.href='/';
                }else{
                    this.error="Error: No se ha podido eliminar la cuenta";
                }
            }, function (error) {
                console.log(error.response.data); 
            });
        },
        checkIfExistImage(){
            if(this.photo == ""){
                this.avatar_path = "images/default-avatar.jpeg"
            }
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