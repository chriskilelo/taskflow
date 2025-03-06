<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { nextTick, ref, computed } from "vue";
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

// Props from parent component or page
const { props } = usePage();
const notification = props.notification;
const notificationTypes = props.notification_types;
const notificationStatuses = props.notification_statuses;

const confirmingNotificationDeletion = ref(false);
// Holds the selected status value
const selectedStatus = ref("");
//
const page = usePage();

const usersEmail = computed(() => {
    return page.props.auth?.user?.email || "No email found";
});

const userID = computed(() => {
    return page.props.auth?.user?.id || "No user ID found";
});

// Initialize the form with existing data
const form = useForm({
    user_id: userID.value,
    subject: notification.subject || "",
    message: notification.message || "",
    type: notification.type || "",
    status: notification.status || "",
    send_attempts: notification.send_attempts || "",
    scheduled_at: notification.scheduled_at || "",
    sent_at: notification.sent_at || "",
    is_active: notification.is_active || "",
    is_sent: notification.is_sent || "",
    has_error: notification.has_error || "",
    failed_at: notification.failed_at || "",
    error_message: notification.error_message || "",
    created_by: usersEmail.value,
});

// Function for submitting the form to the controller for updating the record
const update = () => {
    form.put(`/notifications/${notification.id}`);
};

const confirmNotificationDeletion = () => {
    confirmingNotificationDeletion.value = true;
};

const deleteNotification = () => {
    form.delete(`/notifications/${notification.id}`, {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingNotificationDeletion.value = false;
    form.reset();
};
</script>

<template>
    <Head title="Edit Notification" />
    <ConsoleLayout>
        <div class="px-20 pt-14 h-screen bg-gray-100 dark:bg-gray-800">
            <div class="flex pb-7">
                <Link
                    href="/notifications"
                    class="font-semibold text-4xl text-purplium-500 dark:text-greenium-600 dark:hover:text-greenium-500 leading-tight"
                >
                    Notifications&nbsp;
                </Link>
                <span
                    class="text-gray-700 font-semibold text-4xl leading-tight dark:text-slate-300"
                    >/&nbsp;Edit</span
                >
            </div>
            <div class="max-w-3xl rounded-md">
                <form @submit.prevent="update">
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full">
                            <InputLabel for="subject" value="Subject" />
                            <TextInput
                                id="subject"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.subject"
                                autocomplete="subject"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.subject"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full">
                            <label
                                for="message"
                                class="mt-1 block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Notification Message
                            </label>
                            <TextareaInput
                                v-model="form.message"
                                id="message"
                                name="message"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.message"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="type" value="Notification Types" />
                            <CustomDropdown v-model="form.type">
                                <option
                                    v-for="type in notificationTypes"
                                    :key="type"
                                    :value="type"
                                >
                                    {{ type }}
                                </option>
                            </CustomDropdown>
                            <InputError
                                class="mt-2"
                                :message="form.errors.type"
                            />
                        </div>
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel
                                for="status"
                                value="Notification Status"
                            />
                            <CustomDropdown v-model="form.status">
                                <option
                                    v-for="status in notificationStatuses"
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
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel
                                for="scheduled_at"
                                value="Scheduled At"
                            />
                            <TextInput
                                id="scheduled_at"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.scheduled_at"
                                autocomplete="scheduled_at"
                                disabled
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.scheduled_at"
                            />
                        </div>
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel
                                for="send_attempts"
                                value="Send Attempts"
                            />
                            <TextInput
                                id="send_attempts"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.send_attempts"
                                autocomplete="send_attempts"
                                disabled
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.send_attempts"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="is_sent" value="Is Sent?" />
                            <TextInput
                                id="is_sent"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.is_sent"
                                autocomplete="is_sent"
                                disabled
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.is_sent"
                            />
                        </div>
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="sent_at" value="Sent At" />
                            <TextInput
                                id="sent_at"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.sent_at"
                                autocomplete="sent_at"
                                disabled
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.sent_at"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="has_error" value="Has Error?" />
                            <TextInput
                                id="has_error"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.has_error"
                                autocomplete="has_error"
                                disabled
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.has_error"
                            />
                        </div>
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="failed_at" value="Failed At" />
                            <TextInput
                                id="failed_at"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.failed_at"
                                autocomplete="failed_at"
                                disabled
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.failed_at"
                            />
                        </div>
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
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel
                                for="user_id"
                                value="User ID"
                                class="hidden"
                            />
                            <TextInput
                                id="user_id"
                                type="text"
                                class="mt-1 w-full hidden"
                                v-model="form.user_id"
                                autocomplete="user_id"
                                :disabled="true"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.user_id"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full">
                            <label
                                for="error_message"
                                class="mt-1 block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Error Message
                            </label>
                            <TextareaInput
                                v-model="form.error_message"
                                id="error_message"
                                name="error_message"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.error_message"
                            />
                        </div>
                    </div>

                    <div class="py-2 w-full md:w-1/2">
                        <label class="flex items-center">
                            <Checkbox
                                name="is_active"
                                v-model:checked="form.is_active"
                            />
                            <span
                                class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                                >Active?</span
                            >
                        </label>
                        <InputError
                            class="mt-2"
                            :message="form.errors.is_active"
                        />
                    </div>
                    <div class="flex items-center gap-4 justify-between py-10">
                        <DangerButton
                            @click.prevent="confirmNotificationDeletion"
                        >
                            Delete Notification
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
                            :show="confirmingNotificationDeletion"
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
                                        @click="deleteNotification"
                                    >
                                        Delete Notification
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
