<template lang="html">
    <div>
        <ComponentLoader v-if="loading"/>
        <div v-else class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">All Products
                        <span class="d-block text-muted pt-2 font-size-sm">all product details is here </span></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <router-link class="btn btn-primary font-weight-bolder" to="/add-product">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        New Record
                    </router-link>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable table-borderless" id="">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <td width="35%">Info</td>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Brand</th>
<!--                        <th>Status</th>-->
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, i) in products?.data">
                        <td>{{ i + 1 }}</td>
                        <td>
                            <div>
                                <h6 class="fw-bold text-capitalize">{{ product.title }}</h6>
                                <div class="d-flex flex-column gap-1">
                                    <small>Stoke: {{ product.stock }}</small>
                                    <small>Price: {{ product.buying_price }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                           <img :src="`/storage/uploads/${product?.images[0]?.image}`" alt="" style="width:73px;height:70px;border-radius: 50px;"/>
                        </td>
                        <td>
                            <span class="text-capitalize">
                                {{ product.category?.name }}
                            </span>
                        </td>
                        <td>
                            <span class="text-capitalize">{{ product.brand?.title }}</span>
                        </td>
<!--                        <td>-->
<!--                            <span class="badge badge-warning text-white text-capitalize">{{ product.status }}</span>-->
<!--                        </td>-->
                        <td>
                            <router-link :to="{name:'ModifyProduct', params:{id:product.id}}" class="btn btn-clean btn-primary" title="Edit details">
                                Setup Product
                            </router-link>

                            <button class="btn btn-icon btn-light-danger ms-2" title="Edit details" @click="deleteProduct(product?.id)">
                                <span class="svg-icon svg-icon-dark svg-icon-2x">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                            <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--end: Datatable-->
                <Pagination  @some-event="allProducts" :links="products.links" :from="products.from" :to="products.to" :total="products.total" :notShowNumber="false"/>
            </div>
        </div>

        <div class="modal fade" id="exampleModalLong"
             data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="staticBackdrop"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex gap-3">
                            <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-primary" @click="saveProductDetails">Save</button>
                                <button class="btn btn-sm btn-danger" ref="Close" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                        <button type="button" class="close" ref="Close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="saveProductDetails">
                            <div class="form-row">
                                <div class="col-md-4 form-group">
                                    <label for="productname">Product Name</label>
                                    <input type="text"
                                           id="productname"
                                           v-model="productName"
                                           placeholder="Product Name"
                                           class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="dPrice">Default Price</label>
                                    <input type="text"
                                           id="dPrice"
                                           v-model="defaultPrice"
                                           placeholder="Default Price."
                                           class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="defaultStoke">Default Quantity</label>
                                    <input type="text"
                                           id="defaultStoke"
                                           v-model="defaultStoke"
                                           placeholder="Default Quantity..."
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label>Category</label>
                                    <TreeCategory v-model="categoryId"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Brand</label>
                                    <v-select v-model="brandId"
                                              class="form-control"
                                              :reduce="brand => brand.id" :options="brands"
                                              label="title" placeholder="Select Brand..."/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="description"
                                          id="description" cols="30" rows="4"
                                          class="form-control"></textarea>
                            </div>


                            <div class="form-group">
                                <label>Full Details</label>
                                <SummernoteEditor v-model="details"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import SummernoteEditor from 'vue3-summernote-editor';
import TreeCategory from "@/components/TreeCategory.vue";
import ComponentLoader from "@/components/ComponentLoader.vue";
import Pagination from "@/components/Pagination.vue";

export default {
    name: "Index",
    components:{
        Pagination,
        ComponentLoader,
        SummernoteEditor,
        TreeCategory,
    },
    data() {
        return {
            products: [],
            product: {},
            brands: [],

            // add product information.
            productName: null,
            defaultPrice: null,
            defaultStoke: null,
            description: null,
            details: null,
            categoryId: null,
            brandId: null,

            loading:false,
        }
    },
    methods: {
        allProducts(path) {
            this.loading = true
            this.$axios.get(path ?? 'api/product')
                .then(res => {
                    this.products = res.data
                })
                .catch(err => {
                    err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.statusText
                    })
                })
                .finally(() => this.loading = false);

        },
        showSingleProduct(id) {
            this.loading = true
            this.$axios.get('/api/product/' + id)
                .then(res => {
                    $('#exampleModal').modal('show')
                    this.product = res.data;
                })
                .catch(err => {
                    Toast.fire({
                        icon: 'error',
                        title: err.response.statusText
                    })
                })
                .finally(() => this.loading = false);

        },
        deleteProduct(id) {
            Swal.fire({
                title: 'Are You Sure!',
                text: 'you watnt to delete this?',
                icon: 'warning',
                confirmButtonColor: '#ddd',
                cancelButtonColor: 'red',
                confirmButtonText: 'Delete',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {

                    this.loading = true
                    this.$axios.delete('/api/product/' + id)
                        .then(res => {
                            Toast.fire({
                                icon: 'success',
                                title: res.data.message
                            })
                            this.allProducts();
                        })
                        .catch(err => {
                            Toast.fire({
                                icon: 'error',
                                title: err.response.statusText
                            })
                        })
                        .finally(() => this.loading = false);
                }
            }).catch(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'dont worry. your data is safe...'
                })
                this.$router.push({name: 'ManageEmployee'});
            })
        },


        saveProductDetails(){

            this.loading = true
            const formData = new FormData();
            formData.append(`name`, this.productName);
            formData.append(`defaultPrice`, this.defaultPrice);
            formData.append(`defaultQty`, this.defaultStoke);
            formData.append(`categoryId`, this.categoryId);
            formData.append(`brandId`, this.brandId);
            formData.append(`description`, this.description);
            formData.append(`details`, this.details);
            formData.append(`stock`,  this.defaultStoke);
            this.$axios.post('api/save-product-details', formData)
            .then(res => {
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                })
                this.$refs.Close.click();
                this.allProducts();
            })
            .catch(err => {
                Toast.fire({
                    icon: 'error',
                    title: err.response.data.message
                })
            })
                .finally(() => this.loading = false);
        },


        // get all variations
        allBrands() {
            this.$axios.get('api/brand', this.from)
            .then(res => {
                this.brands = res.data
            })
            .catch(err => {
                this.errors = err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.data.message
                });
            })
        },
    },
    created() {
        this.allProducts();
        this.allBrands();
    }
}
</script>

<style scoped>

</style>
