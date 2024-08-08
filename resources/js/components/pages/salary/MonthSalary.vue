<template>
    <div>
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
                <table class="table table-separate table-head-custom table-checkable">
                    <tr>
                        <th>Month</th>
                        <td>{{ salaries.month }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ salaries.date }}</td>
                    </tr>
                    <tr>
                        <th>Pay Date</th>
                        <td>{{ salaries.created_at | dateFormat }}</td>
                    </tr>
                </table>

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
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(emp, i) in salaries.employees">
                                   {{ emp  }}
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
        }
    },

    created() {
        let id = this.$route.params.id;
        axios.get('/api/month-salaries/'+id)
        .then(res => {
            console.log(res.data)
            this.salaries = res.data;
        })
        .catch(err => {
            console.log(err.response.data)
        })
    }
}
</script>

<style scoped>

</style>
