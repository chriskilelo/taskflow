<template>
  <div class="flex items-center">
    <div class="flex w-full rounded shadow">
      <dropdown :auto-close="false" class="focus:z-10 px-4 dark:bg-gray-900 hover:bg-greenium-100 border-r border-r:text-red-500 focus:border-gray-300 rounded-l focus:ring md:px-6" placement="bottom-start">
        <template #default>
          <div class="flex items-baseline">
            <span class="hidden font-bold text-purplium-500 dark:text-greenium-400 md:inline">Filter</span>
            <svg class="w-2 h-2 fill-gray-600 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
              <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
            </svg>
          </div>
        </template>
        <template #dropdown>
          <div class="mt-2 px-4 py-6 w-screen bg-white rounded shadow-xl" :style="{ maxWidth: `${maxWidth}px` }">
            <slot />
          </div>
        </template>
      </dropdown>
              <!-- class=" focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" -->
      <input class="relative border-gray-300 shadow-sm px-6 py-3 w-full rounded-r focus:shadow-outline text-purplium-700 dark:border-gray-700 dark:bg-gray-900 dark:text-greenium-300 dark:focus:border-greenium-400 dark:focus:ring-greenium-400" autocomplete="off" type="text" name="search" placeholder="Search…" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
    </div>
    <button class="ml-3 text-sm font-bold text-purplium-500 dark:text-greenium-600 hover:text-purplium-700 dark:hover:text-greenium-400" type="button" @click="$emit('reset')">Reset</button>
  </div>
</template>

<script>
import Dropdown from '@/Components/Dropdown.vue';

export default {
  components: {
    Dropdown,
  },
  props: {
    modelValue: String,
    maxWidth: {
      type: Number,
      default: 300,
    },
  },
  emits: ['update:modelValue', 'reset'],
}
</script>
