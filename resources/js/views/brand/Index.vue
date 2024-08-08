<template>
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 v-if="!isLoading" class="card-label">All Brands
                        <span class="d-block text-muted pt-2 font-size-sm">all brnds details is here</span>
                    </h3>
                    <RequestLoading :isShow="isLoading" text="Loading....."/>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <router-link :to="{ name: 'AddBrand' }" href="#" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                    <path
                                        d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>New Record</router-link>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-borderless" id="">
                    <thead>
                        <tr>
                            <th>Record ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(brand, i) in brands" :key="`brand-${i}`">
                            <td>{{ i + 1 }}</td>
                            <td>
                                <span class="symbol-label">
                                    <img :src="`/storage/${brand.photo}`" style="width: 130px; height: 80px; object-fit: contain">
                                </span>
                            </td>
                            <td>{{ brand.title }}</td>
                            <td>
                                <router-link :to="{ name: 'EditBrand', params: { id: brand.id } }"
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
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2"
                                                    rx="1" />
                                            </g>
                                        </svg>
                                    </span>
                                </router-link>

                                <a href="javascript:;" @click="deleteBrand(brand.id)" class="btn btn-sm btn-clean btn-icon"
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
            </div>
        </div>
    </div>
</template>

<script>
import RequestLoading from "@/components/RequestLoading.vue";

export default {
    name: "Index",
    components: {RequestLoading},
    data() {
        return {
            isLoading:false,
            brands: {}
        }
    },
    methods: {
        allBrands() {
            this.isLoading = true;
            this.$axios.get('api/brand')
                .then(res => {
                    this.brands = res.data
                })
                .catch(err => {
                    err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.statusText
                    })
                })
                .finally(final =>{
                    this.isLoading = false;
                })
        },
        deleteBrand(id) {
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
                    this.$axios.delete('/api/brand/' + id)
                        .then(res => {
                            Toast.fire({
                                icon: 'success',
                                title: res.data.message
                            })
                            this.allBrands();
                        })
                        .brandch(err => {
                            Toast.fire({
                                icon: 'error',
                                title: err.response.statusText
                            })
                        })
                        .finally(final =>{
                            this.isLoading = false;
                        })
                }
            }).brandch(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'dont worry. your data is safe...'
                })
                this.$router.push({ name: 'ManageEmployee' });
            })
        },

        isLogined() {
            if (!User.loggedIn()) {
                this.$router.push({ name: "Login" })
            }
        }
    },
    created() {
        this.isLogined();
        this.allBrands();
    }
}
</script>

<style scoped></style>
