<template  >
  <div class="myTable" style=" width: 85%; margin: 8rem auto; background-color:#ECE5E9">
    <table class="table">
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
