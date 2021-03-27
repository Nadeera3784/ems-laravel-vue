const app = new Vue({
    el: '#app',
});


import Vue from 'vue'
import Vuetable from 'vuetable-2'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import VueSimpleAlert from "vue-simple-alert";

import App from './components/App.vue';
import EmployeComponent from './components/EmployeComponent.vue';
import AddEmployeComponent from './components/AddEmployeComponent.vue';
import UpdateEmployeComponent from './components/UpdateEmployeComponent.vue';

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(VueSimpleAlert);

const router = new VueRouter({
        mode: 'history',
        routes: [
            {
              path: '/',
              redirect: '/em/index'
            },
            {
                path: '/em/index',
                name: 'home',
                component: EmployeComponent
            },
            {
                path: '/em/create',
                name: 'create',
                component: AddEmployeComponent
            },
            {
                path: '/em/update/:id',
                name: 'update',
                component: UpdateEmployeComponent
            }    
        ],
 })

new Vue({
  render: h => h(App),
  router,
}).$mount('#app');
