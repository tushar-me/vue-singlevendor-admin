<template>
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">Order Areas
                    </h3>
                </div>
                <div class="card-tools">
                    <button class="btn btn-primary" @click="addNewArea">Add New Area</button>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable">
                    <thead class="table-light">
                    <tr class=null>
                        <th class="sorting">Id</th>
                        <th class="sorting">Area Name</th>
                        <th class="sorting">Area Code</th>
                        <th class="sorting">Delivery Charge</th>
                        <th class="sorting">Charge Condition</th>
                        <th class="sorting">Condition Price</th>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(area, i) in arias.data" :key="area.id">
                        <td>{{ i + 1 }}</td>
                        <td>{{ area.area_name }}</td>
                        <td>{{ area.area_code }}</td>
                        <td>{{ area.delivery_charge }}</td>
                        <td>{{ area.charge_condition ?? '........' }}</td>
                        <td>{{ area.charge_condition_price ?? '........' }}</td>
                        <td>

                            <button @click="editData(area)" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                <span class="svg-icon svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2"
                                                  rx="1" />
                                        </g>
                                    </svg>
                                </span>
                            </button>

                            <button class="btn btn-sm btn-clean btn-icon" @click="deleteItem(area?.id)" title="Delete">
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
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ isEdit ? 'Edit Address' : 'Add Address' }}</h2>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="saveNewArea">
                            <div class="mb-1">
                                <label class="form-label">Address</label>
                                <input class="form-control readonly" v-model="createForm.area_name" type="text"
                                       placeholder="e.g Area name" />
                                <small v-if="error?.response?.data?.errors['area_name']" class="text-danger">{{
                                        error?.response?.data?.errors["area_name"][0] }}</small>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Area Code</label>
                                <input class="form-control readonly" v-model="createForm.area_code" type="text"
                                       placeholder="e.g Area code" />
                                <small v-if="error?.response?.data?.errors['area_code']" class="text-danger">{{
                                        error?.response?.data?.errors["area_code"][0] }}</small>

                            </div>
                            <div class="mb-1">
                                <label class="form-label">Delivery Charge</label>
                                <input class="form-control readonly" v-model="createForm.delivery_charge" type="number"
                                       placeholder="e.g Delivery charge for this area" />
                                <small v-if="error?.response?.data?.errors['delivery_charge']" class="text-danger">{{
                                        error?.response?.data?.errors["delivery_charge"][0] }}</small>

                            </div>
                            <div class="mb-1">
                                <label class="form-label">Charge Condition</label>
                                <input class="form-control readonly" v-model="createForm.charge_condition" type="number"
                                       placeholder="e.g Charge Condition price" />
                                <small v-if="error?.response?.data?.errors['charge_condition']" class="text-danger">{{
                                        error?.response?.data?.errors["charge_condition"][0] }}</small>

                            </div>
                            <div class="mb-1">
                                <label class="form-label">Condition Price</label>
                                <input class="form-control readonly" v-model="createForm.charge_condition_price" type="number"
                                       placeholder="e.g Charge Condition price" />
                                <small v-if="error?.response?.data?.errors['charge_condition_price']" class="text-danger">{{
                                        error?.response?.data?.errors["charge_condition_price"][0] }}</small>

                            </div>


                            <div class="d-flex flex-wrap mb-0">
                                <RequestLoading :isShow="loading" :text="isEdit ? 'Updating....' : 'Saved.....'"/>
                                <div v-if="!loading">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary ms-1" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";
import useApi from "@/composables/useApi.js"
import RequestLoading from "@/components/RequestLoading.vue";

const user = User.userInfo();

const arias = ref([]);
const { sendRequest, loading, error } = useApi();
const createForm = ref({
    id:null,
    area_name: null,
    area_code: null,
    delivery_charge: null,
    charge_condition: null,
    charge_condition_price: null,
})

const isEdit = ref(false)
const addNewArea = (info) => {
    isEdit.value = false;
    $('#exampleModal').modal('show')
};

const saveNewArea = async () => {
    const data = await sendRequest({
        method: 'POST',
        data: createForm.value,
        url: `/api/admin/areas-save`,
        headers: {
            "Authorization": `Bearer ${user?.token}`
        }
    })
    if (data?.message) {
        await getAreas();
        createForm.value = {}
        $('#exampleModal').modal('hide');
        await Toast.fire({
            icon: 'success',
            title: data?.message
        });
    }
}

const getAreas = async () => {
    arias.value = await sendRequest({
        method: 'get',
        url: `/api/admin/areas`,
        headers: {
            "Authorization": `Bearer ${user?.token}`
        }
    });
}

const deleteItem = (id) => {
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
            const data = await sendRequest({
                method: 'GET',
                url: `/api/admin/delete-area/${id}`,
                headers: {
                    "Authorization": `Bearer ${user?.token}`
                }
            })
            await getAreas();
            await Toast.fire({
                icon: 'success',
                title: res.data.message
            })

        }
    }).catch(() => {
        Toast.fire({
            icon: 'success',
            title: "Successfully Deleted..."
        })
    })
}


const editData = async (item) => {
    isEdit.value = true;
    createForm.value = item;
    $('#exampleModal').modal('show');
}


onMounted(async () => {
    await getAreas();
})
</script>

<style scoped></style>
