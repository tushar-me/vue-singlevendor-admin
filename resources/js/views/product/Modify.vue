<template>


    <section>

        <ComponentLoader v-if="loading"/>
        <div v-else class="row">
            <div class="col-md-3 d-flex flex-column gap-2">
                <div class="card cursor-pointer" :class="{'bg-primary text-white fw-bolder' : currentTab === 'details'}"
                     @click="setActiveTab('details')">
                    <div class="card-body p-4">
                        Product Details
                    </div>
                </div>

                <div class="card cursor-pointer"
                     :class="{'bg-primary text-white fw-bolder' : currentTab === 'variants'}"
                     @click="setActiveTab('variants')">
                    <div class="card-body p-4">
                        Product Variants
                    </div>
                </div>

                <div class="card cursor-pointer" :class="{'bg-primary text-white fw-bolder' : currentTab === 'images'}"
                     @click="setActiveTab('images')">
                    <div class="card-body p-4">
                        Product Images
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card" v-if="currentTab === 'details'">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h3 class="card-title m-0">Product Details</h3>
                        <button class="btn btn-primary btn-sm" @click="updateProductDetails">Update Info</button>
                    </div>
                    <div class="card-body">
                        <div>
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
                        </div>
                    </div>
                </div>

                <div class="card" v-if="currentTab === 'variants'">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h3 class="m-0 font-weight-bold text-primary">Variants</h3>
                        <div class="d-flex gap-3">
                            <button class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#addVariaion">
                                <i class="bi bi-plus"></i>
                                <span>Add New Variation</span>
                            </button>
                            <button class="btn btn-primary btn-sm" @click="saveVariation">Save Variations</button>
                        </div>
                    </div>

                    <div class="card-body" v-if="product_variant.length > 0">
                        <div class="row" v-for="(item,index) in product_variant">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="variation">
                                        <span>Variation</span>
                                    </label>
                                    <select id="variation" v-model="item.option" @change="changeVariation(index)"
                                            class="form-control">
                                        <option v-for="variant in variants"
                                                :value="variant.id">
                                            {{ variant.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label v-if="product_variant?.length !== 1"
                                           @click="removeItem(index)"
                                           class="float-right text-primary"
                                           style="cursor: pointer;">Remove</label>

                                    <label>Variation Options</label>

                                    <div class="container">
                                        <select class="selectpicker" multiple aria-label="Default select example"
                                                data-live-search="true">
                                            <option v-for="variant in variationValues[index]"
                                                    :value="variant">
                                                {{ variant.name }}
                                            </option>
                                        </select>
                                    </div>

                                    <v-select v-model="item.tags"
                                              @update:model-value="checkVariant"
                                              label="name"
                                              class="form-control"
                                              multiple
                                              taggable
                                              placeholder="Select Variation Options...">
                                    </v-select>

<!--                                    :options="variationValues[index]"-->

                                    <!--
                                                                        <input-tag v-model="item.tags" @input="checkVariant"
                                                                                   class="form-control"></input-tag>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"
                         v-if="product_variant?.length < variants.length">
                        <button @click="newVariant()" class="btn btn-primary">Add another option</button>
                    </div>
                    <div class="card-header text-uppercase">Preview</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Variant</td>
                                    <td>Price</td>
                                    <td>Stock</td>
                                    <td>Sku Id</td>
                                </tr>
                                </thead>
                                <tbody v-if="product_variant_prices.length > 0">
                                <tr v-for="variant_price in product_variant_prices">
                                    <td>{{ variant_price.title }}</td>
                                    <td>
                                        <input type="number" class="form-control"
                                               v-model="variant_price.price">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control"
                                               v-model="variant_price.stock">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" v-model="variant_price.sku">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card" v-if="currentTab === 'images'">
                    <div class="card-body">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h2 class="card-title m-0">Product Images</h2>
                            <button class="btn btn-primary btn-sm" @click="saveImages">Save Images</button>
                        </div>
                        <div class="mu-container" :class="isInvalid?'mu-red-border':''">
                            <div class="mu-elements-wraper">
                                <div v-for="(image, index) in productImages" :key="index" class="mu-image-container">
                                    <img :src="`/storage/uploads/${image.image}`" alt="" class="mu-images-preview">
                                    <button @click="deleteImage(image?.id, index)" class="mu-close-btn" type="button">
                                        <svg
                                            class='mu-times-icon'
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="0.65em"
                                            height="0.65em"
                                            preserveAspectRatio="xMidYMid meet"
                                            viewBox="0 0 352 512">
                                            <path
                                                d="m242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28L75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256L9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                                                fill="currentColor"
                                            />
                                        </svg>
                                    </button>
                                </div>
                                <!--IMAGES PREVIEW-->
                                <div v-for="(image, index) in images" :key="index" class="mu-image-container">
                                    <img :src="image.url" alt="" class="mu-images-preview">
                                    <button @click="removeMedia(index)" class="mu-close-btn" type="button">
                                        <svg
                                            class='mu-times-icon'
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="0.65em"
                                            height="0.65em"
                                            preserveAspectRatio="xMidYMid meet"
                                            viewBox="0 0 352 512">
                                            <path
                                                d="m242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28L75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256L9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                                                fill="currentColor"
                                            />
                                        </svg>
                                    </button>
                                </div>
                                <!--UPLOAD BUTTON-->
                                <div class="mu-plusbox-container">
                                    <label for="mu-file-input" class="mu-plusbox">
                                        <svg
                                            class="mu-plus-icon"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="1em"
                                            height="1em"
                                            preserveAspectRatio="xMidYMid meet"
                                            viewBox="0 0 24 24">
                                            <g fill="none">
                                                <path
                                                    d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1zm1 15a1 1 0 1 1-2 0v-3H8a1 1 0 1 1 0-2h3V8a1 1 0 1 1 2 0v3h3a1 1 0 1 1 0 2h-3v3z"
                                                    fill="currentColor"/>
                                            </g>
                                        </svg>
                                    </label>
                                    <input @change="handleFileChange" id="mu-file-input" type="file" accept="image/*" multiple hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" v-if="currentTab === 'seo'">
                    <div class="card-body d-flex gap-2">
                        <button class="btn btn-lg btn-primary" @click="saveProduct">Save Product</button>
                        <button class="btn btn-lg btn-danger">Reset Form</button>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <div class="modal fade" id="addVariaion"
         tabindex="-1" role="dialog"
         aria-hidden="false">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex gap-3">
                        <h5 class="modal-title" id="exampleModalLabel">Add Variation</h5>
                    </div>
                    <button type="button" class="close" ref="Close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="saveNewVarient">
                        <div class="form-row">
                            <label for="var_name">Variation Name</label>
                            <input type="text"
                                   id="var_name"
                                   v-model="varientName"
                                   placeholder="Variation Name"
                                   class="form-control">
                        </div>

                        <button class="btn btn-sm btn-primary mt-4" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import TreeCategory from '@/components/TreeCategory.vue'
import Uploader from "vue-media-upload";
import SummernoteEditor from 'vue3-summernote-editor';
import ComponentLoader from "@/components/ComponentLoader.vue";


export default {
    name: "Index",
    components: {
        ComponentLoader,
        TreeCategory,
        SummernoteEditor,
        Uploader
    },
    data() {
        return {
            varientName:null,


            currentTab: "details",
            variationDivider: "/",
            varientSkuPrefix: "Ver-",
            defaultQty: 13,

            productName: null,
            defaultPrice: null,
            defaultStoke: null,
            description: null,
            details: null,
            categoryId: 1,
            brandId: null,
            images: [],
            variants:[],
            product_variant: [
                {
                    option: 1,
                    tags: []
                }
            ],
            product_variant_prices: [],
            variationValues: [],

            content: null,
            editorOption: {
                // some quill options
            },

            brands: [],

            productImages:[],

            loading:false,
        }
    },
    methods: {
        initImages(event) {
            console.log(event)
        },
        changeMedia(media) {
            this.images = media
        },
        setActiveTab(tab) {
            this.currentTab = tab;
        },
        changeVariation(index) {
            this.variationValues[index] = this.variants.find(item => item.id === parseInt(event.target.value))?.variation_options
        },
        removeItem(index) {
            this.product_variant?.splice(index, 1);
            this.checkVariant();
        },

        // it will push a new object into product variant
        newVariant() {
            let all_variants = this.variants.map(el => el.id)
            let selected_variants = this.product_variant.map(el => el.option);
            let available_variants = all_variants.filter(entry1 => !selected_variants.some(entry2 => entry1 == entry2))
            // console.log(available_variants)

            this.product_variant.push({
                option: available_variants[0],
                tags: []
            })
        },

        // check the variant and render all the combination
        checkVariant() {
            let tags = [];
            this.product_variant_prices = [];
            this.product_variant.filter((item) => {
                tags.push(item.tags);
                console.log(item)
            })
            // console.log(tags)

            this.getCombn(tags).forEach(item => {
                this.product_variant_prices.push({
                    title: item,
                    price: 0,
                    stock: 0
                })
            })
        },

        // combination algorithm
        getCombn(arr, pre) {
            pre = pre || '';
            if (!arr.length) {
                return pre;
            }
            let self = this;
            let ans = arr[0].reduce(function (ans, value) {
                return ans.concat(self.getCombn(arr.slice(1), pre + value + '/'));
            }, []);
            return ans;
        },



        saveNewVarient(){
            this.loading = true
            this.$axios.post('/api/create-varient', {name:this.varientName})
                .then(res => {
                    this.varientName =null;
                    Toast.fire({
                        icon: 'success',
                        title: "variation Created Success..."
                    });
                    $('#addVariaion').modal('hide')
                    this.allVerients()
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.data.message
                    });
                })
                .finally(() => this.loading = false);
        },



/*

        // add new Variations
        newVariant() {
            let all_variants = this.variants.map(el => el.id)
            let selected_variants = this.product_variant.map(el => el.option);
            let available_variants = all_variants.filter(entry1 => !selected_variants.some(entry2 => entry1 === entry2))
            this.variationValues[this.product_variant.length] = this.variants[this.product_variant.length]?.variation_options
            this.product_variant.push({
                option: available_variants[0],
                tags: []
            })
        },

        // combination algorithm
        getCombn(arr, pre) {
            pre = pre || false;
            if (!arr.length) {
                return pre;
            }
            let self = this;
            let data;

            // comined all variation and variation option id commined
            // data = arr[0].reduce(function (ans, value) {
            //     return ans.concat(self.getCombn(arr.slice(1), {
            //         title: pre ? pre?.title + value.name +" "+self.variationDivider+" " : value.name + " "+self.variationDivider+" ",
            //         variationId: pre ? pre?.variationId + value.variation_id +  self.variationDivider : value.variation_id + self.variationDivider,
            //         variationOptionId: pre ? pre?.variationOptionId + value.id +  self.variationDivider : value.id + self.variationDivider,
            //     }));
            // }, []);


            // only single single id
            data = arr[0].reduce(function (ans, value) {
                return ans.concat(self.getCombn(arr.slice(1), {
                    title: pre ? pre?.title + value.name + " " + self.variationDivider + " " : value.name + " " + self.variationDivider + " ",
                    variationId: pre ? pre?.variationId + value.variation_id + self.variationDivider : value.variation_id + self.variationDivider,
                    variationOptionId: pre ? pre?.variationOptionId + value.id + self.variationDivider : value.id + self.variationDivider,
                }));
            }, []);

            return data;

        },

        generateSKU(productName) {
            // Take the initials of the product name
            const initials = productName?.charAt(0).toUpperCase();

            const randomNumber = Math.floor(Math.random() * (999999 - 1000 + 1)) + 1000;
            return `${initials ?? 'V'}-${randomNumber}`;
        },

        // check variations exist or not
        checkVariant() {
            let tags = [];
            this.product_variant_prices = [];

            this.product_variant.filter((item) => {
                tags.push(item.tags);
            })
            const data = this.getCombn(tags);
            const myArray = [];

            console.log(tags)

            myArray.push(this.getCombn(tags));
            data.forEach(item => {
                this.product_variant_prices.push({
                    title: item.title,
                    price: this.defaultPrice,
                    sku: this.generateSKU(this.productName),
                    variationId: item.variationId,
                    stock: this.defaultStoke,
                    variationOptionId: item.variationOptionId,
                })
            })

            // this.getCombn(tags).forEach(item => {
            //     this.product_variant_prices.push({
            //         title: item,
            //         price: 0,
            //         stock: 0
            //     })
            // })
        },
*/


        // get all variations
        allVerients() {

            this.loading = true
            this.$axios.get('/api/varients', this.from)
                .then(res => {
                    this.variants = res.data
                    Toast.fire({
                        icon: 'success',
                        title: "Ready For Product Create..."
                    })
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.data.message
                    });
                })
                .finally(() => this.loading = false);
        },

        // get all variations
        allBrands() {

            this.loading = true
            this.$axios.get('/api/brand', this.from)
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
                .finally(() => this.loading = false);
        },


        // store product into database

        updateProductDetails(){
            const formData = new FormData();
            formData.append(`name`, this.productName);
            formData.append(`defaultPrice`, this.defaultPrice);
            formData.append(`defaultQty`, this.defaultStoke);
            formData.append(`categoryId`, this.categoryId);
            formData.append(`brandId`, this.brandId);
            formData.append(`description`, this.description);
            formData.append(`details`, this.details);
            formData.append(`stock`,  this.defaultStoke);


            const productData = {
                name: this.productName,
                defaultPrice: this.defaultPrice,
                defaultQty: this.defaultStoke,
                categoryId: this.categoryId,
                brandId: this.brandId,
                description: this.description,
                details: this.details,
                stock: this.defaultStoke
            };

            this.$axios.put(`/api/product/${this.$route.params.id}`, productData)
                .then(res => {
                    Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                    this.$refs.Close.click();
                    this.allProducts();
                })
                .catch(err => {
                    console.log(err)
                })
        },

        saveVariation(){
            this.$axios.post('/api/save-product-variations', {variations:this.product_variant_prices, varArray:this.product_variant, productId:this.$route.params.id})
            .then(res => {
                Toast.fire({
                    icon: 'success',
                    title: "variation Update Success..."
                });
            })
            .catch(err => {
                Toast.fire({
                    icon: 'error',
                    title: err.response.data.message
                });
            })
        },
        saveImages(){
            const formData = new FormData();
            for (let i = 0; i < this.images.length; i++) {
                formData.append(`files[${i}]`, this.images[i].file);
            }
            formData.append('productId', this.$route.params.id);

            this.$axios.post('/api/save-product-images', formData)
                .then(res => {
                    Toast.fire({
                        icon: 'success',
                        title: "Image Update Success..."
                    });
                })
                .catch(err => {
                    Toast.fire({
                        icon: 'error',
                        title: err.response.data.message
                    });
                })
        },

        handleFileChange(event) {
            for(let i = 0; i < event.target.files.length; i++){
                this.images.push({
                    url: URL.createObjectURL(event.target.files[i]),
                    file: event.target.files[i]
                })
            }

            console.log(this.images)
        },

        async fileChange(event) {
            this.isLoading = true;
            let files = event.target.files;

            for (var i = 0; i < files.length; i++) {
                let url = URL.createObjectURL(files[i]);
                let addedImage = {url: url, name: files[i].name, size: files[i].size, type: files[i].type};
                // this.addedMedia.push(addedImage);
            }
        },
        removeMedia(index) {
            let removedImage = this.images[index];
            if (removedImage.url.startsWith('blob:')) {
                URL.revokeObjectURL(removedImage.url);
            }
            this.images.splice(index, 1);
        },
        getProduct(){

            this.loading = true
            this.$axios.get(`/api/product/${this.$route.params.id}`)
            .then(res => {
                console.log(res.data)
                this.productName = res.data?.title;
                this.defaultPrice = res.data?.selling_price;
                this.defaultStoke = res.data?.stok;
                this.description = res.data?.description;
                this.details = res.data?.details;
                this.categoryId = res.data?.category?.id;
                this.brandId = res.data?.brand?.id;
                this.productImages = res.data?.images
            })
            .catch(err => {
                console.log(err)
            })
                .finally(() => this.loading = false);
        },
        deleteImage(id, index){
            if(confirm("Are you sure? Want To Remove This Image...")){
                this.$axios.delete('/api/delete-product-image/'+id, )
                    .then(res => {
                        Toast.fire({
                            icon: 'success',
                            title: "Image Delete Success..."
                        });
                        this.productImages.splice(index, 1)
                    })
                    .catch(err => {
                        Toast.fire({
                            icon: 'error',
                            title: err.response.data.message
                        });
                    })
            }
        },
    },
    created() {
        this.allVerients();
        this.allBrands();
        this.getProduct();
    }
}
</script>

