<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Pagination from '@/components/Pagination.vue';

defineProps<{
    users: Object;
}>();
</script>

<template>
    <h1>{{ $t('Users') }}</h1>

    <table class="table-bordered table-striped table w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users.data" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.status }}</td>
                <td>
                    <Link :href="route('admin.users.edit', user.id)" class="m-2 rounded hover:bg-amber-100" as="button"> Edit </Link>
                    <Link
                        :href="route('admin.users.destroy', user.id)"
                        method="delete"
                        as="button"
                        class="rounded bg-red-500 p-2 font-bold text-white hover:bg-red-700"
                    >
                        Delete
                    </Link>
                </td>
            </tr>
        </tbody>

    </table>
<Pagination :links="users.links" />

</template>
