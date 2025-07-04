<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';

import { defineProps } from 'vue';

const props = defineProps({
    property: Object,
});

const showImageDialog = ref(false);
const currentImage = ref('');

function openImage(imageUrl) {
    currentImage.value = imageUrl;
    showImageDialog.value = true;
}
</script>

<template>
    <AppLayout :breadcrumbs="[]">
        <div class="max-w-4xl mx-auto py-8">
            <h1 class="text-3xl font-bold mb-4">{{ property.title }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div v-for="image_url in property.images" :key="image_url" class="w-full h-64 cursor-pointer"
                    @click="openImage(image_url)">
                    <img :src="image_url" :alt="property.title" class="w-full h-full object-cover rounded-lg shadow-lg">
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">{{ $t('Property Details') }}</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
                    <div class="col-span-1">
                        <dt class="font-medium text-gray-500 dark:text-gray-400">{{ $t('Price') }}:</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ property.price }}</dd>
                    </div>
                    <div class="col-span-1">
                        <dt class="font-medium text-gray-500 dark:text-gray-400">{{ $t('Type') }}:</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ property.property_type }}</dd>
                    </div>
                    <div class="col-span-1">
                        <dt class="font-medium text-gray-500 dark:text-gray-400">{{ $t('Listing Type') }}:</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ property.listing_type }}</dd>
                    </div>
                    <div class="col-span-1">
                        <dt class="font-medium text-gray-500 dark:text-gray-400">{{ $t('Rooms') }}:</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ property.rooms }}</dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="font-medium text-gray-500 dark:text-gray-400">{{ $t('Location') }}:</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ property.country.name }}, {{ property.city.name }}, {{ property.district.name }}</dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="font-medium text-gray-500 dark:text-gray-400">{{ $t('Description') }}:</dt>
                        <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ property.description }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <Dialog v-model:open="showImageDialog">
            <DialogContent class="sm:max-w-[800px] w-full h-auto">
                <DialogHeader>
                    <DialogTitle>{{ property.title }}</DialogTitle>
                    <DialogDescription>
                        {{$t('View of the property image')}}
                    </DialogDescription>
                </DialogHeader>
                <img :src="currentImage" :alt="property.title" class="w-full h-auto object-contain">
            </DialogContent>
        </Dialog>
    </AppLayout>
</template> 