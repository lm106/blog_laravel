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
                    <form>
                        <div class="mb-3">
                            <label for="recipe-title" class="col-form-label">Título:</label>
                            <input type="text" class="form-control" id="recipe-title">
                        </div>
                        <div class="mb-3">
                            <label for="recipe-description" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="recipe-description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="recipe-ingredients" class="col-form-label">Ingredientes:</label>
                            <textarea class="form-control" id="recipe-ingredients"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
                </div>
            </div>
        </div>


    <table class="table" style="background-color:#ECE5E9">
        <thead style="background-color:black; color:white">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Título</th>
            <th scope="col">Descripción</th>
             <th scope="col">Ingredientes</th>
            <!-- <th scope="col">Likes</th> -->
            </tr>
        </thead>
        <tbody v-for="(recipe) in recipes" :key='recipe'>
            <tr>
            <th scope="row">{{recipe.id}}</th>
            <td>{{recipe.title}}</td>
            <td>{{recipe.description}}</td>
            <td>{{recipe.ingredients}}</td>
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
                console.log(res.data[0].id)
                this.recipes = res.data
            }) 
            
    },

    data() {
        return { 
            recipes: []
            
        }
    },
}
</script>
