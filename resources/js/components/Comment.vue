<template>
    <div class="container-fluid coment">
        <div class="row margin_comment" style="max-width: 100%;">
            <!-- primera colimna (avatar)  -->
            <div class="col-1">
                <img v-bind:src="user_img" class="card-img-top comment_image" alt="image">
            </div>

                <!-- Segunda columna (comentario)  -->
            <div class="col-9">
                <p style="font-weight: bold;">@{{ my_comment.name_user.name }}</p>
                <div v-if="flag == true">
                    <p>
                        <input class="form-control edit_comment_input" type="textarea" v-model="my_comment.description">
                    </p> 
                </div>
                <div v-else-if="flag == false">
                    <p>{{ my_comment.description }}</p>
                </div>
                
            </div>

                <!-- like o editar  -->
            <div class="col-2">
                <br>
                <div v-if="my_comment.name_user.id == getUser.id">
                    <button @click="getEdit()" class="button_edit">
                        <img v-bind:src="edit" class="card-img-top edit" alt="image">
                    </button>
                </div>
                <div v-else-if="my_comment.name_user.id != getUser.id">
                    <button @click="sendLike()" class="button_edit">
                        <img v-bind:src="getLike" class="card-img-top save_like" alt="image">
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</template>

<script>
    import img_dir from '../img_dir.js'
    import axios from 'axios';
    
export default {
    props: ["comment"],

    beforeCreate() {
        // miramos si el usuario está registrado
        axios.get('/profile')
            .then(resqu => {
                this.user = resqu.data;
            },
            (error) => {
                console.log(error.response.data);
            });

        // miramos los likes de los comentarios
        axios.get(`/recipe_like_comments/${this.comment.id}`)
            .then(res => {
                this.like_comment = res.data;
            }, 
            (error) => {
                console.log(error.response.data);
            }); 
    },

    data() {
        return { 
            user: [],
            user_img: img_dir.url + img_dir.user,
            edit: img_dir.url + img_dir.edit, 
            like_comment: [],
            my_comment: this.comment,
            flag: false
        }
    }, 

    computed: {
        getUser() {
            return (this.user[0]) ? this.user[0] : this.user;
        },

        getMyComment() {
            return my_comment;
        }, 

        getLike() {
            if (this.getUser.length == 0 || this.like_comment.length == 0) {
                return img_dir.url + img_dir.dislike;
            } else {
                if (this.like_comment[0].user_id == this.getUser.id) {
                    return img_dir.url + img_dir.like;
                } else {
                    return img_dir.url + img_dir.dislike;
                }
                
            }
        }
    }, 

    methods: {

        sendLike() {
            if (this.getUser.length == 0) {
                alert('No puedes dar like hasta que inicies sesión.');

            } else {
                if (this.like_comment.length == 0) {
                    axios.post('/like_comment', {
                        user_id: this.getUser.id, 
                        comment_id: this.my_comment.id})
                        .then((res) => {
                            this.like_comment.push(res.data);
                        }, 
                        (error) => {
                            console.log(error.response.data);
                        });

                } else {
                    axios.get(`/dislike_comment/${this.like_comment[0].id}`)
                    .then(() => {
                        this.like_comment = [];
                    }, 
                    (error) => {
                        console.log(error.response.data);
                    });
                }
            }

        },

         getEdit() {
            console.log('estamos editando');
            if (this.flag == false) {
                this.flag = true;

            } else {
                axios.post('/edit_comment', {
                    id: this.my_comment.id,
                    user_id: this.my_comment.user_id, 
                    recipe_id: this.my_comment.recipe_id,
                    description: this.my_comment.description})
                    .then(() => {
                        this.flag = false;
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

    .edit_comment_input {
        background-color: #f0f0f0;
        border-radius: 1rem;
        border-color:transparent;
        color: rgb(128, 128, 128);
        width: 100%;
        margin-top: -0.5%;
    }

    .edit_comment_input:focus {
        background-color: #f0f0f0;
        border-radius: 1rem;
        border-color:transparent;
        box-shadow: 0 0 0 0 transparent;
        color: rgb(128, 128, 128);
    }

    .save_like{
        margin-left: -0.6rem;
    }

</style>