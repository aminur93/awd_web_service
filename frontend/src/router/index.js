import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

/*import router*/
import AuthRouter from "./auth/AuthRouter";
import AdminRouter from "./admin/AdminRouter";

/*route route-list*/

const routes =[
    ...AuthRouter,
    ...AdminRouter
]

const router = new VueRouter({
    mode:'history',
    routes:routes
});

export default router