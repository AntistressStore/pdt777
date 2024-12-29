import { createRouter, createWebHistory } from "vue-router";

const routes = [
	{
		path: "/",
		component: () => import("./Pages/Houses.vue"),
	},
];

export default createRouter({
	history: createWebHistory(),
	routes,
});
