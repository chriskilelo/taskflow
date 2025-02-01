<script setup>
import { onMounted, ref } from "vue";

const model = defineModel({
    type: String,
    required: true,
});

const textarea = ref(null);

onMounted(() => {
    if (textarea.value.hasAttribute("autofocus")) {
        textarea.value.focus();
    }
});

defineExpose({ focus: () => textarea.value.focus() });
</script>

<template>
    <textarea
        class="w-full border-gray-300 text-purplium-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purplium-600 dark:focus:border-greenium-400 focus:ring-purplium-600 dark:focus:ring-greenium-400 rounded-md shadow-sm"
        v-model="model"
        ref="textarea"
        rows="4"
    ></textarea>
</template>
