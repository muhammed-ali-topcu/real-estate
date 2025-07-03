<template>
    <TabsTriggerRoot v-bind="$attrs">
        <slot />
    </TabsTriggerRoot>
</template>

<script setup>
import { TabsTrigger as TabsTriggerRoot } from 'radix-vue';
</script> 