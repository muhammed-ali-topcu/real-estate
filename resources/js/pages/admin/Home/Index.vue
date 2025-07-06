<script setup lang="ts">
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../layouts/AdminLayout.vue';
import { trans } from 'laravel-vue-i18n';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: trans('Dashboard'),
        href: route('admin.dashboard'),
    },
];
</script>

<template>
    <Head :title="trans('Dashboard')" />

    <AdminLayout :breadcrumbs="breadcrumbs">
        
    </AdminLayout>
</template>
