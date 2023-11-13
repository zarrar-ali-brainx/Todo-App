<script setup>
import { ref } from 'vue';
import axios from "axios";
const emit = defineEmits(['reloadList','itemChanged']);
const item = ref({
  name: '',


});


const addItem = () => {
  if (item.value.name === '') {
    return;
  }
  postItem();
};
const postItem =  (itemName) => {
  const accessToken = localStorage.getItem('api_token');

  axios.post('http://127.0.0.1:8000/api/item/store', item.value, {
    headers: {
      Authorization: `Bearer ${accessToken}`,
    },
  })
      .then(response => {
        console.log(response.data.message);

          item.value.name = '';
             emit('reloadList');
             // emit('itemChanged');
                 })
      .catch(error => {
        console.error('Error creating todo item:', error);
        // Handle errors
      });
};


</script>


<template>
<div class="addItem">
  <input v-on:keyup.enter="addItem()"  type="text" v-model="item.name"/>
  <button class="btn " @click="addItem()" :class="[item.name ? 'btn-success' : 'inactive', 'btn-secondary']">Add</button>
</div>
</template>

<style scoped>
.addItem{
  display: flex;

}
input{
  background: #f7f7f7;
  border: 0px;
  outline: none;
  padding: 5px;
  margin-right: 10px;
  width: 100%;
}

</style>