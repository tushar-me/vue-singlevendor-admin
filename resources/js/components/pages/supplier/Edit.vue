<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Edit Supplier</h3>
            </div>
            <!--begin::Form-->
            <form class="form" @submit.prevent="updateSupplier()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control form-control-solid" v-model="from.name" placeholder="Enter employee name..."/>
                        <small class="text-danger" v-if="errors.name">{{ errors.name[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control form-control-solid" v-model="from.email" placeholder="Example: employee@checkmail.com..."/>
                        <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control form-control-solid" v-model="from.phone" placeholder="Enter employee phone number..."/>
                        <small class="text-danger" v-if="errors.phone">{{ errors.phone[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label>Nid Number</label>
                        <input type="text" class="form-control form-control-solid" v-model="from.nid" placeholder="Enter employee phone number..."/>
                    </div>


                    <div class="form-group">
                        <label for="exampleTextarea">Address</label>
                        <textarea id="exampleTextarea" class="form-control form-control-solid" v-model="from.address" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control"  @change="uploadFile">
                    </div>
                    <img :src="from.photo" alt="" style="width: 180px;height: 120px;">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
            <!--end::Form-->
        </div>


    </div>
</template>

<script>
export default {
    name: "Edit",
    data(){
        return{
            from: {
                name: '',
                email: '',
                phone:'',
                nid: '',
                address: '',
                photo:'',
            },
            errors:{},
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
        updateSupplier(){
            let id = this.$route.params.id;
            axios.patch('/api/supplier/'+id, this.from)
                .then( res => {
                    this.from= '';
                    this.errors = '';
                    Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                    this.$router.push({name:'ManageSupplier'});
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.statusText
                    })
                })
        }
    },

    created() {
        let id = this.$route.params.id;
        axios.get('/api/supplier/'+id)
        .then(res => {
            this.from = res.data;
        })
        .catch(err => {
            console.log(err.response.data)
        })
    }
}
</script>

<style scoped>

</style>
