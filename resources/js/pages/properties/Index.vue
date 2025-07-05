<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import Pagination from '@/components/Pagination.vue';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { X, Search as SearchIcon } from 'lucide-vue-next';

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
        PublicLayout,
        X,
        SearchIcon
    },
    props: {
        properties: {
            type: Object,
            required: true,
        },
        filters: {
            type: Object,
            required: false,
            default: () => ({
                keyword: '',
            }),
        },
    },
    data() {
       
    },
    methods: {
        resetFilters() {
            this.filters.keyword = '';
            this.applyFilters();
        },
        applyFilters() {
            router.get(
                this.route('properties.index'),
                this.filters,
                { preserveState: true, replace: true }
            );
        },
    }
};
</script>


<template>
    <AppLayout>
        <div class="space-y-4">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold mb-4">{{ $t('Properties') }}</h1>
                <form @submit.prevent="applyFilters">
                <div class="relative max-w-xl mx-auto flex items-center space-x-2">
                    <input
                        v-model="filters.keyword"
                        type="text"
                        name="keyword"
                        :placeholder="$t('Search properties...')"
                        class="w-full pl-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />

                    <button type="submit" class="flex items-center px-4 py-2 text-white  bg-blue-500 rounded-lg hover:bg-blue-700">
                        <SearchIcon class="h-5 w-5" />
                    </button>
                    
                    <button
                        v-if="filters.keyword"
                        @click="resetFilters"
                        type="button"
                        class="flex items-center px-4 py-2 text-white  bg-blue-500 rounded-lg hover:bg-blue-600"
                    >
                        <X class="h-5 w-5" />
                    </button>
                </div>
                </form>
            </div>
            
            <div v-if="properties.data.length > 0" class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
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
            <div v-else class="text-center py-12">
                <p class="text-gray-500">{{ $t('No properties found matching your search.') }}</p>
            </div>
            <Pagination :links="properties.links" ></Pagination>
        </div>
    </AppLayout>
</template>
