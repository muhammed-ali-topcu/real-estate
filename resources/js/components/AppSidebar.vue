<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import NavGuest from '@/components/NavGuest.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import { BookOpen, Folder, Home, LayoutGrid,Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { computed } from 'vue';


const page = usePage<SharedData>();
const auth = computed(() => page.props.auth);

const mainNavItems: NavItem[] = [
    {
        title: trans('Dashboard'),
        href: route('dashboard'),
        icon: LayoutGrid,
        visible: auth.value?.user !== null
    },
    {
        title: trans('Users'),
        href: route('admin.users.index'),
        icon: Users,
        visible: auth.value?.user ? page.props.can.list_users ?? false : false,
    },
    {
        title: trans('Properties Manager'),
        href: route('admin.properties.index'),
        icon: Home,
        visible: auth.value?.user ? page.props.can.list_properties ?? false : false,
    },
    {
        title: trans('Properties'),
        href: route('properties.index'),
        icon: Home,
        visible: true,
    },


];

const footerNavItems: NavItem[] = [
    {
        title: trans('Github Repo'),
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
        visible: false,
    },
    {
        title: trans('Documentation'),
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
        visible:false,
    },


];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                            <h3>{{ trans('app.name') }}</h3>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser v-if="auth.user" />
            <NavGuest v-else />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
