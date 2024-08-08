<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">VUe Multipole file upload Component</div>

                    <div class="panel-body">
                        <legend>Upload form</legend>

                        <div class="form-group">
                            <label>Upload Files</label>
                            <input id="upload-file" type="file" multiple class="form-control" @change="fieldChange">
                        </div>
                        <button class="btn btn-primary" @click="uploadFile">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 mt-5" >
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">VUe single file upload Component</div>

                    <div class="panel-body">
                        <legend>Upload form</legend>

                        <div class="form-group">
                            <label>Upload Files</label>
                            <input id="single-file" type="file" class="form-control" @change="singleFile">
                        </div>
                        <button class="btn btn-primary" @click="uploadSingleFile">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            attachments:[],
            form: new FormData,
        }
    },
    methods:{
        fieldChange(e){
            let selectedFiles=e.target.files;
            if(!selectedFiles.length){
                return false;
            }
            for(let i=0;i<selectedFiles.length;i++){
                this.attachments.push(selectedFiles[i]);
            }
            console.log(this.attachments);
        },
        
        uploadFile(){

            for(let i=0; i<this.attachments.length;i++){
                this.form.append('pics[]',this.attachments[i]);
            }

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };

            document.getElementById('upload-file').value=[];

            axios.post('api/upload',this.form,config).then(response=>{
                //success
                console.log(response);

            })
                .catch(response=>{
                    //error
                });
        },


        singleFile(e){
            this.form.append('image',e.target.files[0]);
        },
        uploadSingleFile(){

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };

            axios.post('api/upload-single',this.form, config).then(response=>{
                console.log(response);
            })
            .catch(response=>{
                console.log(response.error.data)
            });
        }

    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
