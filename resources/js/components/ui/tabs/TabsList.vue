<template>
    <TabsListRoot v-bind="$attrs">
        <slot />
    </TabsListRoot>
</template>

<script setup>
import { TabsList as TabsListRoot } from 'radix-vue';
</script> 