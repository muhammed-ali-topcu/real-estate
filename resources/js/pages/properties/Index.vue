<script>

import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Pagination from '@/components/Pagination.vue';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import PublicLayout from '@/layouts/PublicLayout.vue';

export default {
    components: {
        AppLayout,
        Link,
        Pagination,
        Card,
        CardContent,
        CardDescription,
        CardFooter,
        CardHeader,
        CardTitle,
        PublicLayout
    },
    props: {
        properties: {
            type: Object,
            required: true,
        },
    },
    methods: {
        created() {

        }
    }
};
</script>


<template>
    <AppLayout>
        <div class="space-y-4">
            <h1>{{ $t('Properties') }}</h1>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <Card v-for="property in properties.data" :key="property.id" class="flex flex-col">
                    <Link :href="route('properties.show', property.id)">
                        <img v-if="property.first_image_url" :src="property.first_image_url" :alt="property.title" class="w-full h-48 object-cover rounded-md shadow-md">
                    </Link>
                    <CardHeader>
                        <CardTitle>
                            <Link :href="route('properties.show', property.id)">
                                {{ property.title }}
                            </Link>
                        </CardTitle>
                        <CardDescription>
                            {{ property.country }}, {{ property.city }}, {{ property.district }}
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="flex-grow">
                        <p>{{ $t('Price') }}: {{ property.price }}</p>
                        <p>{{ $t('Type') }}: {{ property.property_type }}</p>
                        <p>{{ $t('Listing Type') }}: {{ property.listing_type }}</p>
                        <p>{{ $t('Rooms') }}: {{ property.rooms }}</p>
                    </CardContent>
                    <CardFooter>
                        <Link :href="route('properties.show', property.id)" class="text-blue-500 hover:underline">{{ $t('View Details') }}</Link>
                    </CardFooter>
                </Card>
            </div>
            <Pagination :links="properties.links" ></Pagination>

        </div>
    </AppLayout>
</template>
