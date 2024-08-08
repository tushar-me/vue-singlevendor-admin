<template>
    <div>
        <ComponentLoader v-if="loading"/>

        <div v-else class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">Stoke Management
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="">
                    <thead>
                        <tr>
                            <th>Record ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <!-- <th>Supplier</th> -->
                            <th>Stoke Status</th>
                            <th>Unit price</th>
                            <th>Courrent Stoke</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tr v-for="(product, i) in products?.data" :key="`stoke-${i}`">
                        <td>#_{{ i + 1 }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <h5 class="fw-bold">{{ product?.product?.title }}</h5>
                                <small class="fs-6">Sku: {{ product?.sku }}</small>
                            </div>
                        </td>
                        <td>{{ product?.product?.category?.name }}</td>
                        <!-- <td>{{ product?.supplier?.name ?? '......' }}</td> -->
                        <td>
                            <span class="badge badge-success bg-success fw-bold text-white" v-if=" product.qty > 10">Available In Stoke</span>
                            <span class="badge badge-warning bg-warning fw-bold text-white" v-else-if="product.qty <= 10 && product.qty > 0 ">Low Stoke</span>
                            <span class="badge badge-danger bg-danger fw-bold text-white" v-else>Out Of Stoke</span>
                        </td>
                        <td>{{ product?.price }} $</td>
                        <td>{{ product.qty }}</td>
                        <td>
                            <button @click="editStoke(product)"
                                class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                <span class="svg-icon svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1" />
                                        </g>
                                    </svg>
                                </span>
                            </button>

                            <button class="btn btn-icon ms-2" title="Edit details" @click="deleteStoke(product?.id)">
                                <span class="svg-icon svg-icon-dark-50 svg-icon-2x">
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
                    <tbody>
                    </tbody>
                </table>
                <!--end: Datatable-->
                <Pagination  @some-event="getAllStokes" :links="products.links" :from="products.from" :to="products.to" :total="products.total" :notShowNumber="false"/>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fw-bold">Product: {{ stokeInfo?.product?.title }}</h4>
                        <h6 class="fw-bold">Varient: {{ stokeInfo?.varient?.replace(/\//g, '-')?.slice(0, -1)  }}</h6>
                        <h6 class="fw-bold">Sku: {{ stokeInfo?.sku }}</h6>
                        <h6 class="fw-bold">Unit Price: {{ stokeInfo?.price  }} $</h6>

                        <h6 class="fw-bolder">Current Stoke: <span class="badge bg-primary">{{  stokeInfo.qty }}</span></h6>
                        <hr class="border broder-1">

                        <div>
                            <label for="qty">Add Stoke Quantity</label>
                            <input v-model="qty" class="form-control" placeholder="e.g Add more 500 pc"/>
                        </div>

                        <button class="btn btn-primary ms-auto mt-3" @click="updateStoke">
                            Add To Stoke
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
import { onMounted, ref } from "vue";
import useApi from "@/composables/useApi.js"
import Pagination from "@/components/Pagination.vue"
const user = User.userInfo();
import ComponentLoader from "@/components/ComponentLoader.vue";

const products = ref([]);
const {sendRequest, loading}= useApi();
const stokeInfo = ref({})
const qty = ref(null)

const editStoke = (info)=>{
    $('#exampleModal').modal('show');
    stokeInfo.value = info;
}

const updateStoke = async () =>{
    const data = await sendRequest({
        method: 'put',
        data:{
            qty: qty.value
        },
        url: `/api/admin/update-stokes/${stokeInfo.value?.id}`,
        headers: {
            "Authorization": `Bearer ${user?.token}`
        }
    })

    if(data?.message){
        await getAllStokes();
        $('#exampleModal').modal('hide');
        Toast.fire({
            icon: 'success',
            title: data?.message
        });
    }
    console.log(data)

}

const getAllStokes =async (path) =>{
    const data = await sendRequest({
        method: 'get',
        url: path ?? `/api/admin/product-stokes`,
        headers: {
            "Authorization": `Bearer ${user?.token}`
        }
    })
    products.value = data;
}


function deleteStoke(id) {
    Swal.fire({
        title: 'Are You Sure!',
        text: 'you watnt to delete this?',
        icon: 'warning',
        confirmButtonColor: '#ddd',
        cancelButtonColor: 'red',
        confirmButtonText: 'Delete',
        showCancelButton: true,
    }).then(async (result) => {
        if (result.value) {
            sendRequest({
                url:"/api/delete-product-stoke/"+id,
                method:"DELETE",
            })

            Toast.fire({
                icon: 'success',
                title: res.data.message
            })
            await getAllStokes();
        }
    }).catch((err) => {
        console.log(err)

        Swal.fire({
            icon: 'success',
            title: 'dont worry. your data is safe...'
        })
        this.$router.push({name: 'ManageEmployee'});
    })
}


onMounted(async () => {
    await getAllStokes();
})
</script>

<style scoped></style>
