<template>
    <tr class="book">
        <td class="text">{{book.title}}</td>
        <td>{{book.author}}</td>
        <td>${{book.price}}</td>
        <td class="actions">
            <router-link :to="'edit/' + book._id" tag="button">Edit</router-link>
            <button v-on:click="deleteBook(book._id)">Delete</button>
        </td>
    </tr>
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
            }
        }
    }
</script>

<style scoped>

</style>
