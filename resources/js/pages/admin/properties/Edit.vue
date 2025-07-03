<script>
import InputError from '@/components/InputError.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Select } from '@/components/ui/select/index.js';
import Address from '@/pages/admin/properties/Addres.vue';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import PropertyImages from '@/components/PropertyImages.vue';

export default {
    components: {
        Select,
        AppLayout,
        Head,
        InputError,
        Input,
        Label,
        Address,
        Tabs,
        TabsContent,
        TabsList,
        TabsTrigger,
        PropertyImages,
    },
    props: {
        property: {
            type: Object,
            required: true,
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
        rooms: {
            type: Array,
            required: true,
        },
    },

    data() {
        return {
            currentTab: 'general',
            form: this.$inertia.form({
                title: this.property.title,
                description: this.property.description,
                price: this.property.price,
                status: this.property.status,
                property_type: this.property.property_type,
                listing_type: this.property.listing_type,
                rooms: this.property.rooms,
                admin_notes: this.property.admin_notes,
                approved_at: this.property.approved_at,
                approved_by: this.property.approved_by,
                area: this.property.area,
                address: this.property.address,
                country_id: this.property.country_id,
                city_id: this.property.city_id,
                district_id: this.property.district_id,
                _method: 'put',
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route('admin.properties.update', this.property.id), {
                preserveScroll: true,
            });

        },
    },


};
</script>

<template>

    <Head :title="$t('Edit property')" />

    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <h1 class="text-xl font-semibold leading-tight tracking-tight text-gray-900 dark:text-white">
                {{ $t('Edit property') }}
            </h1>

            <Tabs v-model="currentTab">
                <TabsList class="flex space-x-1 rounded-lg bg-gray-100 p-1">
                    <TabsTrigger value="general" class="px-3 py-2 text-sm font-medium text-gray-900 rounded-md data-[state=active]:bg-white data-[state=active]:shadow">
                        {{ $t('General') }}
                    </TabsTrigger>
                    <TabsTrigger value="images" class="px-3 py-2 text-sm font-medium text-gray-900 rounded-md data-[state=active]:bg-white data-[state=active]:shadow">
                        {{ $t('Images') }}
                    </TabsTrigger>
                </TabsList>

                <TabsContent value="general" class="mt-4">
                    <form @submit.prevent="submit">

                        <div class="grid ">
                            <Label for="title">{{ $t('Title') }}</Label>
                            <Input id="title" class="mt-1 block w-full" v-model="form.title" required
                                :placeholder="$t('Title')" />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="my-4">
                                <Label for="property_type">{{ $t('Property Type') }}</Label>
                                <select id="property_type" class="mt-1 block w-full rounded border p-1"
                                    v-model="form.property_type">
                                    <option :value="null" disabled selected>{{ $t('Select Property Type') }}</option>
                                    <option v-for="property_type in propertyTypes" :value="property_type">
                                        {{ $t(property_type) }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.property_type" />
                            </div>

                            <div class="my-4">
                                <Label for="listing_type">{{ $t('Listing Type') }}</Label>
                                <select id="listing_type" class="mt-1 block w-full rounded border p-1"
                                    v-model="form.listing_type">
                                    <option :value="null" disabled selected>{{ $t('Select Listing Type') }}</option>
                                    <option v-for="listing_type in listingTypes" :value="listing_type">
                                        {{ $t(listing_type) }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.listing_type" />
                            </div>

                            <div class="my-4">
                                <Label for="rooms">{{ $t('Rooms') }}</Label>
                                <select id="rooms" class="mt-1 block w-full rounded border p-1" v-model="form.rooms">
                                    <option :value="null" disabled selected>{{ $t('Select Rooms') }}</option>
                                    <option v-for="room in rooms" :value="room">
                                        {{ $t(room) }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.rooms" />
                            </div>


                            <div class="my-4">
                                <Label for="status">{{ $t('Status') }}</Label>
                                <select id="status" class="mt-1 block w-full rounded border p-1" v-model="form.status">
                                    <option :value="null" disabled selected>{{ $t('Select Status') }}</option>
                                    <option v-for="status in statuses" :value="status">
                                        {{ $t(status) }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.status" />
                            </div>

                            <div class="my-4">
                                <Label for="price">{{ $t('Price') }}</Label>
                                <Input id="price" class="mt-1 block w-full" v-model="form.price" required
                                    :placeholder="$t('Price')" type="number" />
                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <div class="my-4">
                                <Label for="area">{{ $t('Area in square meters') }}</Label>
                                <Input id="area" class="mt-1 block w-full" v-model="form.area" required
                                    :placeholder="$t('Area in square meters')" type="number" />
                                <InputError class="mt-2" :message="form.errors.area" />
                            </div>
                        </div>

                        <div class="my-4">
                            <Address @update:country-id="value => form.country_id = value"
                                @update:city-id="value => form.city_id = value"
                                @update:district-id="value => form.district_id = value"
                                :country-id="property.country_id"
                                :city-id="property.city_id"
                                :district-id="property.district_id"
                                :errors="form.errors"
                                />
                        </div>


                        <div class="grid my-4">
                            <Label for="address">{{ $t('Address') }}</Label>
                            <textarea class="mt-2 block w-full  p-2 rounded border " id="address" v-model="form.address"
                                :placeholder="$t('Address')" rows="5"></textarea>
                            <InputError class="" :message="form.errors.address" />
                        </div>


                        <div class="grid my-4">
                            <Label for="description">{{ $t('Description') }}</Label>
                            <textarea class="mt-2 block w-full rounded p-2 border " id="description" v-model="form.description"
                                :placeholder="$t('Description')" rows="5"></textarea>
                            <InputError class="" :message="form.errors.description" />
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <Button type="button" variant="outline" @click="$inertia.visit(route('admin.properties.index'))"
                                :disabled="form.processing" class="rounded bg-gray-400 px-2 py-1">
                                {{ $t('Cancel') }}
                            </Button>
                            <Button type="submit" :disabled="form.processing" class="rounded bg-blue-400 px-2 py-1">
                                <span v-if="form.processing">{{ $t('Saving') }}...</span>
                                <span v-else>{{ $t('Save') }}</span>
                            </Button>
                        </div>
                    </form>
                </TabsContent>
                <TabsContent value="images" class="mt-4">
                    <PropertyImages :property="property" />
                </TabsContent>
            </Tabs>
        </div>
    </AppLayout>
</template>
