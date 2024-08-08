
<template>
    <v-select :options="categories"
              v-model="props.modelValue"
              :multiple="props.multiple"
              @update:modelValue="changeData"
              class="form-control h-auto"
              :selected="props.modelValue"
              :reduce="cat => cat.id"
              label="name"
              placeholder="Select Category..."/>

    <!--    <select v-model="selectedCategory">-->
    <!--        <option v-for="category in flattenedCategories" :key="category.id" :value="category.id">-->
    <!--            {{ getCategoryPrefix(category.level) }} {{ category.name }}-->
    <!--        </option>-->
    <!--    </select>-->
</template>

<script setup>
import { ref, onMounted } from 'vue';
import useAxios from '@/composables/useApi.js';

const props = defineProps({
    modelValue:Number|Array,
    multiple:{
        type:Boolean,
        default:false
    }
})

const emit = defineEmits(['update:modelValue'])
const changeData = (event) =>{
    console.log(event)
    emit('update:modelValue', event)
}

const categories = ref([]);

const { loading, error, sendRequest } = useAxios();
onMounted(async () => {
    let responseData;
    responseData = await sendRequest({
        method: 'get',
        url: '/api/category?recursive',
    });
    categories.value = responseData;
});

</script>
