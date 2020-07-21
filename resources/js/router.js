import Vue from 'vue'
import VueRouter from 'vue-router'
import LeadFrom from "./components/LeadForm.vue"
import LeadOverView from "./components/LeadOverView.vue"

Vue.use(VueRouter)




const routes = [
    {
        path: '/',
        component: LeadOverView
    },
    {
        path: '/create',
        component: LeadFrom
    },
]



const router = new VueRouter({
    routes, // short for `routes: routes`,
    hashbang: false,
    mode: 'history'
})


export default router
