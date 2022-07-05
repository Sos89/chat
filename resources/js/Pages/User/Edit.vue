<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <JetFormSection @submitted="updateProfileInformation">

                        <template #form>
                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <JetLabel for="name" value="Name" />
                                <JetInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="name"
                                />
                                <JetInputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <!-- Surname -->
                            <div class="col-span-6 sm:col-span-4">
                                <JetLabel for="surname" value="Surname" />
                                <JetInput
                                    id="surname"
                                    v-model="form.surname"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="surname"
                                />
                                <JetInputError :message="form.errors.surname" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <JetLabel for="gender" value="Select you gender" />
                                <select name="gender" id="gender" v-model="form.gender" class="mt-1 block w-full" required autofocus>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                        </template>

                        <template #actions>
                            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                                Saved.
                            </JetActionMessage>

                            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </JetButton>
                        </template>
                    </JetFormSection>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
export default {
    name: "Edit",
    components: {
        AppLayout,
        ref,
        Inertia,
        Link,
        useForm,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetActionMessage,
        JetSecondaryButton
    },
    props: ['user'],
    setup(props) {
        const form = useForm({
            _method: 'PUT',
            name: props.user.name,
            surname: props.user.surname,
            gender: props.user.gender,
            photo: null,
        });
        const updateProfileInformation = () => {
            form.post(route('users.update', props.user.id), {
                preserveScroll: true,
            });
        }
        return { form, updateProfileInformation }
    }
}
</script>

<style scoped>

</style>
