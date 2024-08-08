<template>
    <section>
        <div class="row">
            <div class="col-md-3 d-flex flex-column gap-2">
                <div class="card cursor-pointer" :class="{ 'bg-primary text-white fw-bolder': currentTab === 'details' }"
                     @click="setActiveTab('details')">
                    <div class="card-body p-4">
                        Home Page Setting
                    </div>
                </div>

                <div class="card cursor-pointer" :class="{ 'bg-primary text-white fw-bolder': currentTab === 'headerPages' }"
                     @click="setActiveTab('headerPages')">
                    <div class="card-body p-4">
                        Top-bar Page
                    </div>
                </div>
                <div class="card cursor-pointer" :class="{ 'bg-primary text-white fw-bolder': currentTab === 'topBarText' }"
                     @click="setActiveTab('topBarText')">
                    <div class="card-body p-4">
                        Top-bar Text
                    </div>
                </div>

                <div class="card cursor-pointer" :class="{ 'bg-primary text-white fw-bolder': currentTab === 'posPaymentMethods' }"
                     @click="setActiveTab('posPaymentMethods')">
                    <div class="card-body p-4">
                        Pos Payment Methods
                    </div>
                </div>

                <RouterLink to="/setting/footer-setting" class="card cursor-pointer"
                            @click="setActiveTab('details')">
                    <div class="card-body p-4">
                        Footer Setup
                    </div>
                </RouterLink>
            </div>
            <div class="col-md-9">
                <div class="card" v-if="currentTab === 'details'">
                    <div class="card-header d-flex gap-2">
                        <h3 class="card-title m-0">Product Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md form-group">
                                <label>Nav Bar Categories</label>
                                <TreeCategory v-model="settings.navCats" multiple/>
                            </div>
                            <div class="col-md form-group">
                                <label>Home Cats</label>
                                <TreeCategory v-model="settings.homeCats" multiple/>
                            </div>
                        </div>
                        <button class="btn btn-primary fw-bold" @click="saveSetting">Save Setting</button>
                    </div>
                </div>
                <div class="card" v-if="currentTab === 'headerPages'">
                    <div class="card-header d-flex gap-2">
                        <h3 class="card-title m-0">Top-bar Page Setup</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <v-select
                                v-model="settings.headerPages"
                                :options="pages" multiple
                                class="form-control h-auto"
                                :reduce="page => page.id"
                                label="title"
                                placeholder="Select Page..."/>
                        </div>
                        <button class="btn btn-primary fw-bold mt-5" @click="saveSetting">Save Setting</button>
                    </div>
                </div>
                <div class="card" v-if="currentTab === 'topBarText'">
                    <div class="card-header d-flex gap-2">
                        <h3 class="card-title m-0">Top-bar Page Setup</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <input type="text" v-model="settings.topBarText" class="form-control" placeholder="Top Bar Text...."/>
                        </div>
                        <button class="btn btn-primary fw-bold mt-5" @click="saveSetting">Save Setting</button>
                    </div>
                </div>
                <div class="card" v-if="currentTab === 'posPaymentMethods'">
                    <div class="card-header d-flex gap-2">
                        <h3 class="card-title m-0">Pos Payment Method</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <input type="text" v-model="settings.posPaymentMethods" class="form-control" placeholder="e.g Separating By |"/>
                        </div>
                        <button class="btn btn-primary fw-bold mt-5" @click="saveSetting">Save Setting</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script setup>
import {onMounted, ref} from "vue";
import useApi from "@/composables/useApi.js"
import TreeCategory from "@/components/TreeCategory.vue";

const {sendRequest} = useApi();

const settings = ref({
    navCats: [],
    homeCats: [],
    headerPages: [],
    topBarText: '',
    posPaymentMethods:''
})

const pages = ref([])


const saveSetting = () => {
    sendRequest({
        url: "/api/admin/save-setting",
        method: "POST",
        data: settings.value
    })

    Toast.fire({
        icon: 'success',
        title: "Setting Update Success..."
    });
}

const getSettings = async () => {
    const data = await sendRequest("/api/admin/get-setting");
    settings.value = data?.bSettings
}
const getPages = async () => {
    pages.value = await sendRequest('api/pages')
}

onMounted(async () => {
    await getSettings()
    await getPages()
})


const currentTab = ref('details')
const setActiveTab = (event) => currentTab.value = event
</script>

<style></style>
