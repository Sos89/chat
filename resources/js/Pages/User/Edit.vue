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
                             Profile Photo
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                                <!-- Profile Photo File Input -->
                                <input
                                    ref="photoInput"
                                    type="file"
                                    class="hidden"
                                    @change="updatePhotoPreview"
                                >

                                <JetLabel for="photo" value="Photo" />

                                <!-- Current Profile Photo -->
                                <div v-show="! photoPreview" class="mt-2">
                                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                                </div>

                                <!-- New Profile Photo Preview -->
                                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                                </div>

                                <JetSecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                                    Select A New Photo
                                </JetSecondaryButton>

                                <JetSecondaryButton
                                    v-if="user.profile_photo_path"
                                    type="button"
                                    class="mt-2"
                                    @click.prevent="deletePhoto"
                                >
                                    Remove Photo
                                </JetSecondaryButton>

                                <JetInputError :message="form.errors.photo" class="mt-2" />
                            </div>

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
            photo: null,
        });
        const updateProfileInformation = () => {
            form.post(route('users.update', props.user.id), {
                preserveScroll: true,
            });
        };

        return  { form, updateProfileInformation }
    },

}
</script>

<style scoped>

</style>
