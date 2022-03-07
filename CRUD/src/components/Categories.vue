<template>
  <div>
    <h1>Catégories</h1>
    <div id="search">
      <button class="button" :disabled="addButtonShow" v-bind:class="{ disabled: addButtonShow }" v-on:click="() => addCategorie()">Ajouter une catégorie</button>
      <input placeholder="Nom de la catégorie" type="text" v-model="newLibelle"/>
      <input placeholder="Rechercher une catégorie (nom)" type="text" v-model="findCategory"/>
    </div>
    <table class="table">
      <thead>
        <th>Libellé</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </thead>
      <tbody>
        <template v-for="category in categories">
          <tr :key="category.id" v-if="category.name.match(findCategory)">
            <td>
              <p v-show="!category.showModify">{{ category.name }}</p>
              <input v-show="category.showModify" type="text" v-model="modifyInput"/>
            </td>
            <td><button v-on:click="() => category.showModify ? sendModify(category) : showModify(category)">{{ category.showModify ? "Confirmer" : "Modifier" }}</button></td>
            <td><button v-on:click="() => removeCategorie(category)">Supprimer</button></td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script>
import { getCategories, postCategorie, deleteCategorie, putCategory } from '../services/ServiceCategory';

export default {
  async mounted () {
    this.sendGetCategoriesRequest()
  },

  data: function () {
    return {
      categories: {},
      newLibelle: '',
      modifyInput: '',
      findCategory: '',
      addButtonShow: false
    }
  },

  methods: {

    addCategorie: async function() {
      this.addButtonShow = true;
      await postCategorie({
        name: this.newLibelle
      })
      this.sendGetCategoriesRequest()
      this.newLibelle = ''
      this.addButtonShow = false;
    },

    sendGetCategoriesRequest: async function() {
      this.categories = await getCategories(
      ).then(req => {
        req.data['hydra:member'].forEach(category => { 
          category.showModify = false;
        });
        return req.data['hydra:member']
      })
    },

    removeCategorie: function(category) {
      deleteCategorie(category.id)
      let index = 0;
      let id = 0;
      this.categories.forEach((c) => {
        if(c === category) {
          index = id;
        }
        id++;
      })
      this.categories.splice(index, 1)
    },

    showModify: function(category) {
      this.categories.forEach((category) => {
        category.showModify = false;
      });
      this.modifyInput = '';
      category.showModify = !category.showModify;
    },

    sendModify: function(category) {
      putCategory(category.id, {name: this.modifyInput})
      category.name = this.modifyInput
      this.modifyInput = ''
      category.showModify = false
    },

  },
}
</script>

<style scoped>

</style>
