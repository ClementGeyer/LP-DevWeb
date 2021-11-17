<template>
  <ul>
    <!-- Boucle dans template (v-for) -->
    <li v-for="(note, matiere) in notes" :key="matiere">Note sur {{matiere}} : {{ note }}
      <p v-if="note >= 10">Admis</p>
      <p v-else>Non-admis</p>
    </li>
  </ul>
  <!-- Changer la note Symfony -->
  <input type="text" v-model.number="notes.Symfony">
  <!-- Accéder aux fonctions computed juste avec le nom -->
  <p>Moyenne notes : {{calculerMoyenne}}</p>
  <!-- Condition dans template (v-if /  v-else) -->
  <p v-if="calculerMoyenne > 10">Bonne moyenne :)</p>
  <!-- Lié directement au v-if précedent -->
  <p v-else>Mauvaise moyenne :(</p>
  <Search/>
</template>

<script>
import Search from './components/Search.vue';

export default {
  name: 'App',
  data: () => {
    return {
      notes: {
        "Symfony": 12,
        "Réseau": 14,
        "Intégration": 8,
        "Maths": 19,
        "Anglais": 12
      }
    }
  },
  // Fonctions accesibles dans template
  computed: {
    calculerMoyenne: function(){
      let moy = 0;
      for(let matiere in this.notes){
        moy += this.notes[matiere];
      }
      //Object keys récupère les clés de l'objet this.notes
      return moy / Object.keys(this.notes).length;
    }
  },
  // Importer des composants
  components: {
    Search
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
</style>
