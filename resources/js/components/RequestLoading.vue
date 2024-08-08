<template>
    <div v-if="isShow" class="d-flex align-items-end gap-2">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">{{ text }}</span>
        </div>
        <p class="m-0">{{ text }}</p>
    </div>
</template>
<script setup>

defineProps({
    isShow:{
        type:Boolean,
        default:false
    },
    text:{
        type:String,
        default:'Saving...'
    }
})
</script>
