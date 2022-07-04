<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Create
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="col-span-6 sm:col-span-4">
<!--                            <JetFormSection @submitted="create">-->
                            <JetLabel for="name" value="Name" class="m-3"/>
                            <JetInput
                                id="name"
                                v-model="name"
                                type="text"
                                class="m-3 block w-1/3"
                                autocomplete="name"
                            />
                            <JetButton class="m-3">
                                Save
                            </JetButton>
<!--                            </JetFormSection>-->
                        </div>
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
    name: "Create",
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
   setup() {
       const create = () => {
           form.post(route('admin.create'), {
               preserveScroll: true,
           });
       }
       return { form, create }
    }
}


</script>

<style scoped>

</style>
