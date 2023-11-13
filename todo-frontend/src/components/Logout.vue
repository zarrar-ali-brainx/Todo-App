<script setup>
import axios from "axios";
import {useRouter} from "vue-router";
const router2 = useRouter();


const logout = async () => {
  try {
    const apiToken = localStorage.getItem("api_token");
    if (apiToken) {
      const headers = {
        Authorization: `Bearer ${apiToken}`,
      };
      // await axios.post('http://127.0.0.1:8000/api/logout', null, { headers });
      window.localStorage.removeItem("api_token");
      await router2.push({ name: 'Login' });
    } else {
      console.error('Access token not found');
    }
  } catch (error) {
    console.error('Logout failed', error);
  }
}


</script>

<template>
  <button @click="logout" class="btn btn-danger">Logout</button>

</template>

<style scoped>

</style>