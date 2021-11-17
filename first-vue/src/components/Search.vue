<template>
    <label class="label">Rechercher: </label>
    <input type="text" placeholder="Search..." required/>
</template>

<script>
export default {
  name: 'Search',
  props: {
    msg: String
  }
}
</script>

<style scoped>
.label {
  color: #42b983;
}
</style>