<template>
  <div id="app">
    <p>
      <router-link to="/">Accueil</router-link>
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
#menu > a{
  text-align: center;
  margin-right: 20px;
}
</style>
