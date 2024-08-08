<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title d-flex gap-5">
                    <h3 v-if="!isLoading">Add New Category</h3>
                    <RequestLoading :isShow="isLoading"/>
                </div>
            </div>

            <!--begin::Form-->
            <form class="form" @submit.prevent="saveCategory()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Parent Category</label>
                        <TreeCategory :disabled="isLoading" v-model="from.parent"/>
                    </div>

                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" :disabled="isLoading" class="form-control form-control-solid" v-model="from.name" placeholder="Enter category name..."/>
                        <small class="text-danger" v-if="errors.name">{{ errors.name[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label>Category Icon</label>
                        <a href="https://icones.js.org/" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M11.37 10.384a1.5 1.5 0 0 0 0 2.121l.067.067a1.5 1.5 0 0 0 2.122 0l3.115-3.115c.144-.144.253-.31.326-.488V17a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h7.851a1.5 1.5 0 0 0-.366.269z"/><path fill="currentColor" fill-rule="evenodd" d="M19.218 4.782a.5.5 0 0 1 0 .708l-6.364 6.364a.5.5 0 0 1-.708-.707l6.364-6.365a.5.5 0 0 1 .707 0" clip-rule="evenodd"/><path fill="currentColor" fill-rule="evenodd" d="M14 4.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5h-4.5a.5.5 0 0 1-.5-.5" clip-rule="evenodd"/></svg>
                        </a>

                        <textarea class="form-control" :disabled="isLoading" v-model="from.icon" rows="3" placeholder="Svg Icon ......."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Category Description</label>
                        <textarea class="form-control" :disabled="isLoading" v-model="from.description" rows="3" placeholder="category description......."></textarea>
                    </div>



<!--                    <div class="form-group">-->
<!--                        <label>Category Details</label>-->
<!--                        <SummernoteEditor v-model="from.details"/>-->
<!--                    </div>-->

                    <div class="form-group d-flex flex-column w-50">
                        <small class="text-danger" v-if="errors.name">{{ errors.photo[0]}}</small>
                        <label class="btn btn-clean"
                               style="
                                border: dashed 2px;
                                padding: 20px 82px;"
                        >
                            <input  type="file" @change="uploadFile" hidden>
                            <div class="d-flex flex-column align-items-center justify-center">
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Files/Upload.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="80px!important" height="80px!important" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"/>
                                        <path d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                                <span class="text-danger w-75 mt-4">Please upload images in JPG, PNG, or GIF format with dimensions of 1400 x 400 pixels. The maximum file size allowed is 1024 KB.</span>
                            </div>
                        </label>
                    </div>


                    <img v-if="from.photo" :src="from.photo" alt="" style="width: 180px;height: 120px; object-fit: contain;">
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

            rawHtml: "this is my data",
            from: {
                parent:null,
                name: '',
                description:'',
                // details: '',
                photo:'',
                icon:''
            },
            avatar:{},
            errors:{},
        }
    },
    methods: {
        uploadFile(event){
            this.avatar = event.target.files[0];
            this.from.photo = URL.createObjectURL(event.target.files[0])
        },
        saveCategory(){
            this.isLoading = true;
            let formdata = new FormData;
            formdata.append('image', this.avatar);
            formdata.append('parent', this.from.parent)
            formdata.append('name', this.from.name)
            formdata.append('description', this.from.description)
            formdata.append('photo', this.from.photo)
            formdata.append('icon', this.from.icon)

            this.$axios.post('api/category', formdata)
            .then( res => {
                this.from= '';
                this.errors = '';
                this.avatar = ''
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                })
                this.$router.push({name:'ManageCategory'});
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
