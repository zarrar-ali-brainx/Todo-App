<template>

  <div class="register-view">


  <form  @submit.prevent="saveData">
    <h2>Register</h2>

    <label>First Name</label>
        <input type="text" v-model="user.name" name="name" id="name" class ="form-control"/>


        <label>Email</label>
        <input type="email" v-model="user.email" name="email" id="email" class ="form-control"/>

        <label>Password</label>
        <input type="password" v-model="user.password" name="password" id="password" class ="form-control"/>


    <button type="submit" value="Save" >Register</button>

        <span>Already have an account? <a href="Login"> Log In</a></span>


      </form>
    </div>

</template>



<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const user = ref({
  name: '',
  email: '',
  password: ''
});
const router1 = useRouter();
const saveData = () => {
  axios.post('http://127.0.0.1:8000/api/register', user.value)
      .then(({ data }) => {
        console.log(data);
        try {
          router1.push({name: 'Login'});
        } catch (err) {
          alert('failed');
        }
      });
};
</script>

<style scoped>

h2{
  font-size: x-large;
  font-weight: bold;
}
form{
  width: 400px;
  background-color: #ececec;
  border-radius: 10px;
  border: 2px solid rgba(255, 255, 255, 0.1);
  padding: 50px 35px;
  margin-left: 50%;
}
form * {
  letter-spacing: 0.5px;
}
label{
  display: block;
  margin-top: 20px;
  font-size: 16px;
  font-weight: 500;

}
input{
  display: block;
  height: 50px;
  width: 100%;
  border-radius: 3px;
  padding: 0 10px;
  margin-top: 8px;
  font-size: 16px;
  font-weight: 300;
}
button{
  margin-top: 50px;
  width: 100%;
  background-color: rgba(0, 46, 173, 0.7);
  color: #ffffff;
  padding: 15px 0;
  font-size: 18px;
  font-weight: 600;
  border-radius: 5px;
  cursor: pointer;
}
form span{
  display: block;
  margin-top: 35px;
}
a{
  color: rgba(0, 46, 173, 0.8);
}
</style>