<template>
    <div class="center">
        <search  @search="updateSearch"></search>
        <div class="order">
            Order by:
            <button v-on:click="setOrder('title')">Title</button>
            <button v-on:click="setOrder('author')">Author</button>
            <button v-on:click="setOrder('price')">Price</button>
        </div>
        <table  class="book-list">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <tr v-if="loading" class="loading"><td colspan="4">Loading...</td></tr>
            <tr v-else-if="books.length === 0"><td colspan="4">No books found</td></tr>
            <BookCard  v-for="book in books" @delete="fetchData" v-bind:key="book._id" v-bind:book="book"></BookCard>
        </table>
        <paginator @nextPage="nextPage" @prevPage="prevPage" v-bind:current-page="page" v-bind:max-pages="maxPages"></paginator>
    </div>
</template>

<script>
    import Search from "./Search";
    import axios from "axios";
    import BookCard from "./BookCard";
    import Paginator from "./Paginator";

    export default {
        name: "BookList",
        data() {
            return {
                loading: false,
                order: 'author',
                books: null,
                error: null,
                search: '',
                page: 1,
                maxPages: 1,
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.error = this.books = null;
                this.loading = true;
                axios.get("http://localhost:8000/api/books?page=" + this.page +
                    "&query=" + this.search +
                    "&order=" + this.order)
                    .then(response => {
                        this.loading = false;
                        this.books = response.data.data;
                        this.page = response.data.current_page;
                        this.maxPages = response.data.last_page;
                    })
                    .catch(error => {
                        this.error = error.toString();
                    })
            },
            updateSearch(searchString){
                this.search = searchString;
                this.fetchData();
            },
            nextPage(){
                this.page += 1;
                this.fetchData();
            },
            prevPage(){
                this.page -= 1;
                this.fetchData();
            },
            setOrder($value){
                this.order = $value;
                this.fetchData();
            }
        },
        components: {Paginator, BookCard, Search}
    }
</script>

<style >

    table{
        border-collapse: collapse;
        table-layout: fixed;
    }

    tr{
        padding: .37rem .75rem;
    }
    tr.loading{
        text-align: center;
    }
    tr:nth-child(even){
        background-color: #dddddd;

    }
    td, th {
        border-left: 1px solid #dddddd;
        border-right: 1px solid #dddddd;
        padding: 8px;
    }
    tr:nth-child(even) td{
        border-left: 1px solid white;
        border-right: 1px solid white;
        padding: 8px;
    }
    table td:first-child {
        border-left: none;
    }

    table td:last-child {
        border-right: none;
    }
    table th:first-child {
        border-left: none;
    }

    table th:last-child {
        border-right: none;
    }
    .order{
        margin: auto;
        padding: 10px;
    }

    .book-list{
        margin: auto;
        width: 70%;
        border-radius: 13px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
