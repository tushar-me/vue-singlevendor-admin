<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Add New Expense</h3>
            </div>
            <!--begin::Form-->
            <form class="form" @submit.prevent="saveExpense()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Expense Details</label>
                        <textarea id="exampleTextarea" class="form-control form-control-solid" v-model="from.details" rows="3"></textarea>
                        <small class="text-danger" v-if="errors.details">{{ errors.details[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" class="form-control form-control-solid" v-model="from.amount" rows="3"/>
                    </div>

                    <div class="form-group">
                        <label for="date">Expence Date</label>
                        <input type="date" id="date" class="form-control form-control-solid" v-model="from.date" rows="3"/>
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
                details: '',
                amount: '',
                date: '',
            },
            errors:{},
        }
    },
    methods: {
        saveExpense(){
            axios.post('api/expense', this.from)
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
                    title: err.response.statusText
                })
            })
        }
    },
    created() {
        if (!User.loggedIn()){
            this.$router.push({name:"Login"})
        }
    }
}
</script>

<style scoped>

</style>
