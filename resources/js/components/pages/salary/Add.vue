<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Add New Salary</h3>
            </div>
            <!--begin::Form-->
            <form class="form" @submit.prevent="saveSalary()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Select Employee</label>
                        <select class="form-control form-control-solid"  v-model="from.emp_id">
                            <option value="" selected disabled="true">~~Select Brand Id~~</option>
                            <option v-for="(emp, i) in employees" :value="emp.id">{{ emp.name }}</option>
                        </select>
                        <small class="text-danger" v-if="errors.emp_id">{{ errors.emp_id[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" class="form-control form-control-solid" v-model="from.amount" rows="3"/>
                        <small class="text-danger" v-if="errors.amount">{{ errors.amount[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label for="">Select Month</label>
                        <select class="form-control form-control-solid"  v-model="from.month">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                        <small class="text-danger" v-if="errors.month">{{ errors.month[0]}}</small>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
            <!--end::Form-->
        </div>


    </div>
</template>

<script>
export default {
    name: "Add",
    data(){
        return{
            from: {
                emp_id: '',
                amount: '',
                month: '',
            },
            errors:{},
            employees:{},
        }
    },
    methods: {
        saveSalary(){
            axios.post('api/salary', this.from)
            .then( res => {
                this.from= '';
                this.errors = '';
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                })
            })
            .catch(err => {
                this.errors = err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.data.message
                });
            })
        },
        allEmployees(){
            axios.get('api/employee')
                .then( res => {
                    this.employees = res.data
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
        this.allEmployees();
    }
}
</script>

<style scoped>

</style>
