import VueRouter from 'vue-router'
import Baic from './components/index/Baic'
import Login from './components/login/login'
const routes = [{
    path: '/off/index',
    component: Login,
    children: [{
        path: '/off/index',
        component: Login
    }],
    children: [{
        path: '/off/baic',
        component: Baic
    }]
}];

export default new VueRouter({
    mode: 'history',
    routes
});