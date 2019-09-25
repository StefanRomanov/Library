<template>
    <div>
        <form @submit="emit">
            <input id="search" placeholder="Search by title or author" type="text" v-model="search" />
            <button type="submit">Search</button>
        </form>
        <hr>
    </div>

</template>

<script>
    export default {
        name: "Search",
        data(){
            return {
                search: ''
            }
        },
        methods : {
            emit (event){
                event.preventDefault();
                this.$emit('search',this.search);
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
