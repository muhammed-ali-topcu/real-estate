<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import { Home, LayoutGrid,Users } from 'lucide-vue-next';
import AppLogo from '@/components/AppLogo.vue';
import { computed } from 'vue';


const page = usePage<SharedData>();
const auth = computed(() => page.props.auth);

const mainNavItems: NavItem[] = [
    {
        title: trans('Dashboard'),
        href: route('admin.dashboard'),
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
];

</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('home')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
