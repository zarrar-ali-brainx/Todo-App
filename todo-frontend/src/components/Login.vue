<template>



        <form @submit.prevent="loginData">

          <h2>Login</h2>

          <label>Email</label>
          <input type="email" v-model="user.email" class="form-control"  placeholder="Email"/>


          <label>Password</label>
          <input type="password" v-model="user.password" class="form-control"  placeholder="Password"/>

            <button type="submit" class="btn btn-primary">Login</button>
            <span>Didn't have an account? <a href="Register">Register</a> </span>
        </form>


</template>


<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import Home from "@/components/Home.vue";
import Login from "@/components/Login.vue";
const user = ref({
  email: '',
  password: ''
});

const router = useRouter();

const loginData = () => {
  axios.post('http://127.0.0.1:8000/api/login', user.value)
      .then(({ data }) => {
        console.log(data);
        try {
          if (data.status === true) {
            window.localStorage.setItem("api_token", data.access_token);
            router.push({ name: 'Home' });
          } else {
            alert('Login failed');
          }
        } catch (err) {
          console.log('error');
        }
      });
};


</script>
<style scoped>

form{
  display: block;
  justify-content: center;
  align-items: center;
  width: 400px;
  background-color: #ececec;
  margin-left: 50%;
  border-radius: 10px;
  border: 2px solid rgba(255, 255, 255, 0.1);
  padding: 50px 35px;
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
@media screen and (max-width: 1024px) {
  form {
margin-right: 50%  }
}
</style>