<template  >

    
    <div class="myTable" style=" width: 85%; margin: 8rem auto;">
        <div class="form-inline my-2 my-lg-0 ">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
            style="margin-bottom:15px">Nueva receta</button>
            <input class="form-control mr-sm-2" id="search_user" type="text" v-model="search_recipe"
                placeholder="Buscar receta..." aria-label="Search">
        </div>
        <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva receta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="newRecipe" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="recipe-title" class="col-form-label">Título:</label>
                                <input type="text" class="form-control" id="recipe-title" v-model="recipe.title">
                            </div>
                            <div class="mb-3">
                                <label for="recipe-description" class="col-form-label">Descripción:</label>
                                <textarea rows="10" class="form-control" id="recipe-description"
                                    v-model="recipe.description" style="resize:vertical"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="recipe-ingredients" class="col-form-label">Ingredientes:</label>
                                <textarea placeholder="Introducir ingredientes separados por comas" rows="6"
                                    class="form-control" id="recipe-ingredients" v-model="recipe.ingredients"
                                    style="resize:vertical"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Imagen:</label>
                                <input class="form-control" type="file" id="formFile" accept=".jpeg,.png,.jpg,.svg"
                                    name="image" v-on:change="onChange" ref="file">
                            </div>

                            <label for="recipe-title" class="col-form-label">Etiquetas:</label> <br>

                            <div class="btn-group mb-5" role="group" aria-label="Basic checkbox toggle button group"
                                id="tags">

                                <input type="checkbox" class="btn-check" id="featured" value="#Destacadas"
                                    autocomplete="off" v-model="checkedTags">
                                <label class="btn btn-outline-primary" for="featured">#Destacadas</label>

                                <input type="checkbox" class="btn-check" id="glutenFree" value="#Sin gluten"
                                    autocomplete="off" v-model="checkedTags">
                                <label class="btn btn-outline-primary" for="glutenFree">#Sin gluten</label>

                                <input type="checkbox" class="btn-check" id="eggFree" value="#Sin huevo"
                                    autocomplete="off" v-model="checkedTags">
                                <label class="btn btn-outline-primary" for="eggFree">#Sin huevo</label>

                                <input type="checkbox" class="btn-check" id="lactoseFree" value="#Sin lactosa"
                                    autocomplete="off" v-model="checkedTags">
                                <label class="btn btn-outline-primary" for="lactoseFree">#Sin lactosa</label>

                                <input type="checkbox" class="btn-check" id="btncheck5" value="#Sin azúcar"
                                    autocomplete="off" v-model="checkedTags">
                                <label class="btn btn-outline-primary" for="btncheck5">#Sin azúcar</label>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button submit" class="btn btn-primary">Guardar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Título</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Ingredientes</th>
                    <th scope="col">Etiquetas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <!-- <th scope="col">Likes</th> -->
                </tr>
            </thead>
            <tbody v-if="search!='not'">
                <tr v-for="(r,index) in search" :key='r'>
                    <td scope="row">{{ r.id }}</td>
                    <td scope="row">{{ r.title }}</td>
                    <td scope="row"><img v-bind:src="r.image" width="100" height="100" /></td>
                    <td scope="row">{{ r.short_description }}</td>
                    <td scope="row">{{ r.short_ingredients }}</td>
                    <td scope="row">{{ r.tags }}</td>
                    <td scope="row">
                        <router-link :to="{ name: 'recipe_description', params: { id: r.id } }">
                            <button style="border:none; background-color:transparent">
                                <i class="bi bi-info-circle-fill" style="color:blue"></i></button>
                        </router-link>
                    </td>
                    <td scope="row"><button @click="editRecipe(r.id)"
                            style="border:none; background-color:transparent"><i class="bi bi-pencil-fill"></i></button>
                    </td>
                    <td scope="row"><button style="border:none; background-color:transparent"  data-bs-toggle="modal" data-bs-target="#deleteModal" ><i
                                class="bi bi-trash3-fill" style="color:red"></i></button></td>

                    <!-- Modal delete recipe -->
                    <div class="modal fade " id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Borrar receta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro de eliminar la receta?
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button @click="deleteRecipe(r.id,index)" type="button submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </div>
                    </div>

                </tr>
            </tbody>
        </table>
        <div class="alert alert-secondary" id="alert_search" v-if="search=='not'"> ¡Ups! No hay recetas con ese titulo. ¡Intentálo de nuevo!</div>


    </div>
