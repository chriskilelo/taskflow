<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <input
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="rounded border-gray-300 text-purplium-600 dark:text-greenium-400  shadow-sm focus:ring-purplium-600 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-greenium-400 dark:focus:ring-offset-gray-800"
    />
</template>
