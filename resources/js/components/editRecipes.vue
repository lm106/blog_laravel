<template>
    <div style="margin: 6rem auto;" class="w-50">
        <form @submit.prevent="editRecipe" enctype="multipart/form-data">
            <div>
                <label for="recipe-title" class="col-form-label">
                    <h3> Titulo:</h3>
                </label>
                <input type="text" class="form-control" id="recipe-title" v-model="recipe.title">
            </div>
            <div>
                <label for="recipe-title" class="col-form-label">
                    <h3> Descripción:</h3>
                </label>
                <textarea rows="10" class="form-control" id="recipe-description" v-model="recipe.description" style="resize:vertical"></textarea>
            </div>
            <div>
                <label for="recipe-title" class="col-form-label">
                    <h3> Ingredientes:</h3>
                </label>
                <textarea rows="10" class="form-control" id="recipe-ingredients" v-model="recipe.ingredients" style="resize:vertical"></textarea>
            </div>
            <div>
                <label for="formFile" class="form-label">
                    <h3> Imagen:</h3>
                </label>
                <input class="form-control" type="file" id="formFile" accept=".jpeg,.png,.jpg,.svg" name="image"
                    v-on:change="onChange" ref="file" placeholder="hola">
            </div>
            <label for="recipe-title" class="col-form-label">
                <h3>Etiquetas:</h3>
            </label> <br>
            <div class="btn-group mb-5" role="group" aria-label="Basic checkbox toggle button group" id="tags">
                
                <input type="checkbox" class="btn-check" id="glutenFree" value="#Sin gluten" autocomplete="off" v-model="checkedTags">
                <label class="btn btn-outline-primary" for="glutenFree">#Sin gluten</label>

                <input type="checkbox" class="btn-check" id="eggFree" value="#Sin huevo" autocomplete="off" v-model="checkedTags">
                <label class="btn btn-outline-primary" for="eggFree">#Sin huevo</label>

                <input type="checkbox" class="btn-check" id="lactoseFree" value="#Sin lactosa" autocomplete="off" v-model="checkedTags">
                <label class="btn btn-outline-primary" for="lactoseFree">#Sin lactosa</label>

                <input type="checkbox" class="btn-check" id="btncheck5" value="#Sin azúcar" autocomplete="off" v-model="checkedTags">
                <label class="btn btn-outline-primary" for="btncheck5">#Sin azúcar</label>
            </div>
            <div class="text-center">
                <button type="button submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

</template>

<script>
export default {
    props: ['id'],
    data() {
        return {
            recipe: [],
            image: "",
            image_path:"",
            user_id: null,
            checkedTags: [],
            destacada: false,
            gluten: false,
            huevo: false,
            lactosa: false,
            azucar: false,
        }
    },
    beforeCreate() {
        
        axios.get(`/receta/${this.id}`)
            .then(res => {
                this.recipe=res.data[0]
                 if(this.recipe.tags!==null){
                    this.checkedTags = this.recipe.tags.split(',')  
                }
                this.getUserID()
                console.log(this.recipe)
            })
        

    },
    methods: {
        getUserID() {
            axios.get('/profile').then(res => {
                this.user_id = res.data[0].id
            })
        },
        editRecipe() {
            const formData = new FormData()
            
            console.log(this.recipe.image)
            formData.append('image', this.image)
            formData.append('image_path', this.recipe.image)
            formData.append('title', this.recipe.title)
            formData.append('description', this.recipe.description)
            formData.append('ingredients', this.recipe.ingredients)
            formData.append('tags', this.checkedTags)
            formData.append('user_id', this.user_id)
            formData.append('id', this.id)
            const headers = { 'Content-Type': 'multipart/form-data' };
            axios.post('/edit_recipe', formData).then(res => {
                console.log(res.data)
                window.location.href = "/recipes_manager";
            }, function (error) {
                console.log(error.response.data);
            });
        },

        onChange() {
            this.image = this.$refs.file.files[0];
            console.log(this.image)
            this.recipe.image = 'images/' + this.image.name
        },

    }
}
</script>
