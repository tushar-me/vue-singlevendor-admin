<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Add New Customer</h3>
            </div>
            <!--begin::Form-->
            <form class="form" @submit.prevent="saveCustomer()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-solid" v-model="from.name" placeholder="Enter customer name..."/>
                        <small class="text-danger" v-if="errors.name">{{ errors?.name[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label>Email  <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-solid" v-model="from.email" placeholder="Enter email name..."/>
                        <small class="text-danger" v-if="errors?.email">{{ errors?.email[0]}}</small>
                    </div>

                    <div>
                        <label>Phone</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text py-0 border-0" id="phone">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="20" viewBox="0 0 32 32"><rect x="1" y="4" width="30" height="24" rx="4" ry="4" fill="#2d694f"></rect><path d="M27,4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4Zm3,20c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24Z" opacity=".15"></path><circle cx="16" cy="16" r="7" fill="#e13e47"></circle><path d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z" fill="#fff" opacity=".2"></path></svg>
                                    <span>+8801</span>
                                </div>
                            </span>
                            <input type="number" class="form-control form-control-solid" placeholder="Enter Phone Number" style="appearance: none" v-model="from.phone"  aria-describedby="phone">
                            <small class="text-danger" v-if="errors?.phone">{{ errors?.phone[0]}}</small>
                        </div>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label>Phone</label>-->
<!--                        <input type="text" class="form-control form-control-solid" v-model="from.phone" placeholder="Enter phone name..."/>-->
<!--                        <small class="text-danger" v-if="errors?.phone">{{ errors?.phone[0]}}</small>-->
<!--                    </div>-->

                    <div class="form-group">
                        <label for="exampleTextarea">Address</label>
                        <textarea id="exampleTextarea" class="form-control form-control-solid" v-model="from.address" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control"  @change="uploadFile">
                    </div>
                    <img v-show="from.photo" class="preview-image" :src="from.photo" alt="">
                </div>
                <div class="card-footer">
                    <RequestLoading :isShow="loading"/>
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

<script>
import RequestLoading from "@/components/RequestLoading.vue";

export default {
    name: "Add",
    components: {RequestLoading},
    data(){
        return{
            from: {
                name: '',
                email: '',
                phone:'',
                address:'',
                photo:null,
            },
            errors:{},
            loading:false
        }
    },
    methods: {
        uploadFile(event){
            let File = event.target.files[0];
            let reader = new FileReader();
            reader.onload = event => {
                this.from.photo = event.target.result
            }
            reader.readAsDataURL(File);
        },
        saveCustomer(){
            this.loading = true;
            this.$axios.post('api/customer?fromAdmin', this.from)
            .then( res => {
                this.from= '';
                this.errors = '';
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                })
            })
            .catch(err => {
                console.log(err?.response?.data?.errors)
                this.errors = err.response.data?.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            }).finally(()=>this.loading = false)
        }
    },

    created() {
        if (!User.loggedIn()){
            this.$router.push({name:"Login"})
        }
    }
}
</script>

<style scoped>
.preview-image{
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #83c1ff;
}
</style>
