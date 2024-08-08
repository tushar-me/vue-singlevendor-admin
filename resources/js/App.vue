<template>
    <Component :is="currentLayout" v-if="$route">
        <RouterView :key="$route.fullPath" />
    </Component>


<!--    <div class="whatsapp_chat">-->
<!--        <div class="icon-sectoin">-->
<!--            <a href="https://wa.me/+61450855949?text=Welcome+To+AMCPaedia. +How+can+I+help+you+?">-->
<!--                <img src="@/assets/images/whatsapp.svg"/>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->

</template>

<script setup>
import { useRoute, RouterView } from 'vue-router'
import { computed, onMounted, ref } from 'vue'
import Default from './layouts/AuthLayout.vue';
import Guest from './layouts/Guest.vue';
// import { useAuthStore } from './stores/useAuthStore';

const layouts = new Map([
    [ 'defaultLayout', Default ],
    [ 'authLayout', Guest ]
])

const route = useRoute()
let currentLayout = computed(() =>
    layouts.get(`${route.meta.layout || 'auth'}Layout`)
)

const show = ref(true)

// onMounted(async ()=>{
//     const authStore = useAuthStore();
//     setTimeout(async () => {
//         show.value = false;
//         await authStore.fetchUser();
//     }, 5000);
// })

</script>

<style>
.whatsapp_chat{
    position: fixed;
    bottom: 2rem;
    right: 2rem;
}
.whatsapp_chat .icon-sectoin img{
    width: 50px;
}

</style>
