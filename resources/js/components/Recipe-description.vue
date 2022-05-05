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
                            <p style="font-weight: bold;">
                                {{like[0]}} <img @click="getLike()" v-bind:src="like[1]" class="card-img-top save_like" alt="image">
                            </p>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        <!-- send comment -->
        <div class="container coments">
            <div class="row">
                <!-- primera colimna (coment) -->
                <div class="col-1">
                    <img v-bind:src="coment" class="card-img-top comment_image" alt="image">
                </div>

                    <!-- Segunda columna (escribir) -->
                <div class="col-11">
                    <form style="height: auto;" @submit.prevent="sendComment()">
                        <textarea style="width: 80%;" v-model="comment" class="form-control txt_coment" placeholder="Escribe tu comentario..."></textarea>
                        <button type="submit" class="button_comment">
                            <img v-bind:src="send" class="card-img-top comment_image" alt="image">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- comments -->
        <div class="container coment_user">
            <div v-for="comment_recipe in getComment">

                <div class="row margin_comment">
                    <!-- primera colimna (avatar) -->
                    <div class="col-1">
                        <img v-bind:src="user_img" class="card-img-top comment_image" alt="image">
                    </div>

                        <!-- Segunda columna (comentario) -->
                    <div class="col-11">
                        <p style="font-weight: bold;">@{{ comment_recipe.name_user.name }}</p>
                        <p>{{ comment_recipe.description }}</p>
                    </div>
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
        var vm = this;
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

        // miramos si el usuario está registrado
        axios.get('/profile')
            .then(resqu => {
                this.user = resqu.data;
                this.getUserLike();
            },
            (error) => {
                console.log(error.response.data);
            });

        // miramos el num de likes de la receta
        axios.get(`/recipe_likes/${this.id}`)
            .then(respo => {
                this.like[0] = respo.data;
            }, 
            (error) => {
                console.log(error.response.data);
            });

        // miramos todos los comentarios
        axios.get(`/recipe_comments/${this.id}`)
            .then(respo => {
                this.comments = respo.data;
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
            like: [0, img_dir.url + img_dir.dislike],
            send: img_dir.url + img_dir.send,
            save: img_dir.url + img_dir.save,
            coment: img_dir.url + img_dir.coment,
            user: [],
            user_img: img_dir.url + img_dir.user,
            comment: '', 
            comments: []
        }
    },

    computed: {
        getUser() {
            return (this.user[0]) ? this.user[0] : this.user;
        }, 

        getComment() {
            return this.comments;
        }
    },

    beforeMount() {
    }, 
    methods: {
        getLike() {
            if (this.getUser.length == 0) {
                alert("No puedes dar like hasta que inicies sesicón.");
            } else {
                //console.log(this.getUser);
                axios.post('/likes', {
                user_id: this.getUser.id, 
                recipe_id: this.recipe.id})
                .then(() => {
                    this.like = [this.like[0]+1, img_dir.url + img_dir.like];
                }, 
                (error) => {
                    console.log(error.response.data);
                });
            }
        }, 

        getUserLike() {
            // miramos si el usuario registrado ha dado like a la receta
            //console.log(this.getUser);
            axios.get(`/likes/${this.getUser.id}`)
                .then(resp => {    
                    //console.log(resp.data);
                    for (let index = 0; index < resp.data.length; index++) {
                        /*console.log(this.getUser.id);
                        console.log(this.id);*/
                        if (resp.data[index].user_id == this.getUser.id &&
                            resp.data[index].recipe_id == this.id) {
                            this.like[1] = img_dir.url + img_dir.like;
                            break
                        }
                    }
                }, 
                (error) => {
                    console.log(error.response.data);
            });
        }, 

        sendComment() {
            if (this.getUser.length == 0) {
                alert("No puedes comentar hasta que inicies sesicón.");
            } else {
                axios.post('/comment', {
                description: this.comment,
                user_id: this.getUser.id, 
                recipe_id: this.recipe.id})
                .then((res) => {
                    this.comment = '';
                    this.comments.push(res.data);
                    this.comments[this.comments.length -1].name_user = this.getUser;
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

    .button_comment {
        float: right; 
        margin: auto; 
        background-color: 
        transparent; 
        border-color: transparent;
        width: 5%;
    }

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

    .comment_image {
        width: 15%;
        min-width: 1.6rem;
    }

    .coments, .coment_user {
        margin-top: 3rem;
        margin-right: 6%;
        margin-left: 6%;        
        width: 100%;
        margin-bottom: 1rem;

        display: inline-block;
        min-width: 100px;
    }

    .coments {
        background-color: #D5888D;
        border-radius: 6px;
    }

    .txt_coment {
        background-color:transparent;
        border-color:transparent;
        color: white;

    }

    .txt_coment:focus {
        background-color:transparent;
        border-color:transparent;
        box-shadow: 0 0 0 0 transparent;
        color: white;
    }

    .margin_comment {
        margin-bottom: 1%;
        box-shadow: 0px 20px 20px -5px rgba(0, 0, 0, 0.1), 0px 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-radius: 6px;
        background-color: #EDEBEB;
    }

</style>