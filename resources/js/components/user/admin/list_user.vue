<template>
  <div class="section">
      <h2>{{title}}</h2>
      <table class="table" id="content_table" >
        <thead>
            <tr>
            <th scope="col"></th>
            <th scope="col">Nombre</th>
            <th id="rol_column" scope="col">Tipo de usuario</th>
            <th class="btn_table" scope="col"></th>
            <th class="btn_table" scope="col"></th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key='user' >
                <td scope="row">{{user.photo}}</td>
                <td scope="row">{{user.name}}</td>
                <td scope="row" v-if="user.type==1">Administrador</td>
                <td scope="row" v-if="user.type!=1">Usuario registrado</td>
                <td scope="row"> <router-link :to="{name: 'edit_user', params: {id: user.id}}" class="btn_edit_delete">
                    <i class="bi bi-pencil-fill" ></i></router-link></td>
                <td scope="row"><a class="btn_edit_delete"><i class="bi bi-trash3-fill" style="color:red"></i></a></td>
            
            </tr>
        </tbody>
        </table>

  </div>
</template>

<script>
export default {
    beforeCreate() {
        var vm=this;
        axios.get('/admin_list').then(res => {
            vm.users = res.data;
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
            users:[]
        }
    }
}
</script>

<style>
.section{
    margin-top:5rem;
}
#content_table{
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
</style>