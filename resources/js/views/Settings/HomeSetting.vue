<script setup>
import layout from "../../Shared/Layout.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import debounce from "lodash/debounce";
import {computed, onMounted, ref, watch} from 'vue';
import OffcanvasCom from "../../components/Offcanvas.vue";
import {Inertia} from "@inertiajs/inertia";
import {useSlug} from '../../Composables/useSlug.js'
import {Tooltip} from 'bootstrap'
import ImageUploader from "../../components/ImageUploader.vue";
import Swal from "sweetalert2";
import axios from "axios";
import {Offcanvas} from 'bootstrap';
import Pagination from "../../components/Pagination.vue";
import {useAction} from '../../Composables/useAction.js';
import Switch from "../../components/Switch.vue";

const props = defineProps({
    products:[]|null,
    categories:[]|null,
    brands:[]|null,
    advised:[]|null,
    main_url:String|null,
    homeSettings:Array|null,
})

const formData = useForm({
    add1:{
        title:props.homeSettings?.add1?.title ?? null,
        status:props.homeSettings?.add1?.status ?? null,
        items:props.homeSettings?.add1?.items ?? null,
    },
    add2:{
        title:props.homeSettings?.add2?.title ?? null,
        status:props.homeSettings?.add2?.status ?? null,
        items:props.homeSettings?.add2?.items ?? null,
    },
    categories1:{
        title:props.homeSettings?.topCategories?.title ?? null,
        status:props.homeSettings?.topCategories?.status ?? null,
        items:props.homeSettings?.topCategories?.items ?? null,
    },
    add3:{
        title:props.homeSettings?.add3?.title ?? null,
        status:props.homeSettings?.add3?.status ?? null,
        items:props.homeSettings?.add3?.items ?? null,
    },
    topProducts:{
        title:props.homeSettings?.topProducts?.title ?? null,
        status:props.homeSettings?.topProducts?.status ?? null,
        items:props.homeSettings?.topProducts?.items ?? null,
    },
    add4:{
        title:props.homeSettings?.add4?.title ?? null,
        status:props.homeSettings?.add4?.status ?? null,
        items:props.homeSettings?.add4?.items ?? null,
    },
    categories2:{
        title:props.homeSettings?.homeCategories?.title ?? null,
        status:props.homeSettings?.homeCategories?.status ?? null,
        items:props.homeSettings?.homeCategories?.items ?? null,
    },
    add5:{
        title:props.homeSettings?.add5?.title ?? null,
        status:props.homeSettings?.add5?.status ?? null,
        items:props.homeSettings?.add5?.items ?? null,
    }
})

const isLoding = ref(false);


let updateSettings = () =>{
    formData.post(props.main_url, {
        onSuccess: (res)=>{
            $sToast.fire({
                icon: "success",
                text: "Business Settings Update Successfully Done.:)",
            });
        },
        onError: (res) =>{
            $sToast.fire({
                icon: "error",
                text: "Business Settings Not Update (:",
            });
        }
    });
}
</script>

<template>
    <layout>
        <div class="row">
