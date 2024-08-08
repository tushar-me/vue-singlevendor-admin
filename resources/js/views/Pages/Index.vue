<template lang="html">
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <div v-if="!loading">
                        <h3 class="card-label">Pages</h3>
                    </div>
                    <RequestLoading :isShow="loading" text="Loadin....."/>
                </div>
                <div class ="card-toolbar">
                    <!--begin::Button-->
                    <RouterLink :to="{name:'PageCreate'}"  class="btn btn-primary font-weight-bolder">
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
                    </RouterLink>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <ul class="d-flex flex-column gap-5">
                    <li class="d-flex align-items-center justify-content-between" style="border-bottom:1px solid #ededed" v-for="page in pages">
                        <div>
                            <h4 class="text-capitalize">{{ page.title }}</h4>
                            <div class="d-flex gap-3">
                                <strong>Slug: </strong>
                                <p class="m-0 p-0" v-html="page?.slug"/>
                            </div>
                        </div>

                        <button class="btn btn-icon btn-light-danger ms-2" title="Edit details"
                                @click="deletePage(page?.id)">
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
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

import SummernoteEditor from 'vue3-summernote-editor';
import Pagination from "@/components/Pagination.vue";
import RequestLoading from "@/components/RequestLoading.vue";
import moment from "moment";
export default {
    name: "Index",
    components:{
        SummernoteEditor,
        RequestLoading,
        Pagination
    },
    data() {
        return {
            pages: [],
            loading:false,
        }
    },
    methods: {
        allProducts(path) {
            this.loading = true
            this.$axios.get(path ?? 'api/pages')
                .then(res => {
                    this.pages = res.data
                })
                .catch(err => {
                    err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.statusText
                    })
                }).finally(() => this.loading = false);

        },
        deletePage(id) {
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
                    this.$axios.delete('/api/pages/' + id)
                        .then(res => {
                            Toast.fire({
                                icon: 'success',
                                title: "Page Deleted..."
                            })
                            this.allProducts();
                        })
                        .catch(err => {
                            Toast.fire({
                                icon: 'error',
                                title: err.response.statusText
                            })
                        }).finally(() => this.loading = false);
                }
            }).catch(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'dont worry. your data is safe...'
                })
                this.$router.push({name: 'ManageEmployee'});
            })
        },
    },
    created() {
        this.allProducts();
    }
}
</script>

<style scoped>

</style>
