<template>
    <div>
        <form @submit="updateBook">
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
            <input type="submit" value="Submit">
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "EditBook",
        data(){
            return {
                id: '',
                form : {
                    _id: '',
                    title: '',
                    author: '',
                    price: ''
                }
            }
        },
        created() {
            this.id = this.$route.params.id;
            this.fetchData();
        },
        methods: {
            fetchData() {
                axios.get("http://localhost:8000/api/books/" + this.id)
                    .then(response => {
                        this.form = {...response.data}
                    })
            },
            updateBook(event) {
                event.preventDefault();
                axios
                    .put("http://localhost:8000/api/books/" + this.id ,this.form)
                    .then(() => {
                        this.$router.push('/')
                    });
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
    }
</style>
