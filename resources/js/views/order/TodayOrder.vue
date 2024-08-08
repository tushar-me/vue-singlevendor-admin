<template>
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">Order Details
                        <span class="d-block text-muted pt-2 font-size-sm">all employees details is here</span></h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Customer Name</th>
                        <th>Order Date</th>
                        <th>Total Pay</th>
                        <th>Total Due</th>
                        <th>Total Quantity</th>
                        <th>Pay By</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(order, i) in orders">
                        <td>{{ i+1 }}</td>
                        <td>{{ order.customer.name }}</td>
                        <td>{{ order.order_date }}</td>
                        <td>{{ order.pay_bill }}</td>
                        <td>{{ order.pay_due }}</td>
                        <td>{{ order.quantity }}</td>
                        <td>{{ order.payby }}</td>
                        <td>
<!--                            {name:'ShowOrderDetails', params:{id:order.id} }-->
                            <a href="#" class="btn btn-sm btn-clean btn-icon" title="Edit details" @click="showSingleOrder(order.id)">
                                <span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Compiling.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                </span>
                            </a>

                            <a href="javascript:;" @click="deleteCustomer(emp.id)" class="btn btn-sm btn-clean btn-icon" title="Delete">
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
                    <tfoot>
                        <tr class="table table-striped">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Grand Total: {{ grandTotalAmount }} Tk</th>
                            <th></th>
                            <th></th>
                            <th>Total Quantity: {{ totalQuantity }}</th>
                        </tr>
                    </tfoot>
                </table>
                <!--end: Datatable-->



            </div>
        </div>

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
                        <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                    <h1 class="display-4 font-weight-boldest mb-10">ORDER DETAILS</h1>
                                    <div class="d-flex flex-column align-items-md-end px-0">
                                        <!--begin::Logo-->
                                        <a href="#" class="mb-5">
                                            <img src="@/assets/images/logos/logo-dark.png" alt="">
                                        </a>
                                        <!--end::Logo-->
                                        <span class="d-flex flex-column align-items-md-end opacity-70">
                                            <span>Cecilia Chapman, 711-2880 Nulla St, Mankato</span>
                                            <span>Mississippi 96522</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="border-bottom w-100"></div>
                                <div class="d-flex justify-content-between pt-6">
                                    <div class="d-flex flex-column flex-root">
                                        <span class="font-weight-bolder mb-2">ORDER DATE</span>
                                        <span class="opacity-70">{{ orderDetails.order_date }}</span>
                                    </div>
                                    <div class="d-flex flex-column flex-root">
                                        <span class="font-weight-bolder mb-2">ORDER NO.</span>
                                        <span class="opacity-70">{{ Math.random() * 10 }}</span>
                                    </div>
                                    <div class="d-flex flex-column flex-root">
                                        <span class="font-weight-bolder mb-2">DELIVERED TO.</span>
                                        <span class="opacity-70">Iris Watson, P.O. Box 283 8562 Fusce RD.
																<br>Fredrick Nebraska 20620</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                            <div class="col-md-10">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th class="pl-0 font-weight-bold text-muted text-uppercase">Ordered Items</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
                                            <th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
                                            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="font-weight-boldest" v-for="(product, i) in orderDetails.orderdetails">
                                                <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                        <div class="symbol-label" :style="{backgroundImage : `url( ${product.product_image})`}"></div>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    {{ product.product_title }}
                                                </td>
                                                <td class="text-right pt-7 align-middle">{{ product.product_quantity }}</td>
                                                <td class="text-right pt-7 align-middle">{{ product.product_price }}</td>
                                                <td class="text-primary pr-0 pt-7 text-right align-middle"> {{ product.sub_total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                            <div class="col-md-10">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th class="font-weight-bold text-muted text-uppercase">PAYMENT TYPE</th>
                                            <th class="font-weight-bold text-muted text-uppercase">PAYMENT STATUS</th>
                                            <th class="font-weight-bold text-muted text-uppercase">PAYMENT DATE</th>
                                            <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL PAID</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-weight-bolder">
                                            <td>Credit Card</td>
                                            <td>Success</td>
                                            <td>Jan 07, 2020</td>
                                            <td class="text-primary font-size-h3 font-weight-boldest text-right">$789.00</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                            <div class="col-md-10">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Order Details</button>
                                    <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Order Details</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "ManageEmployee",
    data() {
        return {
            orders : {},
            orderDetails:{},
        }
    },
    methods: {
        allOrder() {
            axios.get('api/order')
            .then(res => {
                this.orders = res.data
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        },
        showSingleOrder(id){
            axios.get('api/order-details/'+id)
            .then(res => {
                $('#exampleModal').modal('show');
                this.orderDetails = res.data
                console.log(res.data)
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        },
        isLogined(){
            if (!User.loggedIn()){
                this.$router.push({name:"Login"})
            }
        }
    },
    computed: {
        totalQuantity(){
          let sum=0;
          for (let i=0; i<this.orders.length ; i++ ){
              sum += this.orders[i].quantity
          }
          return sum;
      },
      grandTotalAmount(){
          let sum=0;
          for (let i=0; i<this.orders.length ; i++ ){
              sum += this.orders[i].pay_bill
           }
           return sum;
      }
    },
    created() {
        this.isLogined();
        this.allOrder();
    }
}
</script>

<style scoped>

</style>
