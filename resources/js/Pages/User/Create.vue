<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Create new Chat Room
            </h2>
        </template>

        <div class="py-12 m-auto w-1/2 h-96 text-center">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-300 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="col-span-6 sm:col-span-4">
                        <Form>
                            {{ messages }}
                            <JetLabel for="name" value="Name" class="m-3"/>
                            <Field name="name" id="name" v-model="form.name" class="m-4 form-input" :rules="nameRequired" />
                            <div class="isInvalid">
                                <ErrorMessage name="name" class=""></ErrorMessage>
                            </div>
                            <JetLabel for="description" value="Description" class="m-3"/>
                            <Field name="description" id="description" v-model="form.description" class="m-4 form-input" :rules="descriptionRequired" />
                            <div class="isInvalid">
                                <ErrorMessage name="description" class="inline-block"/>
                            </div>
                            <JetButton class="m-4 inline-block" @click="getRooms">
                                Save
                            </JetButton>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetLabel from '@/Jetstream/Label.vue';
import { Field, Form, ErrorMessage } from 'vee-validate';
export default {
    name: "Create",
    components: {
        AppLayout,
        JetButton,
        JetLabel,
        Field, Form, ErrorMessage
    },
    data () {
      return {
         form: {
             name: '',
             description: '',
         },
          messages: '',
      }
    },
    methods: {
        nameRequired(value) {
            if (value && value.trim()) {
                return true;
            }
            return 'Name is required !';
        },
        descriptionRequired(value) {
            if (value && value.trim()) {
                return true;
            }
            return 'Description is required !';
        },
        getRooms(){
            axios.post('/admin/save', {
                name:this.form.name,
                description:this.form.description
            })
                .then(function (response) {
                        location.href = '/dashboard/admin';
                })
                .catch(function (error) {
                    this.messages = error.response.data
                });
            this.name = ''
            this.description = ''
        },
    },
}


</script>

<style scoped>
.isInvalid{
    color: red;
    font-family: "Apple Color Emoji";
    font-weight: 100;
}
</style>
