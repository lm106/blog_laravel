<template>
    <section class="container_fluid_new">
        <div class="recipe">
            <div id="content">
                <div>
                    <div id="title"></div>
                    <h1>{{recipe.title}}</h1>
                </div>

                <div class="container">
                    <div class="row">
                            <!-- primera colimna (ingredients) -->
                        <div class="col ingredient">
                            <div class="picture_recipe" style="margin-top: 2.5rem; margin-bottom: 2.5rem;">
                                <div class="hijo">
                                    <ul v-for="ingredient in ingredients">
                                        <li><p style="font-style: italic;">{{ingredient}}</p></li>
                                    </ul>
                                </div>
                                
                            </div>
                            
                        </div>

                            <!-- Segunda columna (image) -->
                        <div class="col" style="height: 15rem; margin-bottom: 1rem;">
                            <img v-bind:src="image" class="card-img-top picture_recipe" alt="image">
                        </div>
                    </div>
                </div>
                

                <!-- description -->
                <div class="descrip">
                    <div v-for="description in descriptions">
                        <p>{{description}}</p>
                    </div>
                </div>

                <br>
                
                <!-- like y guardado -->
                <div class="container">
                    <div class="row">
                        <!-- primera colimna (save) -->
                        <div class="col" id="save_position">
                            <img v-bind:src="save" class="card-img-top save_like" alt="image">
                        </div>

                            <!-- Segunda columna (like) -->
                        <div class="col" id="like_position">
                            <img @click="getLike()" v-bind:src="like[1]" class="card-img-top save_like" alt="image">
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        <!-- comentarios -->
        <div class="container coments">
            <div class="row">
                <!-- primera colimna (coment) -->
                <div class="col-1" id="save_position">
                    <img v-bind:src="coment" class="card-img-top save_like" alt="image">
                </div>

                    <!-- Segunda columna (escribir) -->
                <div class="col" id="save_position">
                    <input type="text" class="form-control txt_coment" placeholder="Escribe tu comentario...">
                </div>
            </div>
        </div>

    </section>
</template>

<script>

import img_dir from '../img_dir.js'
import axios from 'axios'

export default {
    props: ["id"],

    beforeCreate() {
        var vm = this
        axios.get('/recetas')
            .then(res => { 
                for (let index = 0; index < res.data.length; index++) {
                    if (res.data[index].id == vm.id) {
                        vm.recipe = res.data[index]

                        this.ingredients = this.recipe.ingredients.split(',');
                        this.descriptions = this.recipe.description.split('\n');
                        this.image = img_dir.url + this.recipe.image;

                        break
                    }
                }
            }, 
            (error) => {
                console.log(error.response.data);
            });

        axios.get('/profile')
            .then(resqu => {
                this.user = resqu.data;
            },
            (error) => {
                console.log(error.response.data);
            });
    },

    data() {
        return { 
            recipe: [], 
            ingredients: [],
            descriptions: [],
            image: "",
            like: [],
            save: img_dir.url + img_dir.save,
            coment: img_dir.url + img_dir.coment,
            user: []
        }
    },

    beforeMount() {
        this.like = [3, img_dir.url + img_dir.dislike];
        axios.get('/likes')
            .then(resp => {
                for (let index = 0; index < resp.data.length; index++) {
                    if (resp.data[index].user_id == this.user[0].id &&
                        resp.data[index].recipe_id == this.id) {
                        this.like = [5, img_dir.url + img_dir.like];
                        break
                    }
                }
            }, 
            (error) => {
                console.log(error.response.data);
            });
    }, 
    methods: {
        getLike() {
            console.log('hola como estamos bien me alegro');
            if (this.user.length == 0) {
                alert("No puedes dar like hasta que inicies sesicón.");
            } else {
                console.log(this.user[0].id);
                axios.post('/likes', {
                user_id: this.user[0].id, 
                recipe_id: this.recipe.id})
                .then(() => {
                    this.like = [4, img_dir.url + img_dir.like];
                }, 
                (error) => {
                    console.log(error.response.data);
                });
            }

            
        }
    }

}
</script>

<style>
    #content {
        margin-top: 6rem;
        margin-right: 4%;
        margin-left: 4%;
    }

    .recipe {
        background-color: #ECE5E9;
        margin-right: 6%;
        margin-left: 6%;
        box-shadow: 0px 20px 25px -5px rgba(0, 0, 0, 0.1), 0px 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-radius: 6px;
        margin-top: -4rem;
    }

    h1 {
        text-align: center;
        font-family: 'Rouge Script';
        font-style: normal;
        align-items: center;
        margin-top: -2.1rem;
    }

    #title {
        background: #EFC6CD;
        height: 1rem;
        border-radius: 30px;
    }

    .ingredient {
        background: #F8EBEC;
        margin-right: 1rem;
        margin-bottom: 1rem;
        max-width: 100%;
        max-height: 100%;
    }

    .hijo {
        width: 100%;
        height: 100%;
    }

    .descrip {
        margin: 3%;
        text-align: justify;
        text-indent: 3%;
    }

    .picture_recipe {
        min-width: 8rem;
        height: 100%;
        width: 100%;
        object-fit: contain;
    }

    #like_position {
        text-align: right;
    }

    #save_position {
        text-align: left;
    }

    .save_like {
        width: 15%;
        min-width: 2.5rem;
    }

    .coments {
        margin-top: 3rem;
        margin-right: 6%;
        margin-left: 6%;
        background-color: #D5888D;
        widows: 100%;
        margin-bottom: 1rem;
    }

    .txt_coment {
        background-color: #D5888D;
        border-color: #D5888D;
        margin-left: -3rem;
    }

    .txt_coment:focus {
        background-color: #D5888D;
        border-color: #D5888D;
        box-shadow: 0 0 0 0 #d18f93;
        color: white;
    }

</style>