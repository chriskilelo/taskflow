<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-md border-gray-300 shadow-sm text-purplium-600 focus:border-purplium-600 focus:ring-purplium-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-greenium-400 dark:focus:ring-greenium-400"
        v-model="model"
        ref="input"
    />
</template>
