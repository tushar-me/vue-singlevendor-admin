<template>
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">Product Review</h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Total</th>
                        <th width="20%">Review</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, i) in review?.data" :key="`single-order-${i}`">
                        <td>{{ i + 1 }}</td>
                        <td>
                            <div class="d-flex gap-3">
                                <img :src="`https://ui-avatars.com/api/?background=random&rounded=true&color=fff&name=${item.name}&size=30`" alt="">
                                <div class="d-flex flex-column">
                                    <h4 class="text-capitalize">{{ item?.name }}</h4>
                                    <small>{{ item?.email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <router-link :to="`/modify-product/${item?.product?.id}`">{{ item?.product?.title }}</router-link>
                        </td>
                        <td>{{ item.rating }} out of 5</td>

                        <td>
                            <div class="d-flex gap-2 flex-column">
                                <strong class="text-capitalize">{{ item?.title }}</strong>
                                <p>{{ item?.review }}</p>
                            </div>
                        </td>
                        <td>{{ moment(item?.created_at).format('lll') }}</td>
                        <td>
                            <a href="javascript:void(0)" @click="deleteCustomer(item.id)" class="btn btn-sm btn-clean btn-icon"
                               title="Delete">
                                <span class="svg-icon svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                <!--end: Datatable-->
                <Pagination  @some-event="allOrder" :links="review?.links" :from="review?.from" :to="review?.to" :total="review?.total" :notShowNumber="false"/>
            </div>
        </div>


    </div>
</template>

<script>
import {ref} from "vue";
import Pagination from "@/components/Pagination.vue";
import moment from "moment";

export default {
    name: "MangeOrder",
    components: {Pagination},
    data() {
        return {
            review: {},
            orderDetails: {},
            user: User.userInfo(),
            reviewtatusList: [
                {name: 'Pending'},
                {name: 'Received'},
                {name: 'Process'},
                {name:'Shipped'},
                {name:'Delivered'},
                {name: 'Cancel'}
            ],
            paymentStatusList: [
                {name: 'Pending'},
                {name: 'Cancelled'},
                {name: 'Paid'}
            ],

            reviewtatus:null,
            paymentStatus:null
        }
    },
    methods: {
        allOrder(path) {
            this.$axios.get(path ?? '/api/review', {
                headers: {
                    'Authorization': `Bearer ${this.user?.token}`
                }
            })
            .then(res => {
                this.review = res.data;
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                });
            });
        },

        showSingleOrder(info) {
            $('#exampleModal').modal('show');
            this.orderDetails = info;
        },
        deleteCustomer(id){
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
                    this.$axios.delete('/api/review/' + id)
                        .then(res => {
                            Toast.fire({
                                icon: 'success',
                                title: res.data.message
                            })
                            this.allOrder();
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
        isLogined() {
            if (!User.loggedIn()) {
                this.$router.push({ name: "Login" })
            }
        }
    },
    computed: {
        moment() {
            return moment
        },
        totalQuantity() {
            let sum = 0;
            for (let i = 0; i < this.review.length; i++) {
                sum += this.review[i].quantity
            }
            return sum;
        },
        grandTotalAmount() {
            let sum = 0;
            for (let i = 0; i < this.review.length; i++) {
                sum += this.review[i].pay_bill
            }
            return sum;
        }
    },
    created() {
        this.isLogined();
        this.allOrder();
    },

}
</script>

<style scoped></style>
