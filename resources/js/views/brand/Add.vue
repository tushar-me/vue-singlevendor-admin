<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 v-if="!isLoading" class="card-title">Add New Brand</h3>
                <RequestLoading :isShow="isLoading"/>
            </div>
            <!--begin::Form-->
            <form class="form" @submit.prevent="saveBrand()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Brand Name</label>
                        <input type="text" :disabled="isLoading" class="form-control form-control-solid" v-model="from.name" placeholder="Enter Brand name..."/>
                        <small class="text-danger" v-if="errors.name">{{ errors.name[0]}}</small>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label for="exampleTextarea">Brand Description </label>-->
<!--                        <textarea id="exampleTextarea" class="form-control form-control-solid" v-model="from.description" rows="3"></textarea>-->
<!--                    </div>-->

                    <div class="form-group d-flex flex-column">
                        <small class="text-danger" v-if="errors.photo">{{ errors.photo[0]}}</small>
                        <label>Photo <a href="https://worldvectorlogo.com" target="_blank">Find Brand Logo & Images</a></label>
                        <input type="file" :disabled="isLoading" class="form-control"  @change="uploadFile">
                    </div>
                    <img v-if="from.photo" :src="from.photo" alt="" style="width: 180px;height: 120px;">
                </div>
                <div class="card-footer d-flex">
                    <RequestLoading :isShow="isLoading"/>
                    <button v-if="!isLoading" type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
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
            isLoading:false,
            from: {
                name: '',
                description: '',
                photo:'',
            },
            avatar:{},
            errors:{},
        }
    },
    methods: {
        uploadFile(event){
            let File = event.target.files[0];
            this.avatar = File;
            let reader = new FileReader();
            reader.onload = event => {
                this.from.photo = event.target.result
            }
            reader.readAsDataURL(File);
        },
        saveBrand(){
            this.isLoading = true
            let formdata = new FormData;
            formdata.append('image', this.avatar);
            formdata.append('title', this.from.name)
            // formdata.append('description', this.from.description)
            formdata.append('photo', this.from.photo)

            this.$axios.post('api/brand', formdata)
            .then( res => {
                this.from.name= '';
                this.from.description= '';
                this.from.photo= '';
                this.avatar= '';
                this.errors = '';
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                })
            })
            .catch(err => {
                this.errors = err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
            .finally(final =>{
                this.isLoading = false;
            })
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

</style>
