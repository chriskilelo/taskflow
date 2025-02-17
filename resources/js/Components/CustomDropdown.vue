<script setup>
import { computed } from 'vue';

// Emit the selected value to the parent
const emit = defineEmits(['update:modelValue']);

// Accept only modelValue as a prop for flexibility
const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
});

// Create a local proxy to use v-model
const proxySelected = computed({
    get() {
        return props.modelValue;
    },
    set(val) {
        emit('update:modelValue', val);
    }
});
</script>

<template>
    <select
        v-model="proxySelected"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-purplium-600 focus:border-purplium-600 focus:ring-purplium-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-greenium-400 dark:focus:ring-greenium-400"
    >
        <option value="" disabled>Select an Option</option>
        <slot></slot>
    </select>
</template>
