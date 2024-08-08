<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 v-if="!isLoading" class="card-title">Add New Product</h3>
                <RequestLoading :isShow="isLoading"/>
            </div>
            <div class="card-body">
                <form @submit.prevent="saveProductDetails">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="col-md-4 form-group">
                                    <label for="productname">Product Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           id="productname"
                                           v-model="productDetails.productName"
                                           placeholder="Product Name"
                                           class="form-control">
                                    <small class="text-danger" v-if="errors.productName">{{ errors.productName[0]}}</small>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="dPrice">Default Price <span class="text-danger">*</span></label>
                                    <input type="text"
                                           id="dPrice"
                                           v-model="productDetails.defaultPrice"
                                           placeholder="Default Price."
                                           class="form-control">
                                    <small class="text-danger" v-if="errors.defaultPrice">{{ errors.defaultPrice[0]}}</small>

                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="defaultStoke">Default Quantity <span class="text-danger">*</span></label>
                                    <input type="text"
                                           id="defaultStoke"
                                           v-model="productDetails.defaultStoke"
                                           placeholder="Default Quantity..."
                                           class="form-control">
                                    <small class="text-danger" v-if="errors.defaultStoke">{{ errors.defaultStoke[0]}}</small>

                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <TreeCategory v-model="productDetails.categoryId"/>
                                    <small class="text-danger" v-if="errors.categoryId">{{ errors.categoryId[0]}}</small>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Brand</label>
                                    <v-select v-model="productDetails.brandId"
                                              class="form-control"
                                              :reduce="brand => brand.id" :options="brands"
                                              label="title" placeholder="Select Brand..."/>
                                    <small class="text-danger" v-if="errors.brandId">{{ errors.brandId[0]}}</small>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="productDetails.description"
                                          id="description" cols="30" rows="4"
                                          class="form-control"></textarea>
                                <small class="text-danger" v-if="errors.description">{{ errors.description[0]}}</small>
                            </div>

                            <div class="form-group">
                                <label>Full Details</label>
                                <SummernoteEditor v-model="productDetails.details"/>
                                <small class="text-danger" v-if="errors.details">{{ errors.details[0]}}</small>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-1">
                        <RequestLoading :isShow="isLoading"/>
                        <button v-if="!isLoading" class="btn btn-sm btn-primary" @click="saveProductDetails">Save</button>
                        <button v-if="!isLoading" class="btn btn-sm btn-danger" ref="Close" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import SummernoteEditor from 'vue3-summernote-editor';
import TreeCategory from "@/components/TreeCategory.vue";
import ComponentLoader from "@/components/ComponentLoader.vue";
import RequestLoading from "@/components/RequestLoading.vue";

export default {
    name: "Add",
    components:{
        RequestLoading,
        ComponentLoader,
        SummernoteEditor,
        TreeCategory,
    },
    data(){
        return{
            isLoading:false,
            productDetails:{
                productName: null,
                defaultPrice: null,
                defaultStoke: null,
                description: null,
                details: null,
                categoryId: null,
                brandId: null,
                warranty:null,
                features:null,
                video_url:null
            },
            errors:{},
        }
    },
    methods: {

        saveProductDetails(){
            this.isLoading = true
            this.$axios.post('api/save-product-details', this.productDetails)
                .then(res => {
                    Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })

                    this.$router.push("/manage-product")
                })
                .catch(err => {
                    this.isLoading = false
                    this.errors = err.response.data.errors;
                    Toast.fire({
                        icon: 'error',
                        title: err.response.data.message
                    })
                })
                .finally(() => this.isLoading = false);
        },
        // get all variations
        allBrands() {
            this.isLoading=true
            this.$axios.get('api/brand', this.from)
                .then(res => {
                    this.brands = res.data
                })
                .catch(err => {
                    this.isLoading = false
                    this.errors = err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.data.message
                    });
                }).finally(()=>this.isLoading=false)
        },
    },
    created() {
        this.allBrands();
    }
}
</script>

<style scoped>
.deleteImage{
    position: relative;
    top: -41px;
    left: -31px;
    width: 20px;
    height: 20px;
    background: #00000014;
    display: inline-block;
    color: #efcdcd;
    border-radius: 15px;
    border: none;
    padding: 2px 6px;
    transition: 0.3s all ease;
    cursor:pointer;
}
.deleteImage:hover{
    background: #000;
}


#noShow {
    display: none;
}

.inputFileButton{
    border: 1px solid #ccc;
    display: inline-block;
    padding: 9px 12px;
    cursor: pointer;
    margin-top: 19px;
}
</style>




