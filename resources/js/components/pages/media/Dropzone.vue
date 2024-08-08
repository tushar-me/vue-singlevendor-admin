<template>
    <div>
        <div class="dropzone mb-5" >
            <input
                type="file"
                id="dropzone-file"
                class="dropzone-file"
                ref="dropzoneFile"
                @change="handelFile"
                multiple >
            <div class="dropzone-wrapper" @dragenter.prevent="" @dragover.prevent="" @drop.prevent="handelFile">
                <label for="dropzone-file" class="dropzone-label">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10em" height="10em" fill="currentColor" class="dropzone-label-icon" viewBox="0 0 16 16">
                        <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z"/>
                    </svg>
                    <div class="dropzone-label-text">
                        <p>
                            <strong>Drun ang drops file for upload</strong>
                        </p>
                        <p>
                            <small class="secondary:text">Your files will be added automatically</small>
                        </p>
                        <button type="button" class="btn btn-outline-secondary">or Select Files</button>
                    </div>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="list">
                    <li class="card" v-for="(img, i) in images" :key="i">
                        <div class="card-body">
                            <h4 class="card-title">{{ img.name }}</h4>
                            <div class="flex justify-content-between secondary:text bottom:margin-2">
                                <div>
                                    File Size: {{ img.size }}
                                </div>
                                <div>
                                    File Type: {{ img.type }}
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col">
                <ul class="list">
                    <li  v-for="(img, i) in images" :key="i" class="top:card small(left:card bottom:margin-2">
                        <figure class="card-figure">
                            <img :src="img.path" :alt="img.name" class="card-image">
                        </figure>
                        <figcaption class="card-caption">{{ img.size }}</figcaption>
                        <div class="card-body">
                            <h4 class="card-title">{{ img.name }}</h4>
                            <div class="flex justify-content-between secondary:text bottom:margin-2">
                                <div>
                                    File Type: {{ img.type }}
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>





        <div class="custom-file-container mt-5" data-upload-id="myUniqueUploadId">
            <label
            >Upload File
                <a
                    href="javascript:void(0)"
                    class="custom-file-container__image-clear"
                    title="Clear Image"
                >&times;</a
                ></label
            >
            <label class="custom-file-container__custom-file">
                <input
                    type="file"
                    class="custom-file-container__custom-file__custom-file-input"
                    accept="*"
                    multiple
                    aria-label="Choose File"
                />
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span
                    class="custom-file-container__custom-file__custom-file-control"
                ></span>
            </label>
            <div class="custom-file-container__image-preview"></div>
        </div>



    </div>
</template>
<script>
import {
    getFileSize,
    getFileName,
    getFileType,
    getFileImage,
    loadFileImage,
    formatFileSize,
    humanFileSize
} from '../../../file-formate.js'

export default {
    name: "Dropzone",
    data(){
      return{
          images:[],
          photo:'',
      }
    },
    methods: {
        handelFile(event){
            let inputValue = event.target.files || event.dataTransfer.files || this.$refs.dropzoneFile.files;
            for (let i= 0 ; i< inputValue.length ; i++){
                this.images.push(inputValue[i]);
            }


            // let MainFile = this.images[0];

            let reader = new FileReader();
            reader.onload = event => {
                this.images.push({
                    'path': event.target.result
                });
            }
            for (let j=0; j<inputValue.length; j++){
                reader.readAsDataURL(inputValue[j]);
            }
        }
    },
    setup(){
        return{
            getFileSize,
            getFileName,
            getFileType,
            getFileImage,
            loadFileImage,
            formatFileSize,
            humanFileSize
        }
    }
}
</script>

<style scoped>
</style>
