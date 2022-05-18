<template>

    <div class="back">

        <div class="content">


            <div>
                    <button class="btn btn-secondary dropdown-toggle filter" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="\images\filtre.png" alt="filter" class="image_filter">
                        Filtrar recetas
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="z-index:0;">
                        <li class="list-group-item list-group-item_new">
                            <input class="form-check-input me-1" type="checkbox" id="destacada" @click="getFilter('destacada')">
                            Destacadas
                        </li>

                        <li class="list-group-item list-group-item_new">
                            <input class="form-check-input me-1" type="checkbox" id="#Sin gluten" @click="getFilter('#Sin gluten')">
                            Sin gluten
                        </li>

                        <li class="list-group-item list-group-item_new">
                            <input class="form-check-input me-1" type="checkbox" id="#Sin huevo" @click="getFilter('#Sin huevo')">
                            Sin huevo
                        </li>

                        <li class="list-group-item list-group-item_new">
                            <input class="form-check-input me-1" type="checkbox" id="#Sin lactosa" @click="getFilter('#Sin lactosa')">
                            Sin lactosa
                        </li>

                        <li class="list-group-item list-group-item_new">
                            <input class="form-check-input me-1" type="checkbox" id="#Sin azúcar" @click="getFilter('#Sin azúcar')">
                            Sin azúcar
                        </li>
                    </ul>

                   
                </div>

                <br>

            <div class="container_fluid_new">
                <div v-for="id in getIds" :receta="id">
                    <receta class="receta" :receta.sync="id"></receta>

                </div>

             </div> 
        </div>

        
          
    </div>
        
</template>

<script>
    import { thisTypeAnnotation } from '@babel/types'
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
            original: [], 
            alergenos: []
        }
    },

    computed: {
        getIds() {
            return this.ids;
        }
    },

    methods: {
        getFilter(filtro) {
            if (filtro == 'destacada') {
                if (document.getElementById(filtro).checked) {
                    document.getElementById('#Sin gluten').checked = false;
                    document.getElementById('#Sin huevo').checked = false;
                    document.getElementById('#Sin lactosa').checked = false;
                    document.getElementById('#Sin azúcar').checked = false;

                     // miramos el num de likes y commentarios de la receta
                    axios.get('/recipes_likes')
                        .then(respo => {
                            this.ids = [];

                            let array = respo.data;
                            for (let index = 0; index < array.length; index++) {
                                
                                if (index > 0 && array[index].id == array[index-1].id) {
                                    this.ids[0].n_likes++;

                                } else {
                                    this.ids.unshift(array[index]);
                                }                      
                            }

                                this.ids.sort((a, b) => {
                                    if(a.n_likes < b.n_likes) {
                                        return 1;
                                    }
                                    if(a.n_likes > b.n_likes) {
                                        return -1;
                                    }
                                    return 0;
                                    });
                        }, 
                        (error) => {
                            console.log(error.response.data);
                        });

                    


                } else {
                    this.ids = this.original;
                }
               

            } else {
                if (document.getElementById('destacada').checked) {
                    this.ids = this.original;
                    document.getElementById('destacada').checked = false;
                }
  
                if (document.getElementById(filtro).checked) {
                    this.alergenos.push(filtro);

                    let array = [];
                    for (let index = 0; index < this.ids.length; index++) {
                        let receta = this.ids[index];
                        if (receta.tags != null && receta.tags.includes(filtro)) {
                            array.push(receta);
                        }
                        
                    }
                    this.ids = array;

                } else {
                    let id_check = this.alergenos.indexOf(filtro);
                    this.alergenos.splice(id_check, 1);

                    let array = [];
                    let index_id = 0;
                    for (let index = 0; index < this.original.length; index++) {
                        let receta = this.original[index];

                        if (this.ids.length == 0) {
                            array.push(receta);

                        } else if (this.ids[index_id].id == receta.id){
                            array.push(receta);

                        } else {
                            if(this.alergenos.length == 0) {
                                array.push(receta);
                                
                            } else {
                                for(let i = 0; i < this.alergenos.length; i++) {
                                    console.log('hola');
                                    if (receta.tags == null || !receta.tags.includes(this.alergenos[i])) {
                                        break;
                                    } else if (i == this.alergenos.length -1) {
                                        array.push(receta);
                                    }
                                }
                            }

                            if(index_id != this.ids.length) {
                                index_id--;
                            }
                        }

                        if(index_id != this.ids.length -1) {
                            index_id++;
                        }
                    }

                    this.ids = array;
                }
            }
            
        }
    }
}


</script>



<style>
    .list-group-item_new {
        border: transparent;
    }

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