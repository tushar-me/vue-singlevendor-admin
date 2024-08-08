<script setup>
import {computed, onMounted, ref, watch} from 'vue';
import TreeCategory from "@/components/TreeCategory.vue";

import useAxios from "@/composables/useApi.js";

const {sendRequest, loading, error} = useAxios();

const customPages = ref([
    {
        title: '',
        pages: [],
        status: true,
    }
])

let addRow = () => {
    customPages.value.push({
        title: '',
        pages: [],
        status: true,
    })
}
let deleteRow = (index) => {
    if (customPages.value.length > 1)
        customPages.value.splice(index, 1)
}


const updateSettings = () => {
    sendRequest({
        url: "/api/admin/save-setting",
        method: "POST",
        data: {footerPages: customPages.value}
    })

    Toast.fire({
        icon: 'success',
        title: "Setting Update Success..."
    });
}


const pages = ref([])
onMounted(async () => {
    pages.value = await sendRequest('/api/pages')
    const settings = await sendRequest("/api/admin/get-setting")
    if(settings?.bSettings?.footPages)
        customPages.value = settings?.bSettings?.footPages;
})

</script>

<template>
    <div class="row">
        <div class="col-md-6" v-for="(value, index) in customPages">
            <div class="card mb-5">
                <div class="card-body position-relative imgContainer">
                    <h2 class="card-title">Section {{ index + 1 }}</h2>
                    <div class="mt-1">
                        <input type="text" v-model="customPages[index].title" class="form-control mb-1"
                               placeholder="e.g title">
                        <v-select :options="pages"
                                  :reduce="page => page.id"
                                  v-model="customPages[index].pages"
                                  label="title" class="form-control"
                                  placeholder="Select Pages" multiple/>
                    </div>
                    <button
                        v-if="index === customPages.length - 1"
                        class="btn btn-primary btn-sm float-end mt-25"
                        type="button"
                        name="button"
                        @click="addRow">
                        <span class="svg-icon svg-icon-white svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                    <rect fill="#000000" opacity="0.3"
                                          transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "
                                          x="4" y="11" width="16" height="2" rx="1"/>
                                </g>
                            </svg>
                        </span>
                    </button>
                    <button
                        class="btn btn-danger btn-sm float-end mt-25 me-1"
                        @click="deleteRow(index)"
                        type="button">
                        <span class="svg-icon svg-icon-white svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z"
                                        fill="#000000" fill-rule="nonzero"/>
                                    <path
                                        d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                        fill="#000000" opacity="0.3"/>
                                </g>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row" v-if="!loading">
        <div class="col">
            <div class="card bg-light-success cursor-pointer" @click="updateSettings">
                <div class="card-body d-flex align-customPages-center justify-content-center">
                    <h3 class="text-success">Update Setting</h3>
                </div>
            </div>
        </div>
        <div class="col">
            <RouterLink to="/setting" class="card bg-light-danger cursor-pointer">
                <div class="card-body d-flex align-customPages-center justify-content-center">
                    <h3 class="text-danger">Cancel Setting</h3>
                </div>
            </RouterLink>
        </div>
    </div>
</template>


