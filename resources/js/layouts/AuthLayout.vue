<template>
    <div>
        <!--end::Header Mobile-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">
                <!--begin::Aside-->
                <Sidebar/>
                <!--end::Aside-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <Header/>
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Entry-->
                        <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container">
                                <!--end::Dashboard-->
                                <router-view></router-view>
                                <!--begin::Dashboard-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import Header from "@/components/Header.vue"
import Sidebar from "@/components/Sidebar.vue"
import useAxios from "@/composables/useApi";

const isLogined = ref(false)
onMounted(async () => {

    const { loading,  error, sendRequest,} = useAxios();

    isLogined.value = User.loggedIn();
    const router = useRouter();

    let userInfo = User.userInfo()

    const user = await sendRequest({
        url: `/api/user`,
        headers: {
            "Authorization": `Bearer ${userInfo?.token}`
        }
    });

    if(!user){
        localStorage.removeItem('_user')
        await router.push({name: 'Login'})
    }
})
</script>

<style scoped></style>
