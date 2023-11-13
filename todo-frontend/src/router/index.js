import { createRouter, createWebHistory } from 'vue-router'
import Register from "@/components/Register.vue";
import Login from "@/components/Login.vue";
import Home from "@/components/Home.vue";
import App from "@/App.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: '/',
    //   name: 'home',
    //   component: HomeView
    // },

    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },




    {
      path: '/home',
      name: 'Home',
      component: Home,
      meta: {requiresAuth: true},
    }

  ]
})
// router.beforeEach((to, from, next) => {
//   const isAuthenticated = localStorage.getItem("access_token"); // Check if the user is logged in
//
//   if (to.matched.some((record) => record.meta.requiresAuth) && !isAuthenticated) {
//     next({ name: "Login" });
//   } else {
//     next();
//   }
// });



router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    if (!window.localStorage.getItem("api_token")) {
      next({
        name: "Login"

      })
      console.log('Your have to login First');
    } else {
      next()
    }
  } else next()
})
export default router
