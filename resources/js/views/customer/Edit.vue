<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Edit Customer</h3>
            </div>
            <!--begin::Form-->
            <form class="form" @submit.prevent="updateCustomer()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control form-control-solid" v-model="form.full_name" placeholder="Enter customer name..."/>

                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control form-control-solid" v-model="form.email" placeholder="Enter customer name..."/>

                    </div>



                    <div>
                        <label>Phone</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text py-0 border-0" id="phone">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="20" viewBox="0 0 32 32">
                                        <rect x="1" y="4" width="30" height="24" rx="4" ry="4" fill="#2d694f"></rect>
                                        <path d="M27,4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4Zm3,20c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24Z" opacity=".15"></path>
                                        <circle cx="16" cy="16" r="7" fill="#e13e47"></circle>
                                        <path d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z" fill="#fff" opacity=".2"></path>
                                    </svg>
                                    <span>+8801</span>
                                </div>
                            </span>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Phone Number" style="appearance: none" v-model="form.phone"  aria-describedby="phone">
<!--                            <small class="text-danger" v-if="errors?.phone">{{ errors?.phone[0]}}</small>-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea">Address</label>
                        <textarea id="exampleTextarea" class="form-control form-control-solid" v-model="form.address" rows="3"></textarea>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label>Photo</label>-->
<!--                        <input type="file" class="form-control"  @change="uploadFile">-->
<!--                    </div>-->
<!--                    <img v-show="form.photo" class="preview-image" :src="`/${form.photo}`" alt="" style="width:120px; height:auto;">-->
                </div>
                <div class="card-footer">
                    <RequestLoading :isShow="loading" text="updating..."/>
                    <div v-if="!loading">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</template>


<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router'
import RequestLoading from "@/components/RequestLoading.vue";
import ComponentLoader from "@/components/ComponentLoader.vue";

const route = useRoute();

const data = ref(null);

const form = ref({
    full_name: null,
    email: null,
    phone: null,
    address: null,
    photo: null,
});
const loading = ref(false)
const uploadFile = (event) => {
    let File = event.target.files[0];

    let reader = new FileReader();
    reader.onload = event => {
        form.value.photo = event.target.result
    }
    reader.readAsDataURL(File);
}

const isLogined = () => {
    if (!User.loggedIn()){
        route.push({name:"Login"})
    }
}

const getCustomer = (id) => {
    loading.value = true;
    axios.get(`/api/customer/${id}`)
        .then(response => {
            data.value = response.data;
            form.value = data.value;
            form.value.phone = data.value?.phone?.split('+880')?.[1];


            Toast.fire({
                icon: 'success',
                title: "Customer data is now available for editing."
            })
        })
        .catch(error => {
            console.error("Error fetching customer data:", error);
        }).finally(()=> loading.value = false)
}


const updateCustomer = () => {
    loading.value = true;
    axios.put(`/api/customer/${route?.params?.id}`, form.value)
        .then(res => {
            Toast.fire({
                icon: 'success',
                title: res.data.message
            })
            route?.push({name:'ManageCategory'});
        })
        .catch(err => {
            Toast.fire({
                icon: 'warning',
                title: err.response.statusText
            })
        }).finally(()=> loading.value = false)
}

onMounted ( () => {
    isLogined();
    getCustomer(route?.params?.id);
});

</script>

