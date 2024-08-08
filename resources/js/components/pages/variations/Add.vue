<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <h3 class="card-title">Add Variations</h3>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addVariations">Add New</button>
                </div>
            </div>
        </div>
        <div class="row mt-5 ">
            <div class="col-md-3">
                <div class="card card-custom">
                    <div class="card-body">
                        <h2 class="card-title">Manage variations</h2>

                        <div class="">
                            <ul class="list-group">
                                <li @click="modifyItem" class="list-group-item d-flex align-items-center justify-content-between w-100 cursor-pointer" v-for="i in 10">
                                    <span>Variation Name</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/></svg>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-custom">
                    <div class="card-body">
                        <h2 class="card-title">Modify variations</h2>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="addVariations" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Variation
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="handelSubmit">
                            <div>
                                <label for="name">Variation Name</label>
                                <input type="text" id="name" v-model="from.name" placeholder="e.g size, weight, pack etc.">
                            </div>

                            <button class="btn btn-sm btn-primary">Save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "Add",
    data(){
        return{
            from: {
                name: '',
            },
            errors:{},
        }
    },
    methods:{
        saveProduct(){
            var fromData = new FormData;
            fromData.append('title', this.from.name)

            axios.post('api/product', fromData)
                .then( res => {
                    Toast.fire({
                        icon: 'success',
                        title: res.data.message
                    })
                    this.from= '';
                    this.errors = '';
                    this.from.images = null;


                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: err.response.statusText
                    })
                })
        },
    },
}
</script>

<style scoped>
.deleteImage{
    position: relative;
    top: -41px;
    left: -31px;
    width: 20px;
    height: 20px;
    background: #00000014;
    display: inline-block;
    color: #efcdcd;
    border-radius: 15px;
    border: none;
    padding: 2px 6px;
    transition: 0.3s all ease;
    cursor:pointer;
}
.deleteImage:hover{
    background: #000;
}


#noShow {
    display: none;
}

.inputFileButton{
    border: 1px solid #ccc;
    display: inline-block;
    padding: 9px 12px;
    cursor: pointer;
    margin-top: 19px;
}
</style>




