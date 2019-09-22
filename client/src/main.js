import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';
import BookList from "./components/BookList";
import AddBook from "./components/AddBook";
import EditBook from "./components/EditBook";

Vue.config.productionTip = false;
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: [
        {path: '/', component: BookList},
        {path: '/add', component: AddBook},
        {path: '/edit/:id', component: EditBook}
    ]}
);

new Vue({
    router,
    render: h => h(App),
}).$mount('#app')