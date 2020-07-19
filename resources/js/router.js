import Vue from 'vue'
import VueRouter from 'vue-router'
import leadFrom from "./components/leadForm.vue"

Vue.use(VueRouter)




const routes = [
    {
        path: '/create',
        component: leadFrom
    },
]



const router = new VueRouter({
    routes, // short for `routes: routes`,
    hashbang: false,
    mode: 'history'
})


export default router
