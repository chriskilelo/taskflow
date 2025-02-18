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
import CustomDropdown from "@/Components/CustomDropdown.vue";

const confirmingProjectDeletion = ref(false);
// Get the existing data from the page props
const { props } = usePage();
const project = props.project;
const statusTypes = props.statusTypes;

// Initialize the form with existing data
const form = useForm({
    name: project.name || "",
    description: project.description || "",
    status: project.status || "",
    is_active: Boolean(project.is_active),
    created_by: project.created_by || "",
    deleted_at: project.deleted_at || "",
});

// Holds the selected status value
const selectedStatus = ref("");

// Function for submitting the form to the controller for updating the record
const update = () => {
    form.put(`/projects/${project.id}`);
};

const confirmProjectDeletion = () => {
    confirmingProjectDeletion.value = true;
};

const deleteProject = () => {
    form.delete(`/projects/${project.id}`, {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingProjectDeletion.value = false;
    form.reset();
};
</script>

<template>
    <Head title="Edit Status" />
    <ConsoleLayout>
        <div class="px-20 pt-14 h-screen bg-gray-100 dark:bg-gray-800">
            <div class="flex pb-7">
                <Link
                    href="/projects"
                    class="font-semibold text-4xl text-purplium-500 dark:text-greenium-600 dark:hover:text-greenium-500 leading-tight"
                >
                    Projects&nbsp;
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
                            <InputLabel for="name" value="Project Name" />
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                autocomplete="name"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="status" value="Project Status" />
                            <CustomDropdown v-model="form.status">
                                <option
                                    v-for="status in statusTypes"
                                    :key="status"
                                    :value="status"
                                >
                                    {{ status }}
                                </option>
                            </CustomDropdown>
                            <InputError
                                class="mt-2"
                                :message="form.errors.status"
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
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel
                                for="created_by"
                                value="Created By"
                                class="hidden"
                            />
                            <TextInput
                                id="created_by"
                                type="text"
                                class="mt-1 w-full hidden"
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
                        <DangerButton @click.prevent="confirmProjectDeletion">
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
                            :show="confirmingProjectDeletion"
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
                                        @click="deleteProject"
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
