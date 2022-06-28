
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Dashboard
                <Link class="float-right" :href="route('users.create')"
                v-if="$page.props.permission.users.viewAny"
                >
                    <JetButton>Create</JetButton>
                </Link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="my-2 overflow-x-auto sm:-mx-6 lg:mx-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Surname
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                           <span class="sr-white">Edit</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="user in users" :key="user.id">
                                            <td class="text-center px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img :src="user.profile_photo_url" alt="" class="h-10 w-10 rounded-full">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ user.name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ user.email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ user.surname }}
                                                </div>
                                            </td>
                                            <td class="text-center px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-800">
                                                    Active
                                                </span>
                                            </td>
                                            <td class="text-center px-6 py-4 whitespace-nowrap">
                                                {{ user.role}}
                                            </td>
                                            <td class="text-center px-6 py-4 whitespace-nowrap">
                                                <Link
                                                    :href="route('users.show', user.id )"
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                    v-if="user.can.view"
                                                >

                                                    Show
                                                </Link>
                                                <Link
                                                    :href="route('users.edit', user.id )"
                                                    class="ml-2 text-indigo-600 hover:text-indigo-900"
                                                    v-if="user.can.update"
                                                >
                                                    Edit
                                                </Link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Jetstream/Button.vue';
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
export default {
    name: "Dashboard",
    components: {
        AppLayout,
        JetButton,
        Link,
        computed
    },
    props: ['users']
}
</script>

<style scoped>

</style>
