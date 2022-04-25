<template  >
  <div class="myTable" style=" width: 85%; margin: 8rem auto;">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-bottom:15px">Nueva receta</button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva receta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="newRecipe">
                        <div class="mb-3">
                            <label for="recipe-title" class="col-form-label">Título:</label>
                            <input type="text" class="form-control" id="recipe-title" v-model="recipe.title">
                        </div>
                        <div class="mb-3">
                            <label for="recipe-description" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="recipe-description" v-model="recipe.description"></textarea>
                        </div>
                        <div class="mb-5">
                            <label for="recipe-ingredients" class="col-form-label">Ingredientes:</label>
                            <textarea class="form-control" id="recipe-ingredients" v-model="recipe.ingredients"></textarea>
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


    <table class="table" >
        <thead >
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Título</th>
            <th scope="col">Descripción</th>
            <th scope="col">Ingredientes</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <!-- <th scope="col">Likes</th> -->
            </tr>
        </thead>
        <tbody  >
            <tr v-for="(r) in recipes" :key='r' >
                <td scope="row">{{r.id}}</td>
                <td scope="row">{{r.title}}</td>
                <td scope="row">{{r.description}}</td>
                <td scope="row">{{r.ingredients}}</td>
                <td scope="row"><button style="border:none; background-color:transparent"><i class="bi bi-pencil-fill" ></i></button></td>
                <td scope="row"><button style="border:none; background-color:transparent"><i class="bi bi-trash3-fill" style="color:red"></i></button ></td>
            
            </tr>
        </tbody>
        </table>

</div>
</template>
<script>

export default {
   
  

   beforeCreate() {

        axios.get('/recetas')
        .then(res => { 
            this.recipes = res.data
        }),

        
    
        axios.get(`/profile/`).then(res => {
            this.user = res.data;//Recoger los datos del usuario en la session
        },
        (error) => {
            console.log(error.response.data);
        })
       
        
    },
    

    data() {
        
        return { 
            recipes: [],
            recipe: [
                {title: '',
                image: '',
                ingredients: '',
                description: '',
                user_id: ''
                }],
            user: [],
            loggedUser: ""
            
            
            
        }
        
    },

    methods: {
        newRecipe(){
            axios.post('/new_recipe', {title: this.recipe.title, image: "", description: this.recipe.description, ingredients: this.recipe.ingredients, user_id: this.user[0].id}).then(() => {
            console.log('saved');
            window.location.href="/recipes_manager";
            console.log(this.recipe[0])
          }, function (error) {
            console.log(error.response.data); 
            
        });
        },
        test(){
           console.log(this.user[0].id)
        },

    }
}
</script>
