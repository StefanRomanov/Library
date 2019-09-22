<template>
    <div>
        <form>
            <input id="search" placeholder="Search by title and author" type="text"/>
            <button v-on:click="search()">Search</button>
        </form>
        <hr>
    </div>

</template>

<script>
    export default {
        name: "Search",
        methods : {
            search (){
                alert("search")
            }
        }
    }
</script>

<style scoped>
    div{
        padding: .75rem;
        display: inline-block;
        width: 75%;
        margin: auto;
        justify-content: space-around;
    }
    input {
        width: 75%;
        margin-right: 10px;
    }
</style>
