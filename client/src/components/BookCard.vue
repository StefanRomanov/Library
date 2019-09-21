<template>
    <li>{{book.title}} - {{book.author}} - ${{book.price}}
        <router-link :to="'edit/' + book._id" tag="button">Edit</router-link>
        <button v-on:click="deleteBook(book._id)">Delete</button>
    </li>
</template>

<script>
    import axios from "axios";

    export default {
        name: "BookCard",
        props: ['book'],
        components: {},
        methods : {
            deleteBook(id){
                axios.delete("http://localhost:8000/api/books/" + id)
                    .then(() => {
                        this.$emit('delete',this.book);
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
