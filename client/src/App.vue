<template>
  <div id="app">
      <navbar></navbar>
      <router-view></router-view>
  </div>
</template>

<script>

import Navbar from "./components/Navbar";
export default {
  name: 'app',
  components: {
      Navbar
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

button {
    margin-left: 3px;
    background: cornflowerblue;
    border: 1px solid transparent;
    border-radius: .25rem;
    text-align: center;
    color: white;
    padding: .37rem .75rem;
    font-size: 1rem;
    cursor: pointer;
}

input[type=text], [type=number] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 100%;
    background-color: cornflowerblue;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>
