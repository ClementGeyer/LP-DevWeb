<template>
  <div id="app">
    <p>
      <router-link to="/categories">Gérer les catégories</router-link>
      <router-link to="/work">Gérer les travaux</router-link>
    </p>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
#app > p > * {
  padding: 20px;
  color: black;
  text-decoration: none;
}
.router-link-active{
  color: green !important;
}
#menu > a{
  text-align: center;
  margin-right: 20px;
}
#search > *{
  margin: 20px;
}
#search{
  border: 1px solid green;
  border-radius: 10px;
  background-color: rgb(135, 235, 135);
  width: 35%;
  margin: auto;
}
.disabled{
  cursor: default;
  opacity: 0.5;
}
.table{
  margin: 20px auto auto auto;
}
.button{
  background-color: #555555;
  border: none;
  color: white;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
}
</style>
