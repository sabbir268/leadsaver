import Vue from 'vue'
import VueRouter from 'vue-router'
import LeadFrom from "./components/LeadForm.vue"
import LeadOverView from "./components/LeadOverView.vue"
import Sheet from "./views/Sheet.vue"

Vue.use(VueRouter)




const routes = [
    {
        path: '/',
        component: LeadOverView
    },
    {
        path: '/sheets',
        component: Sheet
    },
]



const router = new VueRouter({
    routes, // short for `routes: routes`,
    hashbang: false,
    mode: 'history'
})


export default router
