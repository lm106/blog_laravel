<template>
    <div>
        <div class="section" v-if="getUser">
            <h2 class="titulo title_list"> {{ title }} </h2>
            <!--######### Crear una nueva lista########-->
            <button type="button" class="btn btn_create" id="btn_create_list" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Crear lista privada
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva lista privada</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="create_list">
                                <div class="mb-3">
                                    <label for="recipe-title" class="col-form-label">Nombre de la lista:</label>
                                    <!-- <input type="text" class="form-control" id="recipe-title" v-model="list_private.name"> -->
                                    <input type="text" class="form-control" v-model="create_list_name" id="">
                                </div>
                                <!-- <div class="modal-footer"> -->
                                    <button type="submit" class="btn btns_create" id="btn_save">Crear lista</button>
                                    <button type="button" class="btn btns_create btn_create" data-bs-dismiss="modal">Cancelar</button>

                                <!-- </div> -->
                            </form>
                            <p class="success">{{message_error}}</p>
                        </div>
                        </div>
                </div>
            </div>
            <!--########################################-->

            <table class="table content_list">
            <thead>
                <tr>
                <th scope="col">Lista</th>
                <th id="column_list" scope="col">N&#176;&nbsp;recetas</th>
                <th class="btn_table" id="col_options" scope="col">Opciones</th>

                </tr>
            </thead>
            <tbody v-if="lists_private">
                <tr v-for=" (list, index) in lists_private" :key='list'>
                    <td scope="row"><router-link :to="{name: 'list_private', params: {name_list: list.name}}" >{{list.name}}</router-link></td>
                    
                    <td scope="row" v-if="list.n_recetas == 1"> {{list.n_recetas}} receta </td>
                    <td scope="row" v-if="list.n_recetas > 1"> {{list.n_recetas}} recetas </td>
                    <td scope="row" v-if="list.n_recetas == 0"> No tiene recetas </td>
                    <td scope="row">
                        <div class="dropdown top-0 end-0 " id="options" >
                            <!-- <a class="d-block dropdown-toggle options" id="submenu" data-bs-toggle="dropdown" aria-expanded="{{flag}}">
                                <svg class="points"><circle cx="50%" cy="50%" r="2" fill="grey" stroke="grey" /></svg>
                                <svg class="points"><circle cx="50%" cy="50%" r="2" fill="grey" stroke="grey" /></svg>
                                <svg class="points"><circle cx="50%" cy="50%" r="2" fill="grey" stroke="grey" /></svg>
                            </a>
                            <ul class="dropdown-menu text-small dropdown-menu-end menu_desplegable">
                                <li><router-link class="dropdown-item"  :to="{name: 'edit_list_private', params: {name_list: list.name}}" style="color:#AB8A62; font-weight:bold;">
                                        <i class="bi bi-pencil-fill" style="color:#AB8A62"></i> Editar
                                    </router-link>
                                </li>
                                <li><button @click="delete_list(list.name, index)" class="dropdown-item" style="color:red; font-weight:bold;">
                                        <i class="bi bi-trash3-fill" style="color:red"></i>Eliminar
                                    </button>
                                </li>
                            </ul> -->
                            <router-link class="dropdown-item"  :to="{name: 'edit_list_private', params: {name_list: list.name}}" style="color:#AB8A62; font-weight:bold;">
                                <i class="bi bi-pencil-fill" style="color:#D5888D"></i>
                            </router-link>
                            <button @click="delete_list(list.name, index)" class="dropdown-item" style="color:red; font-weight:bold;">
                                <i class="bi bi-trash3-fill" style="color:red"></i>
                            </button>
                        </div>
                    </td>
                    <!-- <td scope="row"><a class="btn_edit_delete"><i class="bi bi-trash3-fill" style="color:red"></i></a></td> -->
                </tr>
            </tbody>
            <div v-else class="alert alert-secondary content_list" style="text-align:center;" role="alert">
                ¡Ups! No tienes listas privadas. Creáte una lista.
            </div>
            </table>
        </div>
        <div v-else>

        </div>
        
    </div>
</template>

<script>
export default {
    beforeCreate(){
        axios.get('/lists').then(res => {
            this.lists_private = res.data;
            // console.log(res);
        },
        (error) => {
            console.log(error.response.data);
        });
        axios.get('/profile').then(res => {
            this.user = res.data;
            // console.log(res);
            // console.log(this.user);

        },
        (error) => {
            console.log(error.response.data);
        });
    },
    name: 'lists_private',
    data(){
        return {
            title:'Listas privadas',
            lists_private:[],
            user:[],
            create_list_name:'',
            message_error:'',
            flag:false
        }
    },
    computed:{
        getUser(){
            return (this.user[0])?this.user[0]: this.user;
        }
    },
    methods:{
        create_list(){
            this.message_error='';
            var vm= this;
            if(vm.create_list_name!=''){
                axios.post('/create_list', {name:this.create_list_name, user_id: this.getUser.id}).then(res => {
                    console.log(res);
                    if(res.data !='not'){
                        var list_new= (res.data[0])? res.data[0]:res.data;
                        vm.lists_private.push(list_new);
                        window.location.href="/lists_private";
                    }else{
                        vm.message_error="Este nombre ya existe";
                    }
                },
                (error) => {
                    console.log(error.response.data);
                });

            } else{
                this.message_error='No puedes crear una lista con el nombre vacio';
            }
        },
        delete_list(name, i){
            axios.get(`/delete_list/${name}`).then(res => {
                this.lists_private.splice(i,1);
            },
            (error) => {
                console.log(error.response.data);
            });
        }
    }
}
</script>

<style>
.options::after{
    content: none;
}
.options{
    float:right;
    width: 40px;
    text-align: center;
    margin-left: 20px;
}
#col_options{
    text-align: center;
}
#options{
    display: inline-flex;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
    position: unset;
}
.points{
    display: block;
    width: 100%;
    height:0.5rem;
    text-align: center;
}
.menu_desplegable{
    min-width: 5rem;
}
.content_list{
    width:90%;
    margin:20px auto;
}
.column_list{
    width:20%;
}
.title_list{
    margin-left:5%;
    float:left;
}
/* Botón 'Creaar nueva lista' */
#btn_create_list{
    float: right;
    margin: 0px 90px 10px;
}
/* Botón 'Creaar nueva lista' y 'Cancerlar' (del dialogo) */
.btn_create, .btn_create:focus, .btn_create:active{
    background: #D5888D;
    color:white;
    box-shadow: none;
    display: block;
}
/* Botón 'Creaar nueva lista' y 'Cancelar' (del dialogo) */
.btn_create:hover, #btn_save:hover{
    color:white;
    background: #81a1b0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.btns_create{
    margin:0px;
    float:right;
}
/* Botón 'Crear lista' */
#btn_save, #btn_save:focus, #btn_save:active{
    background: #D5888D;
    color: white;
    box-shadow: none;
    margin-left: 5px;
}

</style>