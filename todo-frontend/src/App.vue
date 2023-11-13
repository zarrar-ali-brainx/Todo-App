<script setup>
import { RouterLink, RouterView } from 'vue-router'
import addItemForm from './components/addItemForm.vue'
import HelloWorld from './components/HelloWorld.vue'
import Register from "@/components/Register.vue";
import listView from './components/listView.vue'
import Home from "@/components/Home.vue";
import router from "@/router";

const token = window.localStorage.getItem('api_token');
if(token){
  router.push({name: 'Home'});
}else {
  router.push({name: 'Login'})
}

</script>

<template>


<router-view></router-view>

</template>

<style scoped>



</style>
