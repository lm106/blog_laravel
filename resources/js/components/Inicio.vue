<template>

    <div class="back">

        <div class="content">


            <div>
                    <button class="btn btn-secondary dropdown-toggle filter" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="\images\filtre.png" alt="filter" class="image_filter">
                        Filtrar recetas
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" @click="getFilter('harina')">
                            Sin gluten
                        </li>

                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" @click="getFilter('huevo')">
                            Sin huevo
                        </li>

                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" @click="getFilter('leche')">
                            Sin lactosa
                        </li>

                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" @click="getFilter('azúcar')">
                            Sin azúcar
                        </li>
                    </ul>

                   
                </div>

                <br>



            <div class="container_fluid_new">
                <div v-for="id in getIds" :receta="id">
                    <receta class="receta" :receta="id"></receta>
                </div>
            </div> 
        </div>

        
          
    </div>
        
</template>

<script>
    import axios from 'axios'
    import receta from './Receta.vue'

export default {
    components: {receta},
    beforeCreate() {
        var vm = this
        axios.get('/recetas')
            .then(res => { 
                vm.original = res.data,
                vm.ids = res.data
            }, 
            (error) => {
                console.log(error.response.data);
            })
    },

    data() {
        return { 
            ids: [], 
            original: []
        }
    },

    computed: {
        getIds() {
            return this.ids;
        }
    },

    methods: {
        getPosts() {
        },

        getFilter(filtro) {
            let array = [];
            for (let index = 0; index < this.ids.length; index++) {
                let receta = this.ids[index];
                if (!receta.ingredients.includes(filtro)) {
                    array.push(receta);
                }
                
            }

            /**
             // siendo "miElementoCheckbox" el id del input checkbox
            var miCheckbox = document.getElementById('miElementoCheckbox');
            var msg = document.getElementById('msg');

            alert('El valor inicial del checkbox es ' + miCheckbox.checked);

            miCheckbox.addEventListener('click', function() {
                if(miCheckbox.checked) {
                msg.innerText = 'El elemento está marcado';
                } else {
                msg.innerText = 'Ahora está desmarcado';
                }
            });

             * **/

            this.ids = array;
            console.log(this.ids);


            
        }
    }
}


</script>



<style>
    .receta {
        width: 18rem;
        margin-right: 1rem;
        margin-bottom: 1rem;
    }
    
    .content {
        margin: 6rem;
    }

    .filter {
        background-color: white;
        color: rgb(0, 0, 0);
        font: bold;
    }
    .image_filter {
        width: 1rem;
        height: 1rem;
    }
    
</style>