<!--            <div class="col-md-4">
                <div class="card">
                    <div class="card-body position-relative imgContainer">
                        <h2 class="card-title">Add banners 1</h2>
                        <div class="mt-1">
                            <input type="text" v-model="formData.add1.title" class="form-control mb-1" placeholder="e.g title">
                            <vSelect :options="props.advised"
                                     :reduce="item => item.id"
                                     v-model="formData.add1.items"
                                     multiple
                                     label="title"
                                     placeholder="e.g Select Products For Ads">
                                <template v-slot:option="option">
                                    <li class="d-flex align-items-start py-1">
                                        <img :src="option.image" alt="" width="50" height="50">
                                        <div class="ms-1">
                                            <h6 class="mb-25">{{ option.title.slice(0, 30) }}</h6>
                                            <span>{{ option.discount_price ?? 0 }} {{ option.discount_type === 'flat' ? '৳' : '%' }}</span>
                                        </div>
                                    </li>
                                </template>
                            </vSelect>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mt-1">
                                <label>Show Status</label>
                                <Switch v-model="formData.add1.status" class="justify-content-start" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body position-relative imgContainer">
                        <h2 class="card-title">Add banners 2</h2>
                        <div class="mt-1">
                            <input type="text" v-model="formData.add2.title" class="form-control mb-1" placeholder="e.g title">
                            <vSelect :options="props.advised"
                                     v-model="formData.add2.items"
                                     :reduce="item => item.id"
                                     multiple
                                     label="title"
                                     placeholder="e.g Select Products For Ads">
                                <template v-slot:option="option">
                                    <li class="d-flex align-items-start py-1">
                                        <img :src="option.image" alt="" width="50" height="50">
                                        <div class="ms-1">
                                            <h6 class="mb-25">{{ option.title.slice(0, 30) }}</h6>
                                            <span>{{ option.discount_price ?? 0 }} {{ option.discount_type === 'flat' ? '৳' : '%' }}</span>
                                        </div>
                                    </li>
                                </template>
                            </vSelect>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mt-1">
                                <label>Show Status</label>
                                <Switch v-model="formData.add2.status" class="justify-content-start" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body position-relative imgContainer">
                        <h2 class="card-title">Home Categories</h2>
                        <div class="mt-1">
                            <input type="text" v-model="formData.categories1.title" class="form-control mb-1" placeholder="e.g title">
                            <vSelect :options="props.categories"
                                     :reduce="item => item.id"
                                     multiple
                                     v-model="formData.categories1.items"
                                     label="title"
                                     placeholder="e.g Select Products For Ads">
                                <template v-slot:option="option">
                                    <li class="d-flex align-items-start py-1">
                                        <img :src="option.icon" alt="" width="50" height="50">
                                        <div class="ms-1">
                                            <h6 class="mb-25">{{ option.title.slice(0, 30) }}</h6>
                                        </div>
                                    </li>
                                </template>
                            </vSelect>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mt-1">
                                <label>Show Status</label>
                                <Switch v-model="formData.categories1.status" class="justify-content-start" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body position-relative imgContainer">
                        <h2 class="card-title">Add banners 3</h2>
                        <div class="mt-1">
                            <input type="text" v-model="formData.add3.title" class="form-control mb-1" placeholder="e.g title">
                            <vSelect :options="props.advised"
                                     :reduce="item => item.id"
                                     v-model="formData.add3.items"
                                     multiple
                                     label="title"
                                     placeholder="e.g Select Products For Ads">
                                <template v-slot:option="option">
                                    <li class="d-flex align-items-start py-1">
                                        <img :src="option.image" alt="" width="50" height="50">
                                        <div class="ms-1">
                                            <h6 class="mb-25">{{ option.title.slice(0, 30) }}</h6>
                                            <span>{{ option.discount_price ?? 0 }} {{ option.discount_type === 'flat' ? '৳' : '%' }}</span>
                                        </div>
                                    </li>
                                </template>
                            </vSelect>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mt-1">
                                <label>Show Status</label>
                                <Switch v-model="formData.add3.status" class="justify-content-start" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body position-relative imgContainer">
                        <h2 class="card-title">Top Seals Products</h2>
                        <div class="mt-1">
                            <input type="text" v-model="formData.topProducts.title" class="form-control mb-1" placeholder="e.g title">
                            <vSelect :options="props.products"
                                     :reduce="item => item.id"
                                     v-model="formData.topProducts.items"
                                     multiple
                                     label="title"
                                     placeholder="e.g Select Products For Ads">
                                <template v-slot:option="option" v-c-tooltip="option.slogan ?? ''">
                                    <li class="d-flex align-items-start py-1">
                                        <img :src="option.thumbnail" alt="" width="50" height="50">
                                        <div class="ms-1">
                                            <h6 class="mb-25">{{ option.title.slice(0, 30) }}</h6>
                                            <p>{{ option.category.title +"/"+ option.brand.name}}</p>
                                        </div>
                                    </li>
                                </template>
                            </vSelect>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mt-1">
                                <label>Show Status</label>
                                <Switch v-model="formData.topProducts.status" class="justify-content-start" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body position-relative imgContainer">
                        <h2 class="card-title">Add banners 4</h2>
                        <div class="mt-1">
                            <input type="text" v-model="formData.add4.title" class="form-control mb-1" placeholder="e.g title">
                            <vSelect :options="props.advised"
                                     :reduce="item => item.id"
                                     v-model="formData.add4.items"
                                     multiple
                                     label="title"
                                     placeholder="e.g Select Products For Ads">
                                <template v-slot:option="option">
                                    <li class="d-flex align-items-start py-1">
                                        <img :src="option.image" alt="" width="50" height="50">
                                        <div class="ms-1">
                                            <h6 class="mb-25">{{ option.title.slice(0, 30) }}</h6>
                                            <span>{{ option.discount_price ?? 0 }} {{ option.discount_type === 'flat' ? '৳' : '%' }}</span>
                                        </div>
                                    </li>
                                </template>
                            </vSelect>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mt-1">
                                <label>Show Status</label>
                                <Switch v-model="formData.add4.status" class="justify-content-start" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body position-relative imgContainer">
                        <h2 class="card-title">Home Categories</h2>
                        <div class="mt-1">
                            <input type="text" v-model="formData.categories2.title" class="form-control mb-1" placeholder="e.g title">
                            <vSelect :options="props.categories"
                                     :reduce="item => item.id"
                                     v-model="formData.categories2.items"
                                     multiple
                                     label="title"
                                     placeholder="e.g Select Products For Ads">
                                <template v-slot:option="option">
                                    <li class="d-flex align-items-start py-1">
                                        <img :src="option.icon" alt="" width="50" height="50">
                                        <div class="ms-1">
                                            <h6 class="mb-25">{{ option.title.slice(0, 30) }}</h6>
                                        </div>
                                    </li>
                                </template>
                            </vSelect>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mt-1">
                                <label>Show Status</label>
                                <Switch v-model="formData.categories2.status" class="justify-content-start" />
                            </div>
                        </div>
                    </div>
                </div>

