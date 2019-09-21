<template>
    <form>
        <input id="search" placeholder="Search by title and author" type="text"/>
        <button v-on:click="search()">Search</button>
    </form>
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

</style>
