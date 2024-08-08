<template>
    <div>


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
                        <div class="col-xl-12">
                            <!--begin::Nav Panel Widget 2-->
                            <div class="card card-custom card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex justify-content-between flex-column pt-4 h-100">
                                        <!--begin::Container-->
                                        <div class="pb-5">
                                            <!--begin::Header-->
                                            <div class="d-flex flex-column flex-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-120 symbol-circle symbol-success overflow-hidden">
                                                    <span class="symbol-label">
                                                        <img :src="`${employeeSalary.photo}`" class="h-75 align-self-end" alt="">
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Username-->
                                                <a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
                                                   {{ employeeSalary.name }}
                                                </a>
                                                <!--end::Username-->
                                                <!--begin::Info-->
                                                <div class="font-weight-bold text-dark-50 font-size-sm pb-6">{{ employeeSalary.email }}</div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="pt-1">
                                                <!--begin::Text-->
                                                <p class="text-dark-75 font-weight-nirmal font-size-lg m-0 pb-7">
                                                    This Employee Salary History...
                                                </p>
                                                <!--end::Text-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center pb-9">
                                                    <table class="table table-bordered">

                                                        <thead>
                                                            <th>Month Name</th>
                                                            <th>Payment Date</th>
                                                            <th>Payment Amount</th>
                                                            <th>Payment Year</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(salary , i) in employeeSalary.salaries">
                                                                <td>{{ salary.month }}</td>
                                                                <td>{{ salary.date }}</td>
                                                                <td>{{ salary.amount }}</td>
                                                                <td>{{ salary.year }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--eng::Container-->
                                        <!--begin::Footer-->
                                        <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1" data-toggle="tooltip" title="" data-placement="right" data-original-title="Chat Example">
                                            <button class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14" data-toggle="modal" data-target="#kt_chat_modal">Write a Message</button>
                                        </div>
                                        <!--end::Footer-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Nav Panel Widget 2-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">All Salary
                        <span class="d-block text-muted pt-2 font-size-sm">all expense details is here</span></h3>
                </div>
                <div class="card-toolbar">
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Employees</h2>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable" id="">
                            <thead>
                            <tr>
                                <th>Record ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(emp, i) in employees">
                                <td>{{ i+1 }}</td>
                                <td>{{ emp.name }}</td>
                                <td><img :src="`${emp.photo}`" class="rounded-circle" style="width: 50px; height: 50px;" alt=""></td>
                                <td>
                                    <button class="btn btn-default" @click="empSalary(emp.id)">Show Me</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Edit",
    data(){
        return{
            salaries:{},
            employees:{},
            employeeSalary:{},
        }
    },
    methods: {
        updateExpense(){
            let id = this.$route.params.id;
            axios.patch('/api/expense/'+id, this.from)
            .then( res => {
                this.from= '';
                this.errors = '';
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                })
                this.$router.push({name:'ManageExpense'});
            })
            .catch(err => {
                this.errors = err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        },
        empSalary(id){
            axios.get('/api/employee-salary/'+id)
            .then( res => {
                $('#exampleModal').modal('show');
                this.employeeSalary = res.data;
            })
            .catch(err => {
                this.errors = err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        }
    },

    created() {
        axios.get('/api/employee')
        .then(res => {
            this.employees = res.data;
        })
        .catch(err => {
            console.log(err.response.data)
        })
    }
}
</script>

<style scoped>

</style>
