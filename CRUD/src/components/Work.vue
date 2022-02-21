<template>
  <div>
    <h1>Travaux</h1>
    <div>
      <button :disabled="addButtonShow" v-on:click="() => addWork()">Ajouter un travail</button>
      <input placeholder="Nom du travail" type="text" v-model="newLibelle"/>
      <select>
        <option v-for="category in categories" :key="category.id">{{ category.name }}</option>
      </select>
    </div>
    <div>
      <input placeholder="Rechercher un travail (nom)" type="text" v-model="findWork"/>
    </div>
    <table>
      <thead>
        <th>Libellé</th>
        <th>Catégorie</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </thead>
      <tbody>
        <template v-for="work in works">
          <tr :key="work.id" v-if="work.title.match(findWork)">
            <td>
              <p v-show="!work.showModify">{{ work.title }}</p>
              <input v-show="work.showModify" type="text" v-model="modifyInput"/>
            </td>
            <td>{{ work.categoryName }}</td>
            <td><button v-on:click="() => work.showModify ? sendModify(work) : showModify(work)">{{ work.showModify ? "Confirmer" : "Modifier" }}</button></td>
            <td><button v-on:click="() => removeWork(work)">Supprimer</button></td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script>
import { getWorks, postWork, deleteWork, putWork } from '../services/ServiceWork';
import { getCategories } from '../services/ServiceCategory';

export default {
  async mounted () {
    this.categories = await getCategories(
      ).then(req => {
        req.data['hydra:member'].forEach(category => {
          category.showModify = false;
        });
        return req.data['hydra:member']
      })
    await this.sendGetWorksRequest()
    this.newCategory = this.categories[0]
  },

  data: function () {
    return {
      works: {},
      categories: {},
      newLibelle: '',
      newCategory: null,
      modifyInput: '',
      findWork: '',
      addButtonShow: false
    }
  },

  methods: {

    addWork: async function() {
      this.addButtonShow = true;
      console.log({
        title: this.newLibelle,
        like_count: 0,
        category: this.newCategory
      })
      await postWork({
        title: this.newLibelle,
      })
      await this.sendGetWorksRequest()
      this.newLibelle = ''
      this.addButtonShow = false;
    },

    sendGetWorksRequest: async function() {
      this.works = await getWorks(
      ).then(req => {
        req.data['hydra:member'].forEach(work => { 
          work.showModify = false;
          if(work.category) work.categoryId = parseInt(work.category.split('/')[work.category.split('/').length - 1])
          this.getWorkCategoryName(work)
        });
        return req.data['hydra:member']
      })
    },

    removeWork: function(work) {
      deleteWork(work.id)
      let index = 0;
      let id = 0;
      this.works.forEach((w) => {
        if(w === work) {
          index = id;
        }
        id++;
      })
      this.works.splice(index, 1)
    },

    showModify: function(work) {
      this.works.forEach((work) => {
        work.showModify = false;
      });
      this.modifyInput = '';
      work.showModify = !work.showModify;
    },

    sendModify: function(work) {
      putWork(work.id, {title: this.modifyInput})
      work.title = this.modifyInput
      this.modifyInput = ''
      work.showModify = false
    },

    getWorkCategoryName: function(work) {
      this.categories.forEach((category) => {
        if(category.id === work.categoryId){
          work.categoryName = category.name
        }
      })
    },

  },
}
</script>

<style scoped>

</style>