</template>
<script>

export default {
    el: '#tags',

    beforeCreate() {

        axios.get('/recetas')
            .then(res => {
                this.recipes = res.data
                for (var i = 0; i < this.recipes.length; i++) {
                    this.recipes[i].short_description = this.shortString(this.recipes[i].description)
                    this.recipes[i].short_ingredients = this.shortString(this.recipes[i].ingredients)

                }
            }),
            axios.get(`/profile/`).then(res => {
                this.user = res.data;
            },
                (error) => {
                    console.log(error.response.data);
                })


    },


    data() {

        return {
            image: "",
            recipes: [],
            recipe: [
                {
                    title: '',
                    image: '',
                    image_path: '',
                    ingredients: '',
                    description: '',
                    short_description: '',
                    short_ingredients: '',
                    user_id: ''
                }],
            user: [],
            loggedUser: "",
            checkedTags: [],
            search_recipe:''



        }

    },
    computed: {
        getUser() {
            return (this.user[0]) ? this.user[0] : this.user;
        },
        search(){
            if(this.search_recipe){
                var recipe=[];
                var recipes_search = [];
                for (let i = 0; i < this.recipes.length; i++) {
                    recipe = this.recipes[i];
                    if(recipe.title.toLowerCase()==this.search_recipe.toLowerCase() || recipe.title.toLowerCase().includes(this.search_recipe.toLowerCase()) ){
                        recipes_search.push(recipe);
                    }                     
                }
                return (recipes_search.length>0)? recipes_search : 'not';
            }else{
                return this.recipes;
            }
        }
    },
    methods: {
        onChange() {
            this.image = this.$refs.file.files[0];
            this.image_path = 'images/' + this.image.name
        },

        deleteRecipe(id,index){
            console.log("entra")
                axios.post(`/delete_recipe/${id}`)
            .then((res) => {
                window.location.href = "/recipes_manager"
            }, 
            (error) => {
                console.log(error.response.data);
            });

        },

        newRecipe() {
            this.checkIfExistImage()
            const formData = new FormData()
            formData.append('image', this.image)
            formData.append('image_path', this.image_path)
            formData.append('title', this.recipe.title)
            formData.append('description', this.recipe.description)
            formData.append('ingredients', this.recipe.ingredients)
            formData.append('user_id', this.getUser.id)
            formData.append('tags', this.checkedTags)
            const headers = { 'Content-Type': 'multipart/form-data' };
            axios.post('/new_recipe', formData).then(() => {
                console.log('saved');
                window.location.href = "/recipes_manager";
                console.log(this.recipe[0].description)
            }, function (error) {
                console.log(error.response.data);

            });
        },

        shortString(string) {
            if (string.length >= 100) {
                return string.substring(0, 100) + "..."
            } else {
                return string
            }
        },

        checkIfExistImage() {
            if (this.image == "") {
                this.image_path = "images/undefined.jpeg"
            }
        },
        editRecipe(id) {
            window.location.href = `/edit_recipe/${id}`
        }




    }
}
</script>
<style>
/* .btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary, .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
    color: #fff;
    background-color: #AB8A62;
    border-color: #AB8A62;
}
.btn-outline-primary {
    color: #AB8A62;
    border-color: #AB8A62;
}

.btn-outline-primary:hover {
  color: #fff;
  background-color: #AB8A62;
  border-color: #AB8A62;
} */
.btn-check:checked+.btn-outline-primary:focus,
.btn-check:active+.btn-outline-primary:focus,
.btn-outline-primary:active:focus,
.btn-outline-primary.active:focus,
.btn-outline-primary.dropdown-toggle.show:focus {
    box-shadow: none;
}

.btn-check:focus+.btn-outline-primary,
.btn-outline-primary:focus {
    box-shadow: none;
}
</style>