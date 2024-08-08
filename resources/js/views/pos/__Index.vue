<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="card card-custom" style="width: 100%">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Product Carts
                                    <span class="d-block text-muted pt-2 font-size-sm">all employees details is here</span>
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <router-link :to="{name:'AddEmployee'}" href="#" class="btn btn-default font-weight-bolder btn-sm">
                                <span class="svg-icon svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                            <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                              </span>
                                </router-link>
                                <!--end::Button-->
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-separate table-head-custom table-checkable" id="">
                                <thead>
                                <tr>
                                    <th style="width:1%">Record ID</th>
                                    <th style="width: 5%">Title</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(product, i) in CartProducts" :key="`card-product-${i}`">
                                    <td>{{ i+1 }}</td>
                                    <td><a href="#" @click="showSingleProduct(product.product_id)">{{ product.title }}</a></td>
                                    <td>{{ product.quantity }}
                                        <a href="javascript:;" @click="quentityIncrement(product.id)" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>
                                        <a href="javascript:;" @click="quentityDecrement(product.id)" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Minus.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <rect fill="#000000" x="6" y="11" width="12" height="2" rx="1"/>
                                                    </g>
                                                </svg><!--end::Svg Icon-->
                                            </span>
                                        </a>
                                    </td>
                                    <td>{{ product.price }}</td>
                                    <td>{{ product.sub_total }}</td>
                                    <td>
                                        <a href="javascript:;" @click="deleteCartProduct(product.id)" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card card-custom" style="width: 100%">
                            <div class="card-header flex-wrap py-5">

                                <table class="table table-bordered">
                                    <tr>
                                        <td>Total Quantity</td>
                                        <td>{{ totalQty }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>{{ subTotal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Vat</td>
                                        <td>5%</td>
                                    </tr>
                                    <tr>
                                        <td>Grand Total</td>
                                        <td>{{ grandTotal }}</td>
                                    </tr>
                                </table>
                            </div>
                            <form class="form" @submit.prevent="saveOrder()">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <select class="form-control form-control-solid" v-model="order.customer">
                                            <option disabled="true" selected>~~Select Customer ~~</option>
                                            <option  v-for="(customer, i) in employes" :value="customer.id" :key="`cm-${i}`">{{ customer.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pay</label>
                                        <input type="text" class="form-control form-control-solid" v-model="order.payBill" @keyup="payBillCheck()" placeholder="Enter employee name..."/>
                                    </div>
                                    <div class="form-group">
                                        <label>Due</label>
                                        <input type="text" class="form-control form-control-solid" v-model="order.totalDue" disabled="true" placeholder="Enter employee name..."/>
                                    </div>

                                    <div class="form-group">
                                        <label>Pay By</label>
                                        <select class="form-control form-control-solid" v-model="order.payby">
                                            <option disabled="true" selected>~~ Select Payment Method~~</option>
                                            <option value="han_cash">Han Cash</option>
                                            <option value="bikash">Bikash</option>
                                            <option value="rocket">Rocket</option>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="bank_check">Bank Check</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </form>

                        </div>
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
                        <input type="text" v-model="filterBox" class="form-control form-control-solid mb-3" placeholder="Product Search Form Here">
                        <div class="example-preview">

                            <TreeCategory @update:modelValue="changeData"/>
                            

                            <!-- <ul class="nav nav-pills" id="myTab1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab-1" data-toggle="tab" href="#home-1">
                                        <span class="nav-icon">
                                            <i class="flaticon2-chat-1"></i>
                                        </span>
                                        <span class="nav-text">All Products</span>
                                    </a>
                                </li>
                                <li class="nav-item" v-for="(category, i) in categories" :key="`cat-item-${i}`">
                                    <a @click="productByCategory(category.id)" class="nav-link" id="profile-tab-1" data-toggle="tab" href="#profile-1"
                                       aria-controls="profile">
                                            <span class="nav-icon">
                                                <i class="flaticon2-layers-1"></i>
                                            </span>
                                        <span class="nav-text">{{ category.name }}</span>
                                    </a>
                                </li>
                            </ul> -->

                            <div class="tab-content mt-5" id="myTabContent1">
                                <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">
                                    <div class="row match-height">
                                        <div class="col-md-4 mt-2" v-for="(product, i) in filterProducts"
                                         @dblclick="doubleClick(product.id)" 
                                         @click="singleClick(product.id)" :key="`pos-s-roduct-${i}`">
                                            <router-link to="">
                                                <div class="card-sl">
                                                    <div class="card-image">
                                                        <img :src="`${ product?.product?.images[0]?.url}`" />
                                                    </div>
                                                    <div class="card-heading">
                                                        {{ product?.product?.title?.slice(0, 10) }} - {{ product.varient?.replace(/\//g, '-')?.slice(0, -1) }}...
                                                    </div>
                                                    <div class="card-text">
                                                        {{ product?.price }} $
                                                    </div>
                                                    <a href="#" class="card-button" @click="doubleClick(product.id)"> Purchase</a>
                                                </div>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                                    <div class="row">
                                        <div class="col-md-4 mt-2" v-for="(product, i) in categoryProducts" 
                                        @dblclick="doubleClick(product.id)" 
                                        @click="singleClick(product.id)" :key="`product-${i}`">
                                            <router-link to="">
                                                <div class="card-sl">
                                                    <div class="card-image">
                                                        <img :src="`${product.photo}`" />
                                                    </div>
                                                    <a class="card-action" href="#"><i class="fa fa-heart"></i></a>
                                                    <div class="card-heading">
                                                        {{ product.title }}
                                                    </div>
                                                    <div class="card-text">
                                                        $67,400
                                                    </div>
                                                    <a href="#" class="card-button" @click="doubleClick(product.id)"> Purchase</a>
                                                </div>
                                            </router-link>
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
        <div class="modal fade bd-example-modal-lg ml-8" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Product Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <!--begin::Section-->
                        <!--begin::Engage Widget 13-->
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Card Body-->
                            <!--                            bg-danger-->
                            <div
                                class="card-body d-flex rounded  p-12 flex-column flex-md-row flex-lg-column flex-xxl-row">
                                <!--begin::Image-->
                                <div
                                    class="bgi-no-repeat bgi-position-center bgi-size-cover h-300px h-md-auto h-lg-300px h-xxl-auto mw-100 w-550px m-auto"
                                    :style="{ backgroundImage: `url(${product.photo})` } "
                                ></div>
                                <!--end::Image-->
                                <!--begin::Card-->
                                <div class="card card-custom w-auto w-md-300px w-lg-auto w-xxl-300px ml-auto">
                                    <!--begin::Card Body-->
                                    <div class="card-body px-12 py-10">
                                        <h3 class="font-weight-bolder font-size-h2 mb-1">
                                            <a href="#" class="text-dark-75">{{ product.title }}</a>
                                        </h3>
                                        <div class="text-primary font-size-h4 mb-9">Sealing Price: {{ product.selling_price }} Tk</div>
                                        <div class="font-size-sm mb-8">Outlines keep you honest. They stop you from
                                            indulging in poorly ought out metaphorsy about driving and keep you focused
                                            one the overall structure of your post
                                        </div>
                                        <!--begin::Info-->
                                        <div class="d-flex mb-3">
                                            <span class="text-dark-50 flex-root font-weight-bold">Shoes Brand</span>
                                            <span class="text-dark flex-root font-weight-bold">Nike</span>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <span class="text-dark-50 flex-root font-weight-bold">SKU</span>
                                            <span class="text-dark flex-root font-weight-bold">NF3535</span>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <span class="text-dark-50 flex-root font-weight-bold">Color</span>
                                            <span class="text-dark flex-root font-weight-bold">White</span>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <span class="text-dark-50 flex-root font-weight-bold">Collection</span>
                                            <span class="text-dark flex-root font-weight-bold">2020 Spring</span>
                                        </div>
                                        <div class="d-flex">
                                            <span class="text-dark-50 flex-root font-weight-bold">In Stock</span>
                                            <span class="text-dark flex-root font-weight-bold">280</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Card Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Card Body-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
let time = null;
import TreeCategory from "@/components/TreeCategory.vue"
export default {
    name: "ManageEmployee",
    components:{
        TreeCategory
    },
    data() {
        return {
            form:{
                name:'',
                position: '',
            },
            order:{
                customer:'',
                totalDue: '',
                payby:'',
                payBill:'',
            },
            employes: {},
            products: {},
            categories: {},
            categoryProducts: {},
            CartProducts:{},
            product:{},
            filterBox:null,
        }
    },
    methods: {
        allCustomer() {
            this.$axios.get('api/customer')
            .then(res => {
                this.employes = res.data
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        },
        allProducts(){
            this.$axios.get('api/admin/pos-products')
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

        },
        allCategories(){
            this.$axios.get('api/category')
            .then(res => {
                this.categories = res.data
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        },
        productByCategory(id){
            this.$axios.get('api/product-by-category-id/'+id)
            .then(res => {
                this.categoryProducts = res.data
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        },

        addToPos(id){
            this.$axios.post('api/pos', {id})
            .then(res => {
                Reload.$emit('AfterAdd');
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                })
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.data.message
                })
            })
        },

        allCartProduct(){
            this.$axios.get('api/pos')
                .then(res => {
                    this.CartProducts = res.data
                })
                .catch(err => {
                    err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.statusText
                    })
                })
        },

        showSingleProduct(id) {
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

        },

        deleteCartProduct(id){
            Swal.fire({
                title: 'Are You Sure!',
                text: 'you watnt to delete this?',
                icon:'warning',
                confirmButtonColor: '#ddd',
                cancelButtonColor: 'red',
                confirmButtonText: 'Delete',
                showCancelButton:true,
            }).then((result) => {
                if (result.value){
                    this.$axios.delete('/api/pos/delete-cart/'+ id)
                    .then(res => {
                        Reload.$emit('AfterAdd');
                        Toast.fire({
                            icon: 'success',
                            title: res.data.message
                        })
                        this.allEmployee();
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    })
                }
            }).catch(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'dont worry. your data is safe...'
                })
                this.$router.push({name:'ManageEmployee'});
            })
        },
        quentityIncrement(id){
            this.$axios.get('/api/pos/increment-cart-product/'+ id)
                .then(res => {
                    Reload.$emit('AfterAdd');
                    Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                    this.allEmployee();
                })
                .catch(err => {
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.data.message
                    })
                })
        },
        quentityDecrement(id){
            this.$axios.get('/api/pos/decrement-cart-product/'+ id)
                .then(res => {
                    console.log(res);
                    Reload.$emit('AfterAdd');
                    Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                    this.allEmployee();
                })
                .catch(err => {
                    console.log(err.response.data)
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.data.message
                    })
                })
        },
        payBillCheck(){
             this.order.totalDue = this.grandTotal - this.order.payBill
        },
        saveOrder(){
            this.$axios.post('api/order', this.order)
            .then( res => {
                Reload.$emit('AfterAdd');
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                });
                this.order = ''
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.data.message
                })
            })
        },
        isLogined() {
            if (!User.loggedIn()) {
                this.$router.push({name: "Login"})
            }
        },
        // first clear  time
        singleClick(id) {
            clearTimeout(time);
            time = setTimeout(() => {
                this.showSingleProduct(id)
            }, 300);
        },

        doubleClick(id) {
            clearTimeout(time);
            this.addToPos(id)
        },

        changeData(event){
            console.log(event)
        },


    },
    computed: {
      totalQty(){
          let sum = 0;
          for (let i = 0; i < this.CartProducts.length; i++){
              sum +=  this.CartProducts[i].quantity
          }
          return sum;
          localStorage.setItem('subTotalAmount', sum);
      },
      subTotal(){
        let sum = 0;
          for (let i=0; i< this.CartProducts.length; i++){
              sum += this.CartProducts[i].sub_total
          }
        return sum;
      },
      grandTotal(){
            let vat = (this.subTotal * 5) /100;
            let grandTotal = vat + this.subTotal
            return grandTotal;
      },


      filterProducts(){
        return this.products?.map(item => {
            console.log(item)

            return item?.product?.cateogry?.id ;
        })
      }



    },
    created() {
        this.isLogined();
        this.allCustomer();
        this.allCategories();
        this.allProducts();
        this.allCartProduct();
        this.allCartProduct();
        // Reload.$on('AfterAdd', () => {
        //     this.allCartProduct();
        // })
    }
}
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
    min-height:80px;
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
}
</style>