<!--
                <div class="card">
                    <div class="card-body position-relative imgContainer">
                        <h2 class="card-title">Add banners 5</h2>
                        <div class="mt-1">
                            <input type="text" v-model="formData.add5.title" class="form-control mb-1" placeholder="e.g title">
                            <vSelect :options="props.advised"
                                     :reduce="item => item.id"
                                     v-model="formData.add5.items"
                                     multiple
                                     label="title"
                                     placeholder="e.g Select Products For Ads">
                                <template v-slot:option="option">
                                    <li class="d-flex align-items-start py-1">
                                        <img :src="option.image" alt="" width="50" height="50">
                                        <div class="ms-1">
                                            <h6 class="mb-25">{{ option.title.slice(0, 30) }}</h6>
                                            <span>{{ option.discount_price ?? 0 }} {{ option.discount_type === 'flat' ? '৳' : '%' }}</span>
                                        </div>
                                    </li>
                                </template>
                            </vSelect>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mt-1">
                                <label>Show Status</label>
                                <Switch v-model="formData.add5.status" class="justify-content-start" />
                            </div>
                        </div>
                    </div>
                </div>
-->


                <div class="row" v-if="!isLoding">
                     <div class="col">
                         <div class="card bg-light-success cursor-pointer" @click="updateSettings">
                             <div class="card-body d-flex align-items-center justify-content-center">
                                 <h3 class="text-success">Update Setting</h3>
                             </div>
                         </div>
                     </div>
                     <div class="col">
                         <a :href="$page.props.auth.ADMIN_URL+'/settings'"  class="card bg-light-danger cursor-pointer">
                             <div class="card-body d-flex align-items-center justify-content-center">
                                 <h3 class="text-danger">Cancel Setting</h3>
                             </div>
                         </a>
                     </div>
                </div>

                <div class="col d-flex align-items-center justify-content-center" v-if="isLoding">
                    <img src="../../../images/loading2.svg" alt="">
                </div>
            </div>
        </div>
    </layout>
</template>


