<template>
  <div>
    <v-select
      :options="flattenedCategories"
      v-model="selectedCategoryIds"
      @update:modelValue="changeData"
      class="form-control"
      label="fullName"
      :selected="modelValue"
      placeholder="Select Categories..."
      multiple
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, defineProps, defineEmits } from 'vue';
import useAxios from '@/composables/useApi.js';

const props = defineProps({
  modelValue: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits(['update:modelValue']);
const selectedCategoryIds = ref(props.modelValue);

const changeData = (event) => {
  emit('update:modelValue', event);
};

const categories = ref([]);
const { loading, error, sendRequest } = useAxios();

onMounted(async () => {
  let responseData;
  responseData = await sendRequest({
    method: 'get',
    url: '/api/category',
  });
  categories.value = responseData;
});

const flattenedCategories = computed(() => {
  return flattenCategories(categories.value);
});

function flattenCategories(categories, level = 0, parentPrefix = "") {
  return categories?.reduce((result, category) => {
    const prefix = level > 0 ? `${parentPrefix}-` : parentPrefix;
    const fullName = `${prefix} ${category.name}`;
    const flattenedCategory = { ...category, fullName };
    result.push(flattenedCategory);

    if (category.children_recursive && category.children_recursive.length > 0) {
      result.push(...flattenCategories(category.children_recursive, level + 1, prefix));
    }
    return result;
  }, []);
}
</script>
