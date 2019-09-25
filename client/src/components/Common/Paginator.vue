<template>
    <div class="paginator">
        <button v-on:click="prevPage" :disabled="currentPage <= 1">&lt;</button>
        <input type="text" disabled :value=this.currentPage>
        <input type="text" disabled :value=this.maxPages>
        <button v-on:click="nextPage" :disabled="currentPage >= maxPages">&gt;</button>
    </div>
</template>

<script>
    export default {
        name: "Paginator",
        props: ['currentPage', 'maxPages'],
        methods: {
            prevPage() {
                this.$emit('prevPage');
            },
            nextPage() {
                this.$emit('nextPage');
            }
        }
    }
</script>

<style scoped>
    div.paginator {
        display: inline-block;
        margin: auto;
        padding: 10px;
    }
    div.paginator input {
        width: 10%;
        text-align: center;
        padding: 10px 1px;

    }
    div.paginator button {
        background-color: gray;
        margin-right: 3px;
    }
</style>