<style scoped>

.mu-container{
    background-color: #fbfbfb !important;
    border-radius: 5px !important;
    /*border-style: solid !important;*/
    /*border: 1px solid #9b9b9b !important;*/
    box-sizing: border-box !important;
    width: 100% !important;
    height: auto !important;
}

/* ----elements-wrapper--- */

.mu-elements-wraper {
    padding: 1rem !important;
    display: flex !important;
    flex-wrap: wrap !important;
}

/* ----plusbox--- */

.mu-plusbox-container{
    display: inline-flex !important;
    height: 90px !important;
    width: 140px !important;
    margin: 0.25rem !important;
}
.mu-plusbox {
    background-color: #ffffff !important;
    border: 1px dashed #818181 !important;
    border-radius: 5px !important;
    cursor: pointer !important;
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    width: 140px !important;
    height: 90px !important;
}
.mu-plusbox:hover{
    background-color: #f1f1f1 !important;
}
.mu-plusbox:hover > .mu-plus-icon{
    color: #028296 !important;
}
.mu-plus-icon{
    color: #00afca !important;
    font-size: 3rem !important;
    flex: 1;
}

/* ----media-preview---- */

.mu-image-container{
    width: 140px !important;
    height: 90px !important;
    margin: 0.25rem !important;

    position: relative;
}
.mu-images-preview {
    border-radius: 5px !important;
    border: 1px solid #818181 !important;
    width: 140px !important;
    height: 90px !important;
    transition: filter 0.1s linear;
    object-fit: cover;
    object-position: center;
}
.mu-images-preview:hover{
    filter: brightness(90%);
}

.mu-close-btn{
    background: none !important;
    color:white !important;
    border: none !important;
    padding: 0px !important;
    margin:0px !important;
    cursor: pointer !important;

    position: absolute !important;
    top: 0px;
    right: 0px;
}
.mu-times-icon{
    font-size: 3rem !important;
    filter: drop-shadow(0px 0px 1px black);
}
.mu-close-btn:hover{
    color: red !important;
}

/* -------------------- */

.mu-red-border {
    border: 1px solid #dc3545 !important;
}

.mu-mt-1 {
    margin-top: 0.25rem !important;
}

/* -------------------- */

img {
    -webkit-user-drag: none;
    -khtml-user-drag: none;
    -moz-user-drag: none;
    -o-user-drag: none;
}

</style>

