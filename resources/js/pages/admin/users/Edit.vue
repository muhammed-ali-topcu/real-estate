<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    user: Object;
}>();
</script>

<template>
    <h1>{{ $t('Edit user') }}</h1>


</template>
