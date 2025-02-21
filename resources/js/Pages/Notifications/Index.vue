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
    notifications: Object,
    links: Object,
});

// Reactive form data
const form = reactive({
    search: props.filters.search || "",
    trashed: props.filters.trashed || null,
});

// Watch for changes in form and trigger throttled Inertia requests
const throttledHandler = throttle(() => {
    Inertia.get("/notifications", pickBy(form), { preserveState: true });
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
    <Head title="List Notifications" />
    <ConsoleLayout>
        <div class="bg-gray-200 dark:bg-gray-800">
            <div class="pt-14 pr-8 flex justify-between">
                <span
                    class="pl-8 font-semibold whitespace-nowrap text-4xl text-purplium-500 dark:text-greenium-400 leading-tight"
                >
                    <span class="hidden md:inline">All</span>
                    <span>&nbsp;Notifications</span>
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
                    href="notifications/create"
                >
                    <span>Create</span>
                    <span class="hidden md:inline">&nbsp;Notification</span>
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
                            <th scope="col" class="px-6 py-3">Subject</th>
                            <th scope="col" class="px-6 py-3">Message</th>
                            <th scope="col" class="px-6 py-3">Type</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Sent?</th>
                            <th scope="col" class="px-6 py-3">Has Error?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="notification in notifications.data"
                            :key="notification.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 hover:font-medium hover:text-purplium-700 hover:dark:text-greenium-400"
                        >
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center"
                                    :href="`/notifications/${notification.id}/edit`"
                                >
                                    {{ notification.subject }}
                                </Link>
                            </td>
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center"
                                    :href="`/notifications/${notification.id}/edit`"
                                >
                                    {{ notification.message }}
                                </Link>
                            </td>
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center"
                                    :href="`/notifications/${notification.id}/edit`"
                                >
                                    {{ notification.type }}
                                </Link>
                            </td>
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center"
                                    :href="`/notifications/${notification.id}/edit`"
                                >
                                    {{ notification.status }}
                                </Link>
                            </td>                            
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center"
                                    :href="`/notifications/${notification.id}/edit`"
                                >
                                    <div
                                        class="flex items-center"
                                        v-if="notification.is_sent == 1"
                                    >
                                        <div
                                            class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"
                                        ></div>
                                        SENT
                                    </div>
                                    <div class="flex items-center" v-else>
                                        <div
                                            class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"
                                        ></div>
                                        NOT SENT
                                    </div>
                                </Link>
                            </td>
                            <td class="px-6 py-4">
                                <Link
                                    class="flex items-center"
                                    :href="`/notifications/${notification.id}/edit`"
                                >
                                    <div
                                        class="flex items-center"
                                        v-if="notification.has_error == 1"
                                    >
                                        <div
                                            class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"
                                        ></div>
                                        HAS ERROR
                                    </div>
                                    <div class="flex items-center" v-else>
                                        <div
                                            class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"
                                        ></div>
                                        NO ERROR
                                    </div>
                                </Link>
                            </td>                            
                        </tr>
                        <tr v-if="notifications.data.length === 0">
                            <td
                                colspan="5"
                                hover:hover:text-yellow-500
                                class="px-6 py-4 bg-white border-b border-x dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 hover:font-medium text-gray-500 dark:text-gray-400 hover:text-purplium-700 hover:dark:text-greenium-400"
                            >
                                No Notification Records Found
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="pagination-section">
                    <Pagination
                        class="-space-x-px rtl:space-x-reverse text-base h-8 mt-6"
                        :links="notifications.links"
                    ></Pagination>
                </div>
            </div>
        </div>
    </ConsoleLayout>
</template>

