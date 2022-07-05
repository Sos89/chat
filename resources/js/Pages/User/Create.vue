<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Create new Chat Room
            </h2>
        </template>

        <div class="py-12 m-auto w-96 text-center">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-sky-100 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="col-span-6 sm:col-span-4">
                                <!--name-->
                            <JetLabel for="name" value="Name" class="m-3"/>
                            <JetInput
                                id="name"
                                v-model="name"
                                type="text"
                                autocomplete="name"
                            />
                                <!--description-->
                            <JetLabel for="description" value="Description" class="m-3"/>
                            <JetInput
                                id="description"
                                v-model="description"
                                type="text"
                            />
                        </div>
                    <JetButton class="m-3" @click="getRooms">
                        Save
                    </JetButton>
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
    data: function () {
      return {
          name: '',
          description: ''
      }
    },
    methods: {
        getRooms(){
            axios.post('/admin/save',
                {
                    name:this.name,
                    description:this.description
                })
                .catch( error => {
                    console.log( error.response )
                })
            this.name = ''
            this.description = ''
        },
    }
}


</script>

<style scoped>

</style>
