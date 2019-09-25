import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';
import BookList from "./components/Book/BookList";
import AddBook from "./components/Book/AddBook";
import EditBook from "./components/Book/EditBook";
import Toasted from 'vue-toasted'
import NotFound from "./components/Common/NotFound";

Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(Toasted);

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: [
        {path: '/', component: BookList},
        {path: '/add', component: AddBook},
        {path: '/edit/:id', component: EditBook},
        {path: '*', component: NotFound}
    ]}
);

Vue.filter();

new Vue({
    router,
    render: h => h(App),
}).$mount('#app')
