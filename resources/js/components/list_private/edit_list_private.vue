<template>
    <div class="section">
      <router-link class="btn btn_back" to="/lists_private">Volver atrás</router-link>
        <div class="container_fluid_new">      
            <form id="list_recipe" @submit.prevent="save_List()">
                <input type="submit" value="Guardar lista"/><br>
                <input class="form-control mr-sm-2" id="name_list" type="text" v-model="name_list" aria-label="Search">
                <table class="table content_list">
                    <thead>
                        <tr>
                        <th class="btn_table" scope="col" style="padding-right:15px;">Seleccionar</th>
                        <th scope="col">Titulo de la receta</th>
                        <th id="column_list" scope="col">Descripción:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="recipe in getList" :key="recipe">
                            <td scope="row" style="text-align:center;"><input type="checkbox" @click="setSelectRecipe(recipe.id)"/></td>
                            <td scope="row"><router-link  :to="{name: 'recipe_description', params: {id: recipe.id}}">{{recipe.title}}</router-link></td>
                            <td scope="row">{{getDes(recipe.description)}}</td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="list_private.length==0" class="alert alert-secondary content_list" style="text-align:center;" role="alert">
                    ¡Ups! No tienes recetas en esta lista
                </div>
                    
            </form>
            <form id="form_delete_recipe" @submit.prevent="delete_recipes()">
            <button type="submit" class="btn" id="delete_recipe">
                <i class="bi bi-trash3-fill" style="color:white"></i>&nbsp;Quitar recetas
            </button>
            </form>
        </div> 
    </div>
</template>

<script>
export default {
    props:['name_list'],
    beforeCreate(){
        axios.get(`/list_recipe/${this.name_list}`).then(res => {
            this.list_private = res.data;
            // console.log(res);
        },
        (error) => {
            console.log(error.response.data);
        });
    },
    data(){
        return {
            list_private:[],
            select_recipes:[]
        }
    },
    computed:{
        getList(){
            return this.list_private;
        }
    },
    methods:{
        getDes(des){
            if(des.length>100){
                return des.substr(0,100) + '...';
            }else {
                return des;
            }

        },
        setSelectRecipe(recipe_id){
            if(!this.select_recipes.includes(recipe_id)){   
                this.select_recipes.push(recipe_id);
            }else{
                let i=this.select_recipes.indexOf(recipe_id);
                this.select_recipes.splice(i, 1);
            }
        },
        save_List(){
            console.log("save");
        },
        delete_recipes(){
            console.log(this.select_recipes);
        }
    }
}
</script>

<style>
#list_recipe{
    width:95%;
    margin-top: 10px;
}
#list_recipe input[type=submit] {
    background: #D5888D;
    float: right;
    border: none;
    color: white;
    padding: 5px 25px;
}
#name_list {
    width: 30%;
    margin-left: 5%;
}
#form_delete_recipe{
    text-align: end;
    flex: auto;
    width: 20%;
    margin-right: 2.5%;
}
#delete_recipe,#delete_recipe:hover, #delete_recipe:focus, #delete_recipe:active, #delete_recipe:visited {
    background: #e01919;
    color:white;
    box-shadow: none;
    cursor: default;
}
#delete_recipe[type=submit]:not(disabled){
    cursor: default;    
}
.btn_back, .btn_back:focus{
    background: #ab8a62;
    color: white;
    margin-left: 5%;
}
.btn_back:hover{
    color:white;
    background: #81a1b0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

</style>