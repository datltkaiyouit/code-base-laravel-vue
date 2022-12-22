import {createRouter, createWebHistory} from "vue-router";

// Layouts
import AuthLayout from "../view/admin/layouts/auth/AuthLayout.vue";
import MainLayout from "../view/admin/layouts/main/MainLayout.vue";

//Pages
const LoginPage = () => import('../view/admin/pages/auth/login/Login.vue')

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/auth',
      name: 'routes.auth',
      component: AuthLayout,
      redirect: {name: 'routes.auth.login'},
      meta: {requiredAuth: false},
      children: [
        {
          path: 'login',
          name: 'routes.auth.login',
          meta: {requiredAuth: false},
          component: LoginPage
        }
      ]
    }
  ]
})

export default router
