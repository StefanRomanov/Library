<template>
    <div>
        <search></search>
        <h3 v-if="loading">Loading...</h3>
        <div v-else>
            <BookCard v-for="book in books" @delete="updateList(book)" v-bind:key="book._id" v-bind:book="book"></BookCard>
        </div>
        <hr>
        <router-link to="/add" tag="button">Add</router-link>
    </div>
</template>

<script>
    import Search from "./Search";
    import axios from "axios";
    import BookCard from "./BookCard";

    export default {
        name: "BookList",
        data() {
            return {
                loading: false,
                books: [],
                error: null
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.error = this.books = null;
                this.loading = true;
                axios.get("http://localhost:8000/api/books")
                    .then(response => {
                        this.loading = false;
                        this.books = response.data.data;
                    })
                    .catch(error => {
                        this.error = error.toString();
                    })
            },
            updateList(book){
                const idx = this.books.indexOf(book);
                this.books.splice(idx, 1);
            }
        },
        components: {BookCard, Search}
    }
</script>

<style scoped>

</style>
