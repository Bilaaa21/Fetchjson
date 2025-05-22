import { createRouter, createWebHistory } from 'vue-router'; 
import Home from '@/pages/Home.vue';
import Posts from '@/components/Posts.vue';
import PostsView from '@/components/PostsView.vue';
import PostsAdd from '@/components/PostsAdd.vue';
import PostsEdit from '@/components/PostsEdit.vue';
import Login from '@/components/login.vue'; 

const routes = [
    { path: '/', redirect: '/login' }, // ⬅️ Arahkan awal ke login
    { path: '/login', name: "login", component: Login },
    { path: '/home', name: "home", component: Home },
    { path: '/posts', name: "posts", component: Posts },
    { path: '/posts/:id', name: "postsView", component: PostsView },
    { path: '/posts/add', name: "postsAdd", component: PostsAdd },
    { path: '/posts/edit/:id', name: "postsEdit", component: PostsEdit },
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

// ⬇️ Optional: Lindungi semua route kecuali login
router.beforeEach((to, from, next) => {
    const isLoggedIn = !!localStorage.getItem('user');

    if (to.path !== '/login' && !isLoggedIn) {
        next('/login');
    } else {
        next();
    }
});

export default router;