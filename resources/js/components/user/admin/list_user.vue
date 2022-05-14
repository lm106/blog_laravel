<template>
  <div class="section">
    <h2 class="titulo">{{title}}</h2>
    <div class="form-inline my-2 my-lg-0 ">  
        <input class="form-control mr-sm-2" id="search_user" type="text" v-model="search_user" placeholder="Buscar usuario..." aria-label="Search">
        <!-- {{search}} -->
    </div>   
    <table class="table content_table" >
    <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">Nombre</th>
        <th id="rol_column" scope="col">Tipo de usuario</th>
        <th class="btn_table" scope="col"></th>
        <th class="btn_table" scope="col"></th>

        </tr>
    </thead>
    <tbody v-if="search!='not'">
        <tr v-for="(user,index) in search" :key='user' >
            <td scope="row">{{user.photo}}</td>
            <td scope="row">{{user.name}}</td>
            <td scope="row" v-if="user.type==1">Administrador</td>
            <td scope="row" v-if="user.type!=1">Usuario registrado</td>
            <td scope="row"> <router-link :to="{name: 'edit_user', params: {id: user.id}}" class="btn_edit_delete">
                <i class="bi bi-pencil-fill" ></i></router-link></td>
            <td scope="row"><button style="border: none;" data-bs-toggle="modal" data-bs-target="#deleteModal"  ><i class="bi bi-trash3-fill" style="color:red"></i></button></td>
            <!-- Modal delete recipe -->
            <div class="modal fade " id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Borrar receta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar el usuario?
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button @click="deleteUser(user.id,index)" type="button submit" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
                    </div>
                </div>
            </div>
            </div>
        </tr>
    </tbody>
    </table>
    <div class="alert alert-secondary" id="alert_search" v-if="search=='not'"> ¡Ups! No hay usuarios con ese nombre. ¡Intentálo de nuevo!</div>
  </div>
</template>

<script>
export default {
    beforeCreate() {
        var vm=this;
        axios.get('/admin_list').then(res => {
            vm.users = res.data;
            vm.users_original = res.data;
            // console.log(res.data);
        },
        (error) => {
            console.log(error.response.data);
        })

    },
    name: 'list_user',
    data(){
        return {
            title: 'Usuarios registrados',
            users:[],
            search_user:''

        }
    },
    computed:{
        search(){
            if(this.search_user){
                var user=[];
                var users_search = [];
                for (let i = 0; i < this.users.length; i++) {
                    user = this.users[i];
                    if(user.name==this.search_user ||user.name.includes(this.search_user) ){
                        users_search.push(user);
                    }                     
                }
                return (users_search.length>0)? users_search : 'not';
            }else{
                return this.users;
            }
        }
    },
    
    methods:{
        deleteUser(id,index){
            console.log(id)
            axios.get(`/delete_user/${id}`).then(res => {
                if (res.data==='ok') {
                    this.users.splice(index,1)
                }
            },
            (error) => {
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
.titulo{
    margin-left:20px;
}
#search_user{
    width: 15%;
    float: right;
    margin-right: 4%;
}
.content_table{
    margin: 20px;
    width: 95%;
}
#rol_column{
    width:30%;
}
.btn_table{
    width: 10px;
}
.btn_edit_delete{
    border:none; 
    background-color:transparent
}
#alert_search{
    text-align: center;
    margin: 20px 75px 20px 20px;
}
</style>