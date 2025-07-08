<script setup lang="ts">
import type { BreadcrumbItemType } from '@/types';
import FlashMessages from '@/components/FlashMessages.vue';
import AppShell from '@/components/AppShell.vue';
import AdminSidebar from '@/layouts/admin/AdminSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import AppContent from '@/components/AppContent.vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <AdminSidebar />
        <AppContent variant="sidebar">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" />
            <FlashMessages />
            <div class="container mx-auto p-4">
                <slot />
            </div>
        </AppContent>
    </AppShell>
</template>
