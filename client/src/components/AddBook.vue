<template>
    <div>
        <form @submit="validateForm">
            <label for="title">Title</label>
            <input id="title" type="text" v-model="form.title" name="title">
            <br>
            <label for="author">Author</label>
            <input id="author" v-model="form.author" type="text" name="author">
            <br>
            <label for="price">Price</label>
            <input id="price" type="number" name="price" v-model="form.price" step=".01">
            <br>
            <hr>
            <button type="submit">Create</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "AddBook",
        data() {
          return {
              form : {
                  title: '',
                  author: '',
                  price: ''
              },
              errors: [],
          }
        },
        methods : {
            sendRequest() {
                axios
                    .post("http://localhost:8000/api/books",this.form)
                    .then(() => {
                        this.$router.push('/')
                    })

            },

            validateForm(event){
                event.preventDefault();
                if(!this.form.title || !this.form.author || !this.form.price){
                    this.errors.push('All fields required.');
                }
                if(this.form.title.length > 30 || this.form.title.length < 1){
                    this.errors.push('Title should be between 1 and 30 characters long.')
                }
                if(this.form.author.length > 30 || this.form.author.length < 2){
                    this.errors.push('Author should be between 2 and 30 characters long.')
                }
                if(this.form.price < 0.01){
                    this.errors.push('Price should be higher than 0.')
                }


                if(this.errors.length === 0){
                    this.sendRequest();
                } else {
                    for (const err of this.errors) {
                        this.$toasted.error(err, {position: "top-right", duration: 3000, theme: "bubble", closeOnSwipe: true });
                    }
                    this.errors = [];
                }


            }
        }
    }
</script>

<style scoped>
    div {
        width: 50%;
        margin: auto;
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
