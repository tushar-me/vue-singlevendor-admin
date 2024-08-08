<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Edit Brand</h3>
            </div>
            <!--begin::Form-->
            <form class="form" @submit.prevent="updateCategory()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Brand Name</label>
                        <input type="text" class="form-control form-control-solid" v-model="from.title" placeholder="Enter employee name..."/>
                        <small class="text-danger" v-if="errors.title">{{ errors.title[0]}}</small>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label for="exampleTextarea">Category Description</label>-->
<!--                        <textarea id="exampleTextarea" class="form-control form-control-solid" v-model="from.description" rows="3"></textarea>-->
<!--                    </div>-->

                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control"  @change="uploadFile">
                    </div>
                    <img :src="from.photo?.startsWith('upload') ? '/storage/'+from.photo: from.photo" alt="" class="object-fit-contain" style="width: 180px;height: 120px;">
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
    name: "Edit",
    data(){
        return{
            from: {
                id:'',
                title: '',
                photo:'',
            },
            errors:{},
            file:'',
        }
    },
    methods: {
        uploadFile(event){
            let File = event.target.files[0];
            let reader = new FileReader();
            reader.onload = event => {
                this.from.photo = event.target.result
            }
            reader.readAsDataURL(File);
            this.file = File
        },
        updateCategory(){
            let id = this.$route.params.id;


            let formData = new FormData;
            formData.append('id', this.from.id);
            formData.append('image', this.file);
            formData.append('title', this.from.title)



            this.$axios.post('/api/brand/update/'+id, formData)
                .then( res => {
                    this.from= '';
                    this.errors = '';
                    Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                    this.$router.push({name:'ManageBrand'});
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
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

    created() {
        this.isLogined();
        let id = this.$route.params.id;
        this.$axios.get('/api/brand/'+id)
        .then(res => {
            this.from = res.data;
        })
        .catch(err => {
            console.log(err.response.data)
        })
    }
}
</script>

<style scoped>

</style>
