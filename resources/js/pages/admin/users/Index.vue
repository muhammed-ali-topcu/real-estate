<script setup lang="ts">
import Pagination from '@/components/Pagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { wTrans } from 'laravel-vue-i18n';
import { ref, watch } from 'vue';

const props = defineProps<{
    users: Object;
    filters: Object;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: wTrans('Users'),
        href: route('admin.users.index'),
    },
];

const search = ref();
search.value = props.filters.search;

watch(search, (value) => {
    router.get(route('admin.users.index'), { search: value }, { preserveState: true, replace: true });
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold">{{ $t('Users') }}</h1>
            <Link :href="route('admin.users.create')" class="btn-primary"> Create user</Link>
        </div>
        <div class="my-4 flex items-center justify-between">
            <input type="text" :placeholder="$t('Search...')" class="rounded border p-2" v-model="search" />
        </div>
        <table class="table-bordered table-striped table w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>{{ $t('Created at') }}</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.status }}</td>
                    <td>{{ user.created_at }}</td>
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
    </AppLayout>
</template>
