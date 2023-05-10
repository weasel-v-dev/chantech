import Vue from "vue";

import Router from "vue-router";

Vue.use(Router);

let router = new Router({
    mode: "history",
    base: "dashboard",
    routes: [
        {
            path: "/",
            name: "dashboard",
            component: () => import("./views/Dashboard"),
            meta: {
                requiresAuth: true,
            }
        }
    ]
});



export default router;
