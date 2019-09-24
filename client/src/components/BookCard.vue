<template>
    <tr class="book">
        <td class="text">{{book.title}}</td>
        <td>{{book.author}}</td>
        <td>${{book.price}}</td>
        <td class="actions">
            <router-link :to="'edit/' + book._id" tag="button"><span>Edit</span></router-link>
            <button v-on:click="deleteBook(book._id)"><span>Delete</span></button>
        </td>
    </tr>
</template>

<script>
    import BookService from '../services/BookService'
    import config from '../util/config'

    export default {
        name: "BookCard",
        props: ['book'],
        components: {},
        methods : {
            deleteBook(id){
                BookService.deleteBook(id)
                    .then(() => {
                        this.$emit('delete');
                    })
                    .catch(error => {
                        this.$toasted.error(error, config.TOASTED_OPTIONS);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
