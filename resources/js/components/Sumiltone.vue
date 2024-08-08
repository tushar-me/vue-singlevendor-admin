<template>
    <SummernoteEditor v-model="myValue"/>
</template>
<script>
import SummernoteEditor from 'vue3-summernote-editor';
export default {
    components: {SummernoteEditor},
    data() {
        return {
            myValue: '',
            height: '30rem'
        }
    }
}
</script>

