<template>
    <div class="center">
        <search  @search="updateSearch"></search>
        <div class="order">
            <strong>Order by:</strong>
            <select v-on:change="setOrder($event)">
                <option value="title">Title</option>
                <option value="author">Author</option>
                <option value="price">Price (low to high)</option>
                <option value="priceDesc">Price (high to low)</option>
            </select>
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
    import BookService from '../services/BookService'
    import config from '../util/config'
    import BookCard from "./BookCard";
    import Paginator from "./Paginator";

    export default {
        name: "BookList",
        data() {
            return {
                loading: false,
                order: 'title',
                books: null,
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
                this.books = null;
                this.loading = true;
                BookService.getAllBooks(this.page,this.search, this.order)
                    .then(response => {
                        this.loading = false;
                        this.books = response.data.data;
                        this.page = response.data.current_page;
                        this.maxPages = response.data.last_page;
                    })
                    .catch(error => {
                        this.$toasted.error(error, config.TOASTED_OPTIONS);
                    })
            },
            updateSearch(searchString){
                this.search = searchString;
                this.page = 1;
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
            setOrder(event){
                this.order = event.target.value;
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
        display: inline-block;
        margin-left: 0;
        margin-right: 40%;
        padding: 10px;
    }
    .order select {
        width: 60%;
        padding: 5px 5px;
        margin-left: 10px;
    }

    .book-list{
        margin: auto;
        width: 70%;
        border-radius: 13px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
