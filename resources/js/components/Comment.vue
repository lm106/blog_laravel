<template>
  <div class="row margin_comment">
                     <!-- primera colimna (avatar)  -->
                    <div class="col-1">
                        <img v-bind:src="user_img" class="card-img-top comment_image" alt="image">
                    </div>

                     <!-- Segunda columna (comentario)  -->
                    <div class="col-10">
                        <p style="font-weight: bold;">@{{ my_comment.name_user.name }}</p>
                        <p>{{ my_comment.description }}</p>
                    </div>

                     <!-- like o editar  -->
                    <div class="col-1">
                        <br>
                        <div v-if="my_comment.name_user.id == getUser.id">
                            <button @click="getEdit()" class="button_edit">
                                <img v-bind:src="edit" class="card-img-top edit" alt="image">
                            </button>
                        </div>
                        <div v-else-if="my_comment.name_user.id != getUser.id">
                            <button @click="sendLike()" class="button_edit">
                                <img v-bind:src="getLike" class="card-img-top edit" alt="image">
                            </button>
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
        }
    }


}
</script>

<style>

</style>