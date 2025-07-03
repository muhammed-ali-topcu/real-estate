<template>
    <TabsContentRoot v-bind="$attrs">
        <slot />
    </TabsContentRoot>
</template>

<script setup>
import { TabsContent as TabsContentRoot } from 'radix-vue';
</script> 