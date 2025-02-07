<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";
import Modal from "@/Components/Modal.vue";
import ConsoleLayout from "@/Layouts/ConsoleLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import TextareaInput from "@/Components/TextareaInput.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const confirmingStatusDeletion = ref(false);
// Get the existing data from the page props
const { props } = usePage();
const status = props.status;

// Initialize the form with existing data
const form = useForm({
    status: status.status || "",
    description: status.description || "",
    created_by: status.created_by || "",
    deleted_at: status.deleted_at || "",
    is_active: Boolean(status.is_active),
});

// Function for submitting the form to the controller for updating the record
const update = () => {
    form.put(`/statuses/${status.id}`);
};

const confirmStatusDeletion = () => {
    confirmingStatusDeletion.value = true;
};

const deleteStatus = () => {
    form.delete(`/statuses/${status.id}`, {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingStatusDeletion.value = false;
    form.reset();
};
</script>

<template>
    <Head title="Edit Status" />
    <ConsoleLayout>
        <div class="px-20 pt-14 h-screen bg-gray-100 dark:bg-gray-800">
            <div class="flex pb-7">
                <Link
                    href="/statuses"
                    class="font-semibold text-4xl text-purplium-500 dark:text-greenium-600 dark:hover:text-greenium-500 leading-tight"
                >
                    Statuses&nbsp;
                </Link>
                <span
                    class="text-gray-700 font-semibold text-4xl leading-tight dark:text-slate-300"
                    >/&nbsp;Edit</span
                >
            </div>
            <div class="max-w-3xl rounded-md">
                <form @submit.prevent="update">
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="status" value="Status" />
                            <TextInput
                                id="status"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.status"
                                autocomplete="status"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.status"
                            />
                        </div>
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="created_by" class="hidden" value="Created By" />
                            <TextInput
                                id="created_by"
                                type="text"
                                class="mt-1 block w-full hidden"
                                v-model="form.created_by"
                                autocomplete="created_by"
                                :disabled="true"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.created_by"
                            />
                        </div>
                    </div>
                    <div class="py-2">
                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >
                            Description
                        </label>
                        <TextareaInput
                            v-model="form.description"
                            id="description"
                            name="description"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.description"
                        />
                    </div>
                    <div class="py-2">
                        <label class="flex justify-end items-center">
                            <Checkbox
                                name="is_active"
                                v-model:checked="form.is_active"
                            />
                            <span
                                class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                            >
                                Active?
                            </span>
                        </label>
                        <InputError
                            class="mt-2"
                            :message="form.errors.is_active"
                        />
                    </div>
                    <div class="flex items-center gap-4 justify-between py-10">
                        <DangerButton @click.prevent="confirmStatusDeletion">
                            Delete Status
                        </DangerButton>
                        <PrimaryButton :disabled="form.processing">
                            Save Changes
                        </PrimaryButton>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p
                                v-if="form.recentlySuccessful"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >
                                Details Updated.
                            </p>
                        </Transition>
                    </div>
                    <div>
                        <Modal
                            :show="confirmingStatusDeletion"
                            @close="closeModal"
                        >
                            <div class="py-10 flex items-center flex-col">
                                <div class="p-3">
                                    <h2
                                        class="text-lg font-medium text-gray-900 dark:text-gray-100"
                                    >
                                        Are you sure you want to delete this
                                        record?
                                    </h2>
                                </div>
                                <div class="mt-6 flex">
                                    <SecondaryButton @click="closeModal">
                                        Cancel
                                    </SecondaryButton>

                                    <DangerButton
                                        class="ms-3"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                        @click="deleteStatus"
                                    >
                                        Delete Status
                                    </DangerButton>
                                </div>
                            </div>
                        </Modal>
                    </div>
                </form>
            </div>
        </div>
    </ConsoleLayout>
</template> 
