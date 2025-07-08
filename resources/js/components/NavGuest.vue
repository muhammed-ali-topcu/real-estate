<script setup lang="ts">
import { SidebarMenu, SidebarMenuButton, SidebarMenuItem, useSidebar } from '@/components/ui/sidebar';
import { Link, usePage } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import { computed } from 'vue';
import { LogIn, UserPlus } from 'lucide-vue-next';

const page = usePage();
const { isMobile, state } = useSidebar();

const authNavItems = computed(() => [
    {
        title: trans('Login'),
        href: route('login'),
        icon: LogIn,
        visible: true,
    },
    {
        title: trans('Register'),
        href: route('register'),
        icon: UserPlus,
        visible: true,
    },
]);
</script>

<template>
    <SidebarMenu>
        <SidebarMenuItem v-for="item in authNavItems" :key="item.href">
            <Link :href="item.href">
                <SidebarMenuButton size="lg" :class="[state === 'collapsed' ? 'justify-center' : '', 'hover:bg-accent']">
                    <component :is="item.icon" class="size-4" />
                    <span v-if="state !== 'collapsed'">{{ item.title }}</span>
                </SidebarMenuButton>
            </Link>
        </SidebarMenuItem>
    </SidebarMenu>
</template> 