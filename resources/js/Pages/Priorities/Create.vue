<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import ConsoleLayout from "@/Layouts/ConsoleLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import TextareaInput from "@/Components/TextareaInput.vue";
import { computed } from "vue";

const page = usePage();

const usersEmail = computed(() => {
    return page.props.auth?.user?.email || "No email found";
});

const form = useForm({
    level: "",
    description: "",
    created_by: usersEmail.value,
    is_active: "",
});

const store = () => {
    form.post(route("priorities.store"), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Create Priority" />
    <ConsoleLayout>
        <div class="px-20 pt-14 h-screen bg-gray-100 dark:bg-gray-800">
            <div class="flex pb-7">
                <Link
                    href="/priorities"
                    class="font-semibold text-4xl text-purplium-500 dark:text-greenium-600 dark:hover:text-greenium-500 leading-tight"
                >
                    <span class="hidden md:inline">All</span>
                    Priorities&nbsp;
                </Link>
                <span
                    class="text-gray-700 font-semibold text-4xl leading-tight dark:text-slate-300"
                    >/&nbsp;Create</span
                >
            </div>
            <div class="max-w-3xl rounded-md">
                <form @submit.prevent="store">
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="level" value="Priority Level" />
                            <TextInput
                                id="level"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.level"
                                autocomplete="level"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.level"
                            />
                        </div>
                        <div class="py-2 w-full md:w-1/2">
                            <InputLabel for="created_by" value="Created By" class="hidden" />
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
                    <div class="flex flex-col md:flex-row md:gap-x-4">
                        <div class="py-2 w-full">
                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Priority Description
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
                    <div class="flex items-center gap-4 justify-end py-10">
                        <PrimaryButton :disabled="form.processing">
                            Save
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
                                Details Saved.
                            </p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>
    </ConsoleLayout>
</template>