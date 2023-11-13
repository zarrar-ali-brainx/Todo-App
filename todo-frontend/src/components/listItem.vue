<script setup>
import axios from "axios";
import {ref} from "vue";
const emit = defineEmits(['itemChanged','isEditing']);

const { item } = defineProps(["item"]);
const isEditing = ref(false);
const editedItem = ref({ ...item });

const updateCheck = () => {
  axios.put(`http://127.0.0.1:8000/api/item/${item.id}` )
      .then(response => {

      })
      .catch(error => {
        console.log(error);
      });
};
const removeItem = () => {
  axios.delete(`http://127.0.0.1:8000/api/item/${item.id}`)
      .then(response =>{
          emit('itemChanged');
      })
      .catch(error =>{
        console.log(error);
      })
}


const editItem = () => {
  isEditing.value = true;
};
const saveEdit = () => {
  const accessToken = localStorage.getItem('api_token');
  console.log('Edit Item Data:', { name: item.name });

  // Send a POST request to update the item with the data in editedItem
  axios
      .post(`http://127.0.0.1:8000/api/item/${item.id}`, { name: item.name }, {
        headers: {
          Authorization: `Bearer ${accessToken}`,
        },
      })
      .then((response) => {
        if (response.status === 200) {
          emit('isEditing');
          emit('itemChanged');

          isEditing.value = false;
        }
      })
      .catch((error) => {
        console.log(error);
      });
};

const cancelEdit = () => {
  isEditing.value = false;
};


</script>


<template>



    <div class="item">
      <div class="initial" v-if="!isEditing">
        <input type="checkbox" @change="updateCheck()" v-model="item.completed" />
        <span :class="[item.completed ? 'completed' : '', 'itemText']">{{ item.name }}</span>
        <button @click="editItem()" class="btn btn-primary">Edit</button>
        <button @click="removeItem()" class="btn btn-danger">Delete</button>
      </div>

      <div class="editing" v-else >
        <input v-model="item.name" />
        <button class="btn btn-success" @click="saveEdit">Save</button>
        <button class="btn btn-info" @click="cancelEdit">Cancel</button>
      </div>
    </div>
  </template>

<style scoped>
.completed{
  text-decoration: line-through;
  color: #999999;
}
.itemText{
  width: 100%;
  margin-left: 20px;
}

.initial{
  display: flex;
  justify-content: center;
  align-items: center;
}
.initial>input{
  display: flex;
  justify-content: center;
  align-items: start;

}
.editing>input{
  width: 90%;
  margin-left: 15px;
  margin-bottom: 5px;
  background: #f7f7f7;
  outline: none;
  border: none;
  border-radius: 3px;
}
.btn{
  font-size: small;
  padding-left: 7px;
  padding-right: 7px;
  margin-right: 4px;
}
.btn-info{
  color: white;
}
.btn-success{
  margin-left: 15px;
}
</style>