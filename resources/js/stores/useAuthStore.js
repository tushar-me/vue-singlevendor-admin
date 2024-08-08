import { defineStore } from 'pinia'
import {ref, computed, onMounted} from "vue"
import useAxios from "@/composables/useApi.js";
import { useRouter } from 'vue-router';
const {loading,error,sendRequest,} = useAxios();

export const useAuthStore = defineStore('auth', ()=>{

    const router = useRouter();
    const user = ref(JSON.parse(localStorage.getItem("user")) ?? null)
    const isLoggedIn = computed(() => !! user.value)

    async function fetchUser(){
        const user = JSON.parse(await getLocalStoreage());
        if(user){
            const data = await sendRequest({
                method: 'get',
                url: "/api/user",
                headers:{
                    "Authorization": `Bearer ${user?.token}`
                }
            })
            if(data?.data){
                user.value = data?.data
            }else{
                await clearLocalStoreage();
            }
        }else{
            await clearLocalStoreage();
        }


    }

    async function login(credential){
        await sendRequest({
            method: 'get',
            url: "/sanctum/csrf-cookie",
        })

        const login = await sendRequest({
            method:"POST",
            url:"/api/login",
            data:credential
        })

        await setLocalStoreage(login.data?.data)
        user.value = login.data?.data

        return login;
    }

    async function signup(signupData){
        const singup = await sendRequest("/register")
        console.log(singup)
        return singup;
    }

    async function logout(){
        await sendRequest({
            url:"/api/logout",
            method:"GET"
        })

        user.value = null;
        await clearLocalStoreage();
        router.push({name:"home"})
    }

    async function setLocalStoreage(user){
        localStorage.setItem('user', JSON.stringify(user));
    }

    async function clearLocalStoreage(){
        localStorage.removeItem('user');
    }

    async function getLocalStoreage(){
        return localStorage.getItem('user');
    }

    function getToken(){
        return JSON.parse(localStorage.getItem("user"))?.token;
    }

    return {user, login, signup, isLoggedIn, fetchUser, logout, loading, error, getLocalStoreage, getToken}

})
