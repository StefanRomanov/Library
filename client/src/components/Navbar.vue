<template>
    <div class="topnav">
        <router-link active-class="active"  to="/" exact>All Books</router-link>
        <router-link active-class="active" to="/add" exact>Add Book</router-link>
    </div>
</template>

<script>
    export default {
        name: "Navbar"
    }
</script>

<style scoped>
    .topnav {
        background-color: #333;
        margin-bottom: .75rem;
        display: inline-block;
        width: 75%;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
        display: inline-block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
        background-color: cornflowerblue;
        color: white;
    }
</style>
