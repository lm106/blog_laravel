<template>
    <section class="container_fluid_new">
        <div class="recipe">
            <div id="content">
                <div>
                    <div id="title"></div>
                    <h1>{{ recipe.title }}</h1>
                </div>

                <div class="container">
                    <div class="row">
                        <!-- primera colimna (ingredients) -->
                        <div class="col ingredient">
                            <div class="picture_recipe" style="margin-top: 2.5rem; margin-bottom: 2.5rem;">
                                <div class="hijo">
                                    <ul v-for="ingredient in ingredients" :key=ingredient>
                                        <li>
                                            <p style="font-style: italic;">{{ ingredient }}</p>
                                        </li>
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
                    <div v-for="description in descriptions" :key=description>
                        <p>{{ description }}</p>
                    </div>
                </div>

                <br>

                <!-- like y guardado -->
                <div class="container">
                    <div class="row">
                        <div style="width:12%;">
                            <button type="button" class="col btn" id='save_position' data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <img v-bind:src="save" class="card-img-top save_like" alt="image">
                            </button>
                            <!-- formulario de añadir receta en una lista -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div v-if="getUser" class="modal-content">
                                        <div class="modal-header">
                                            <h5 v-if="list_private_user" class="modal-title" id="exampleModalLabel">Añadir receta a una lista
                                                privada</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="success">{{ message_error }}</p>
                                            <form v-if="list_private_user" @submit.prevent="getSave">
                                                <div class="mb-3">
                                                    <label for="recipe-title" class="col-form-label">Seleccionar lista:
                                                        &nbsp;</label>
                                                    <select v-model="list_save">
                                                        <option v-for="list in lists_private_user" :key=list>
                                                            {{ list.name }}</option>
                                                    </select><br>
                                                </div>
                                                <button type="submit" class="btn btns_create" id="btn_save">Guardar
                                                    receta</button>
                                                <button type="button" class="btn btns_create btn_cancel"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                            </form>
                                            <form v-if="list_private_user" @submit.prevent="deleteSave">
                                                <button type="submit" class="btn btn-danger">Quitar receta</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div v-else class="modal-content">
                                        <div class="modal-header">
                                            <p class="success">No puedes guardar una receta hasta que no inicies sesión.
                                            </p>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Segunda columna (like) -->
                        <div class="col" id="like_position">
                            <p style="font-weight: bold;">
                                {{ like[0] }}
                                <button class="button_like">
                                    <img @click="getLike()" v-bind:src="like[1]" class="card-img-top save_like"
                                        alt="image">
                                </button>
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
                        <textarea style="width: 80%;" v-model="comment" class="form-control txt_coment"
                            placeholder="Escribe tu comentario..."></textarea>
                        <button type="submit" class="button_comment">
                            <img v-bind:src="send" class="card-img-top comment_image" alt="image">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- comments -->
        <div class="container coment_user">
            <div v-for="comment_recipe in getComment" :key=comment_recipe :comment='comment_recipe'>
                <Comment :comment="comment_recipe"></Comment>
            </div>

        </div>
    </section>
</template>

<script>

import img_dir from '../img_dir.js'
import axios from 'axios'
import Comment from './Comment.vue';

