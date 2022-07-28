<template>
    <AppLayout title="Dashboard">
        <div class="py-12 ">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <JetFormSection @submitted="updateProfileInformation">
                        <template #form>
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4 ">
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
                                <div v-show="photoPreview" class="mt-2"><span
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
                                />
                                <JetInputError :message="form.errors.name" class="mt-2" />
                            </div>
                            <!-- Gender  -->
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
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
const props = defineProps({
    user: Object,
});
const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    surname: props.user.surname,
    gender: props.user.gender,
    photo: null,
});
const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);
const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }
    form.post(route('users.update', props.user.id), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};
const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};
const selectNewPhoto = () => {
    photoInput.value.click();
};
const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];
    if (! photo) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };
    reader.readAsDataURL(photo);
};
const deletePhoto = () => {
    Inertia.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};
const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>




