<template>
    <div>
        <div class="row match-height">
            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Product Carts
                                <span class="d-block text-muted pt-2 font-size-sm">all employees details is here</span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body pos-card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="">
                            <thead class="pos-t-head">
                                <tr>
                                    <!-- <th style="width:1%">#_ID</th> -->
                                    <th style="width: 30%">Title</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, i) in cart.getAllItems()" :key="`card-product-${i}`">
                                    <!-- <td>{{ i+1 }}</td> -->
                                    <td><a href="#" @click="showSingleProduct(product.id)">{{
                                        product?.product?.title?.slice(0, 10) }}...</a></td>
                                    <td>{{ product.buyQty }}
                                        <a href="javascript:void(0);" @click="cart.incrementQty(product.id)"
                                            class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                        <path
                                                            d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                            fill="#000000" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>

                                        <a href="javascript:;" @click="cart.decrementQty(product.id)"
                                            class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                        <rect fill="#000000" x="6" y="11" width="12" height="2" rx="1" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>
                                    </td>
                                    <td>{{ product.price }} $</td>
                                    <td>{{ product.price * product?.buyQty }} $</td>
                                    <td>
                                        <a href="javascript:void(0)" @click="cart.removeFromCart(product)"
                                            class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                            fill="#000000" fill-rule="nonzero" />
                                                        <path
                                                            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                            fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="pos-account" v-if="cart.getSubTotal() > 0">
                            Total Items:
                            <h4 class="fw-bolder">Sub Total: {{ cart.getSubTotal() }} $</h4>
                        </div>
                    </div>
                </div>
                <div class="card card-custom mt-5">
                    <div class="card-body">
                        {{ error?.response?.data }}
                        <form @submit.prevent="saveOrder()">
                            <div class="form-group">
                                <label>Select Customer</label>
                                <v-select :options="customers"
                                        class="form-control form-control-solid"
                                        style="padding:0.375rem 0.75rem"
                                        v-model="order.customer"
                                        @update:modelValue="setCustomerAddresses"
                                        :reduce="customer => customer.id"
                                        label="full_name"
                                        placeholder="Select Customer..."/>
                            </div>

                            <div class="form-group">
                                <label>Payment Method</label>
                                <select class="form-control form-control-solid" v-model="order.payby">
                                    <option disabled selected value="">~~ Select Payment Method~~</option>
                                    <option v-for="item in paymentMethods?.split('|')" :value="item" v-text="item"/>

                                </select>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">All Products
                                <span class="d-block text-muted pt-2 font-size-sm">all products with product details</span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="text" v-model="filterBox" class="form-control form-control-solid mb-3"
                            placeholder="Search.....">
                        <div class="example-preview">
                            <TreeCategory
                                class="form-control form-control-solid"
                                style="padding:0.375rem 0.75rem"
                                v-model="selectCategory"
                                @update:modelValue="changeData" />

                            <ComponentLoader v-if="loading" style="min-height:40vh"/>
                            <div v-else class="tab-content mt-5 show-product-overflow" id="myTabContent1">
                                <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">
                                    <div class="row match-height px-1">
                                        <div class="col-md-4 mt-2 px-1" v-for="(product, i) in filteredProducts"
                                            @dblclick="addToCart(product)" :key="`pos-s-roduct-${i}`">
                                            <div class="card cursor-pointer">
                                                <div class="card-body p-0 d-flex flex-column justify-content-between">
                                                    <div class="card-image">
                                                        <img :src="`${product?.product?.images[0]?.url}`" />
                                                    </div>
                                                    <div class="card-heading fw-bold">
                                                        {{ product?.product?.title }}...
                                                    </div>
                                                    <div class="card-text">
                                                        {{ product?.price }} $
                                                    </div>
                                                    <a href="javascript:void(0)" class="card-button"
                                                        @click="showProductDetails(product)">Show Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="img-preview-scroll">
                                        <img class="w-100" :src="`${img?.url}`"
                                            v-for="(img, i) in productDetails?.product?.images"
                                            :key="`single-image-${i}`" />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <img class="w-100" :src="`${productDetails?.product?.images[0]?.url}`" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h1 class="text-capitalize fw-bold">{{ productDetails?.product?.title }}-{{
                                productDetails.varient?.replace(/\//g, '-')?.slice(0, -1) }}</h1>
                            <h4>Product Sku: {{ productDetails?.sku }}</h4>
                            <p>Category: <strong>{{ productDetails?.product?.category?.name }}</strong> </p>
                            <p class="text-capitalize">Variation: {{ productDetails.varient?.replace(/\//g, '-')?.slice(0, -1) }}</p>

                            <h2 class="fw-bolder fs-2">Price: {{ productDetails.price }} $</h2>

                            <div class="border-t w-100">
                                <button class="btn btn-primary w-100 rounded-0 py-5 fs-2 fw-bold" @click="singleClickAdd">Add To Pos</button>
                            </div>

                        </div>
                    </div>

                    <div class="row border-top mt-3">
                        <div class="col-md-12">

                            <hr/>
                            <div>
                                <h3>Desscription</h3>
                                <p>{{ productDetails?.product?.description }}</p>
                            </div>

                            <hr/>
                            <div>
                                <h3>Desscription</h3>
                                <div class="product-content" v-html="productDetails?.product?.details"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, reactive, toRefs, computed } from 'vue';
import TreeCategory from "@/components/TreeCategory.vue";
import useApi from "@/composables/useApi.js";
import useCart from "@/composables/useCart.js";
import ComponentLoader from "@/components/ComponentLoader.vue";

const { sendRequest, loading, error } = useApi();
const cart = useCart();
const order = ref({
    customer: '',
    payby: '',
});

const customers = ref([]);
const products = ref([]);
const filterBox = ref(null);
const selectCategory = ref(null);
const productDetails = ref([]);
const paymentMethods = ref(null)

const categoryProducts = ref([]);
const CartProducts = ref([]);
const product = ref(null);

const customerAddresses = ref([])

const allProducts = async () => {
    const loadProducts = await sendRequest("api/admin/pos-products")
    if (products) {
        products.value = loadProducts
    }
};



const getAllCustomers = async () => {
    const data = await sendRequest("api/customer?onlyData")
    if (data) {
        customers.value = data
    }
};



const getAllMethods = async () => {
    const data = await sendRequest("/api/admin/get-setting?settings=posPaymentMethods")
    if (data) {
        paymentMethods.value = data
    }
};


const filteredProducts = computed(() => {
    let filtered = products.value;

    if (filterBox.value) {
        filtered = filtered.filter(product => {
            return product?.product?.title?.toLowerCase().includes(filterBox.value);
        });
    }

    if (selectCategory.value) {
        filtered = filtered.filter(product => {
            return product?.product?.category?.id === selectCategory.value;
        });
    }
    return filtered;
});



const addToCart = (product) => {
    cart.addToCart({ ...product, buyQty: 1 });
};

const singleClickAdd = () => {
    cart.addToCart({ ...productDetails.value, buyQty: 1 });
    $('#exampleModal').modal('hide');
};


const showProductDetails = (product) => {
    $('#exampleModal').modal('show');
    productDetails.value = product;

};

const saveOrder = async () => {
    const data = await sendRequest({
        url: "api/pos",
        method:"POST",
        data:{...order.value,
            subTotal: cart.getSubTotal(),
            products: cart.getAllItems()
        }
    })

    if(data.message){
        cart.clearCart();
        order.value.customer = "";
        order.value.payby = "";
        Toast.fire({
            icon: 'success',
            title: data.message
        })
    }
};


const changeData = (event) => {
    console.log(event)
};

// Computed properties
const subTotal = computed(()=>{
    let subTotal = 0;
    const total = cart.getAllItems().map(item =>{
        subTotal += item.price * item.buyQty

        return subTotal;
    })
    return subTotal;
})


const setCustomerAddresses = (event) =>{
    // if need selected customer address and price.
    const customer = customers.value.filter(item => item.id === event)[0];
}



// const totaldue = computed(()=>{
//     return subTotal - order.value?.payBill
// })



// Lifecycle hooks
onMounted(() => {
    allProducts();
    getAllCustomers();
    cart.initCart();
    getAllMethods()
});

</script>


<style scoped>
/* Card Styles */

.card-sl {
    border-radius: 8px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.card-image img {
    max-height: 100%;
    max-width: 100%;
    border-radius: 8px 8px 0px 0;
    min-height: 80px;
}

.card-action {
    position: relative;
    float: right;
    margin-top: -15px;
    margin-right: 3px;
    z-index: 2;
    color: #5cd2e2;
    background: #fff;
    border-radius: 100%;
    box-shadow: 0px 0px 4px -1px #868b7d66, 0px 0px 1px 0 #fdff90 inset;
    padding: 5px 5px;
    width: 25px;
    height: 25px;
}

.card-action:hover {
    color: #fff;
    background: #ffecc3;
    -webkit-animation: pulse 1.5s infinite;
}

.card-heading {
    font-size: 15px;
    font-weight: 500;
    background: #fff;
    padding: 0 10px;
}

.card-text {
    padding: 0px 10px;
    background: #fff;
    font-size: 14px;
    font-weight: bold;
    color: #636262;
}

.card-button {
    display: flex;
    justify-content: center;
    padding: 10px 0;
    width: 100%;
    background-color: #1F487E;
    color: #fff;
    border-radius: 0 0 8px 8px;
}

.card-button:hover {
    text-decoration: none;
    background-color: #1D3461;
    color: #fff;

}

.pos-card-body {
    max-height: 30rem;
    overflow-y: scroll;
    background: white;
}

.pos-card-body .pos-t-head {
    position: sticky;
    top: -30px;
    background: white;
}

.pos-account {
    position: sticky;
    bottom: -20px;
    background: white;
}

.img-preview-scroll {
    max-height: 250px;
    overflow-y: scroll;
}

.show-product-overflow{
    max-height: 80vh;
    overflow-y: scroll;
    overflow-x: hidden;
}

@-webkit-keyframes pulse {
    0% {
        -moz-transform: scale(0.9);
        -ms-transform: scale(0.9);
        -webkit-transform: scale(0.9);
        transform: scale(0.9);
    }

    70% {
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        -webkit-transform: scale(1);
        transform: scale(1);
        box-shadow: 0 0 0 50px rgba(90, 153, 212, 0);
    }

    100% {
        -moz-transform: scale(0.9);
        -ms-transform: scale(0.9);
        -webkit-transform: scale(0.9);
        transform: scale(0.9);
        box-shadow: 0 0 0 0 rgba(90, 153, 212, 0);
    }
}</style>
<style>
    .vs__dropdown-toggle{
        border: none !important;
    }
</style>
