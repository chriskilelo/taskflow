<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { onMounted, reactive, watch } from "vue";
import ConsoleLayout from "@/Layouts/ConsoleLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchFilter from "@/Components/SearchFilter.vue";
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import mapValues from "lodash/mapValues";

// Define the incoming props, including 'filters'
const props = defineProps({
    filters: Object,
    statuses: Object,
    links: Object,
});

// Reactive form data
const form = reactive({
    search: props.filters.search || "",
    trashed: props.filters.trashed || null,
});

// Watch for changes in form and trigger throttled Inertia requests
const throttledHandler = throttle(() => {
    Inertia.get("/statuses", pickBy(form), { preserveState: true });
}, 150);

watch(() => form, throttledHandler, { deep: true });

// Reset function
const reset = () => {
    Object.assign(
        form,
        mapValues(form, () => null)
    );
};
</script>

<template>
    <Head title="List Statuses" />
    <ConsoleLayout>
        <div class="bg-gray-200 dark:bg-gray-800">
            <div class="pt-14 pr-8 flex justify-between">
                <span
                    class="pl-8 font-semibold whitespace-nowrap text-4xl text-purplium-500 dark:text-greenium-400 leading-tight"
                >
                    <span class="hidden md:inline">All</span>
                    <span>&nbsp;Statuses</span>
                </span>
            </div>
            <div class="pt-7 pb-7 pl-4 pr-8 flex justify-between">
                <SearchFilter
                    v-model="form.search"
                    class="mr-4 w-full max-w-md"
                    @reset="reset"
                >
                    <label class="block text-gray-700">Trashed:</label>
                    <select
                        v-model="form.trashed"
                        class="form-select mt-1 w-full"
                    >
                        <option :value="null" />
                        <option value="with">With Trashed</option>
                        <option value="only">Only Trashed</option>
                    </select>
                </SearchFilter>
                <Link
                    class="bg-purplium-600 hover:bg-purplium-500 dark:bg-greenium-600 dark:hover:bg-greenium-800 px-6 py-3 text-white font-semibold rounded"
                    href="statuses/create"
                >
                    <span>Create</span>
                    <span class="hidden md:inline">&nbsp;Status</span>
                </Link>
            </div>
            <div
                class="relative h-screen overflow-x-auto shadow-md px-4 sm:rounded-lg"
            >
                <table
                    class="w-full whitespace-nowrap text-base text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded"
                >
                    <thead
                        class="text-base text-white uppercase bg-purplium-600 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="status in statuses.data"
                            :key="status.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 hover:font-medium hover:text-purplium-700 hover:dark:text-greenium-400"
                        >
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center"
                                    :href="`/statuses/${status.id}/edit`"
                                >
                                    {{ status.status }}
                                </Link>
                            </td>
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center"
                                    :href="`/statuses/${status.id}/edit`"
                                >
                                    {{ status.description }}
                                </Link>
                            </td>
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center"
                                    :href="`/statuses/${status.id}/edit`"
                                >
                                    <div
                                        class="flex items-center"
                                        v-if="status.is_active == 1"
                                    >
                                        <div
                                            class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"
                                        ></div>
                                        Enabled
                                    </div>
                                    <div class="flex items-center" v-else>
                                        <div
                                            class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"
                                        ></div>
                                        Disabled
                                    </div>
                                </Link>
                            </td>
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center font-semibold text-blue-600 dark:text-blue-500 hover:text-purplium-700 hover:dark:text-greenium-400"
                                    :href="`/statuses/${status.id}/edit`"
                                >
                                    {{ status.created_at }}
                                </Link>
                            </td>
                        </tr>
                        <tr v-if="statuses.data.length === 0">
                            <td
                                colspan="5"
                                hover:hover:text-yellow-500
                                class="px-6 py-4 bg-white border-b border-x dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 hover:font-medium text-gray-500 dark:text-gray-400 hover:text-purplium-700 hover:dark:text-greenium-400"
                            >
                                No Status Records Found
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="pagination-section">
                    <Pagination
                        class="-space-x-px rtl:space-x-reverse text-base h-8 mt-6"
                        :links="statuses.links"
                    ></Pagination>
                </div>
            </div>
        </div>
    </ConsoleLayout>
</template>

