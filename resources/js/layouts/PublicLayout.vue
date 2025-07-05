<script lang="ts">
import FlashMessages from '@/components/FlashMessages.vue';
import AppLogo from '@/components/AppLogo.vue';
import NavGuest from '@/components/NavGuest.vue';
import AppShell from '@/components/AppShell.vue';
import AppHeader from '@/components/AppHeader.vue';
import AppContent from '@/components/AppContent.vue';

export default {
    components: {
        FlashMessages,
        AppLogo,
        NavGuest,
        AppShell,
        AppHeader,
        AppContent,
    },
    props: {
        title: {
            type: String,
            default: '',
        },
        description: {
            type: String,
            default: '',
        },
    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        },
    },
};
</script>

<template>
    <AppShell class="flex-col">
        <AppHeader>
            <!-- <div class="flex h-16 shrink-0 items-center px-4">
                <AppLogo class="block h-9 w-auto fill-current" />
                <div class="ms-auto">
                    <NavUser v-if="user" />
                    <NavGuest v-else />
                </div>
            </div> -->
        </AppHeader>
        <FlashMessages />
        <AppContent>
            <slot />
        </AppContent>
    </AppShell>
</template> 