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

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control form-control-solid" v-model="form.phone" placeholder="Enter customer name..."/>

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

