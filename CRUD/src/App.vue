<template>
  <div id="app">
    <Categories></Categories>
    <hr/>
    <Work></Work>
  </div>
</template>

<script>
import Categories from '@/components/Categories'
import Work from '@/components/Work'

export default {
  name: 'App',
  components: {
    Categories,
    Work
  }
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