export default {
    props: ["id"],
    components: { Comment },
    beforeCreate() {
        // vemos el contenido de la receta
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
                this.like[0] = respo.data[0];
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
        //Listas creadas por el usuario
        axios.get('/lists_user').then(res => {
            if (res.data != 'not') this.lists_private_user = res.data;
        },
            (error) => {
                console.log(error.response.data);
            });
        //Chequear si esta guardada
        axios.post('/check_recipe_save', { id: this.id }).then(res => {
            if (res.data == 'ok') this.save = img_dir.url + img_dir.save;
            // console.log(res);
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
            like: [0, img_dir.url + img_dir.dislike, null],
            send: img_dir.url + img_dir.send,
            save: img_dir.url + img_dir.dissave,
            coment: img_dir.url + img_dir.coment,
            user: [],
            comment: '',
            comments: [],
            lists_private_user: [],
            list_save: '',
            message_error: '¡Ups! No tienes listas privadas. Créate una.',
            bannedWords: ['joder', 'subnormal', 'tonto','gilipollas','maricon','estúpido'],
            commenthasbadwords:false
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

    methods: {
        filterComment() {
            if (this.comment!== '') {
                let BreakError
                try{
                    this.bannedWords.forEach(element => {
                        if (this.comment.includes(element)) {
                            this.commenthasbadwords = true
                            throw BreakError;

                        }else{
                            this.commenthasbadwords=false
                        }
                    });
                }catch (err) {
                    if (err !== BreakError) throw err;
                }
            }
        },
        getLike() {
            if (this.getUser.length == 0) {
                alert("No puedes dar like hasta que no inicies sesión.");
            } else {

                if (this.like[2] == null) {
                    axios.post('/likes', {
                        user_id: this.getUser.id,
                        recipe_id: this.recipe.id
                    })
                    .then((res) => {
                        this.like = [this.like[0] + 1, img_dir.url + img_dir.like, res.data.id];
                    },(error) => {
                        console.log(error.response.data);
                    });

                } else {
                    axios.get(`/dislikes/${this.like[2]}`)
                    .then(() => {
                        this.like = [this.like[0] - 1, img_dir.url + img_dir.dislike, null];
                    },(error) => {
                        console.log(error.response.data);
                    });
                }
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
                            this.like[2] = resp.data[index].id;
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
                alert("No puedes comentar hasta que no inicies sesión.");
            } else {
                this.filterComment()
                console.log(this.commenthasbadwords)
                if (!this.commenthasbadwords) {
                    axios.post('/comment', {
                        description: this.comment,
                        user_id: this.getUser.id,
                        recipe_id: this.recipe.id
                    })
                    .then((res) => {
                        this.comment = '';
                        this.comments.push(res.data);
                        this.comments[this.comments.length - 1].name_user = this.getUser;
                    },(error) => {
                        console.log(error.response.data);
                    });
                }else{
                    alert('Su comentario tiene palabras ofensivar. Por favor quitelas para publicar su comentario.')
                }
            }
        },
        getSave() {
            this.message_error = '';
            axios.post('/save_recipe', { user_id: this.getUser.id, name: this.list_save, recipe_id: this.recipe.id }).then((res) => {
                if (res.data == 'not') {
                    this.message_error = '¡Ups! No puede añadir esta receta en la lista seleccionada ya la tienes añadida';
                } else {
                    window.location.href = `/recipe_description/${this.recipe.id}`;
                }
            },
                (error) => {
                    console.log(error.response.data);
                });
        },
        deleteSave() {
            this.message_error = '';
            axios.post('/dissave_recipe', { user_id: this.getUser.id, name: this.list_save, recipe_id: this.recipe.id }).then((res) => {
                if (res.data == 'not') {
                    this.message_error = '¡Ups! No puede quitar esta receta en la lista seleccionada no esta añadida';
                } else {
                    window.location.href = `/recipe_description/${this.recipe.id}`;
                }
                // console.log(res);
            },
                (error) => {
                    console.log(error.response.data);
                });
        }
    }

}
</script>

<style>
.button_comment,
.button_like,
.button_edit {
    margin: auto;
    background-color:
        transparent;
    border-color: transparent;
    width: 5%;
}

.button_edit {
    width: 2%;
}

.button_comment {
    float: right;
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
    padding: 0px;
    display: contents;
    width: 505;
    ;
}

.save_like,
.edit {
    width: 15%;
    min-width: 2.5rem;
}

.edit {
    min-width: 1.5rem;
}

.comment_image {
    width: 15%;
    min-width: 1.6rem;
}

.coments,
.coment_user {
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
    background-color: transparent;
    border-color: transparent;
    color: white;

}

.txt_coment:focus {
    background-color: transparent;
    border-color: transparent;
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
