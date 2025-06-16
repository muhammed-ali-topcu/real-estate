<script>
import Pagination from '@/components/Pagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { wTrans } from 'laravel-vue-i18n';

export default {
    components: {
        Pagination,
        AppLayout,
        Link,
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
                search: '',
                property_type: null,
                listing_type: null,
                status: null,
                min_price: '',
                max_price: '',
                min_bedrooms: '',
                max_bedrooms: '',
            }),
        },
        propertyTypes: {
            type: Array,
            required: true,
        },
        listingTypes: {
            type: Array,
            required: true,
        },
        statuses: {
            type: Array,
            required: true,
        },
    },

    data() {
        return {
            breadcrumbs: [
                {
                    title: wTrans('Properties'),
                    href: this.route('admin.properties.index'),
                },
            ],
        };
    },

    methods: {
        applyFilters() {
            router.get(
                this.route('admin.properties.index'),
                this.filters,
                { preserveState: true, replace: true }
            );
        },
        resetFilters() {
            this.filters.search = '';
            this.filters.property_type = null;
            this.filters.listing_type = null;
            this.filters.status = null;
            this.filters.min_price = '';
            this.filters.max_price = '';
            this.filters.min_bedrooms = '';
            this.filters.max_bedrooms = '';
            this.applyFilters();
        },
    },
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold">{{ $t('Properties') }}</h1>
            <Link :href="route('admin.properties.create')" class="btn-primary"> {{ $t('Create property') }}</Link>
        </div>

        <form @submit.prevent="applyFilters" class="my-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Search -->
                <div>
                    <label class="block">{{ $t('Search') }}</label>
                    <input type="text" :placeholder="$t('Search properties...')" class="rounded border p-2"
                        v-model="filters.search" />
                </div>

                <!-- Property Type -->
                <div>
                    <label class="block">{{ $t('Property Type') }}</label>
                    <select v-model="filters.property_type" class="rounded border p-2">
                        <option :value="null">{{ $t('All') }}</option>
                        <option v-for="type in propertyTypes" :key="type" :value="type">{{ type }}</option>
                    </select>
                </div>

                <!-- Listing Type -->
                <div>
                    <label class="block">{{ $t('Listing Type') }}</label>
                    <select v-model="filters.listing_type" class="rounded border p-2">
                        <option :value="null">{{ $t('All') }}</option>
                        <option v-for="type in listingTypes" :key="type" :value="type">{{ type }}</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="block">{{ $t('Status') }}</label>
                    <select v-model="filters.status" class="rounded border p-2">
                        <option :value="null">{{ $t('All') }}</option>
                        <option v-for="status in statuses" :key="status" :value="status">{{ status }}</option>
                    </select>
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block">{{ $t('Price Range') }}</label>
                    <div class="flex space-x-4">
                        <input type="number" :placeholder="$t('Min')" class="flex-1 rounded border p-2"
                            v-model="filters.min_price" />
                        <input type="number" :placeholder="$t('Max')" class="rounded border p-2"
                            v-model="filters.max_price" />
                    </div>
                </div>

                <div class="flex items-center justify-between mt-5 gap-2">
                    <button type="submit" class="rounded border p-2 bg-blue-500  text-white hover:bg-blue-600">{{
                        $t('Search') }}</button>
                    <button type="button" @click="resetFilters"
                        class="rounded border p-2 bg-red-500  text-white hover:bg-red-600">{{ $t('Reset') }}</button>
                </div>

            </div>

        </form>


        <table class="table-bordered table-striped table w-full mt-4">
            <thead>
                <tr>
                    <th>{{ $t('ID') }}</th>
                    <th>{{ $t('Title') }}</th>
                    <th>{{ $t('Property Type') }}</th>
                    <th>{{ $t('Listing Type') }}</th>
                    <th>{{ $t('Price') }}</th>
                    <th>{{ $t('Bedrooms') }}</th>
                    <th>{{ $t('Status') }}</th>
                    <th>{{ $t('Created at') }}</th>
                    <th>{{ $t('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="property in properties.data" :key="property.id">
                    <td>{{ property.id }}</td>
                    <td>{{ property.title }}</td>
                    <td>{{ property.property_type }}</td>
                    <td>{{ property.listing_type }}</td>
                    <td>{{ property.price }}</td>
                    <td>{{ property.bedrooms }}</td>
                    <td>{{ property.status }}</td>
                    <td>{{ property.created_at }}</td>
                    <td>
                        <Link v-if="$page.props.can.edit_properties" :href="route('admin.properties.edit', property.id)"
                            class="m-2 rounded hover:bg-amber-100" as="button">
                        {{ $t('Edit') }}
                        </Link>

                        <Link v-if="$page.props.can.delete_properties"
                            :href="route('admin.properties.destroy', property.id)" method="delete" as="button"
                            class="rounded bg-red-500 p-2 font-bold text-white hover:bg-red-700">
                        {{ $t('Delete') }}
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :links="properties.links" />
    </AppLayout>
</template>
