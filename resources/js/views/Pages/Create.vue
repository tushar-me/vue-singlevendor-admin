<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title d-flex gap-5">
                    <h3 v-if="!isLoading">Add New Page</h3>
                    <RequestLoading :isShow="isLoading"/>
                </div>
            </div>

            <!--begin::Form-->
            <form class="form" @submit.prevent="saveCategory()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Page Title</label>
                        <input type="text" :disabled="isLoading" class="form-control form-control-solid" v-model="from.title" placeholder="Enter page title..."/>
                        <small class="text-danger" v-if="errors.title">{{ errors?.title[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label>Page Content</label>
                        <SummernoteEditor v-model="from.description" rows="3"></SummernoteEditor>
                        <small class="text-danger" v-if="errors.title">{{ errors?.description[0]}}</small>
                    </div>
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
import SummernoteEditor from 'vue3-summernote-editor';
import TreeCategory from "@/components/TreeCategory.vue";
import RequestLoading from "@/components/RequestLoading.vue";

export default {
    name: "Add",
    components: {RequestLoading, TreeCategory, SummernoteEditor},
    data(){
        return{
            isLoading:false,
            from: {
                name: '',
                description:'',
            },
            errors:{},
        }
    },
    methods: {
        saveCategory(){
            // this.errors = null;
            this.$axios.post('api/pages', this.from)
                .then( res => {
                    this.from= {};
                    Toast.fire({
                        icon: 'success',
                        title: "Created..."
                    })
                    this.$router.push({name:'Pages'});
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.statusText
                    })
                }).finally(final =>{
                this.isLoading = false;
            })
        },
    },

    created() {
        if (!User.loggedIn()){
            this.$router.push({name:"Login"})
        }
    }
}
</script>

<style>
.modal-backdrop .show{
    z-index: -1 !important;
}
</style>
