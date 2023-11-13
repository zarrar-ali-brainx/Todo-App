<script setup>
import {ref, onMounted, toRefs} from 'vue';
import { RouterLink, RouterView } from 'vue-router';
import AddItemForm from "@/components/addItemForm.vue";
import ListView from "@/components/listView.vue";
import axios from "axios";
import Logout from "@/components/Logout.vue";
const items = ref([]);
const { reloadList } = defineEmits(['reloadList']);
const accessToken = localStorage.getItem('api_token');

const getList = () => {
  axios.get('http://127.0.0.1:8000/api/items',{
    headers: {
      Authorization: `Bearer ${accessToken}`,
    },
  })
      .then(response => {
        items.value = response.data;

      })
      .catch(error =>{
        console.log(error);
      });
};

onMounted(getList);

</script>



<template>

  <div class="todoListContainer">
    <Logout/>
    <div class="heading">
      <h2 id="title">Todo List</h2>
      <AddItemForm
          :items="items"
      @reloadList="getList"/>

    </div>
    <listView :items="items"
                @reloadList="getList"/>
  </div>
</template>

<style scoped>
.todoListContainer{
  display: block;
  justify-content: center;
  align-items: center;
  width: 400px;
  background-color: #ececec;
  margin-left: 50%;
  border-radius: 10px;
  border: 2px solid rgba(255, 255, 255, 0.1);
  padding: 50px 35px;}
.heading{
  padding: 10px;
}
#title{
  text-align: center;
}
@media screen and (max-width: 1024px) {
  .todoListContainer{
  margin-left: 25%;
  }
}
@media screen and (max-width: 560px) {
  .todoListContainer{
    margin-left: 0;
  }
}


</style>