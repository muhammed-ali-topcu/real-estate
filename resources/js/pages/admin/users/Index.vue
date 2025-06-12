<script>
import Pagination from '@/components/Pagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { wTrans } from 'laravel-vue-i18n';

export default {
    components: {
        Pagination,
        AppLayout,
        Link,
    },

    props: {
        users: {
            type: Object,
            required: true,
        },
        filters: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            search: this.filters.search || '',
            breadcrumbs: [
                {
                    title: wTrans('Users'),
                    href: this.route('admin.users.index'),
                },
            ],
        };
    },

    watch: {
        search(value) {
            router.get(this.route('admin.users.index'), { search: value }, { preserveState: true, replace: true });
        },
    },
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold">{{ $t('Users') }}</h1>
            <Link :href="route('admin.users.create')" class="btn-primary"> Create user</Link>
        </div>
        <div class="my-4 grid grid-cols-3">
            <input type="text" :placeholder="$t('Search...')" class="rounded border p-2" v-model="search" />
        </div>

        <table class="table-bordered table-striped table w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>{{ $t('Roles') }}</th>
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
                    <td>{{ user.roles }}</td>
                    <td>{{ user.created_at }}</td>
                    <td>
                        <Link
                            v-if="$page.props.can.edit_users"
                            :href="route('admin.users.edit', user.id)"
                            class="m-2 rounded hover:bg-amber-100"
                            as="button"
                        >
                            Edit
                        </Link>

                        <Link
                            v-if="$page.props.can.delete_users"
                            :href="route('admin.users.destroy', user.id)"
                            method="delete"
                            as="button"
                            class="rounded bg-red-500 p-2 font-bold text-white hover:bg-red-700"
                        >
                            Delete
                        </Link>
                        <Link
                            v-if="user.can_be_impersonated && $page.props.can.impersonate_users"
                            :href="route('impersonate', user.id)"
                            class="m-2 rounded hover:bg-amber-100"
                            as="button"
                        >
                            Impersonate
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :links="users.links" />
    </AppLayout>
</template>
