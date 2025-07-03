<script>
import InputError from '@/components/InputError.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Select } from '@/components/ui/select/index.js';
import Address from '@/pages/admin/properties/Addres.vue';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';

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
                avatar:null,
                _method: 'put',
            }),
            imageForm: this.$inertia.form({
                image: null,
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route('admin.properties.update', this.property.id), {
                preserveScroll: true,
            });

        },
        uploadImage() {
            this.imageForm.post(route('admin.properties.uploadImage', this.property.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.imageForm.reset();
                    this.$inertia.visit(route('admin.properties.edit', this.property.id), { preserveState: true, preserveScroll: true });
                    if (this.$refs.newImageInput) {
                        this.$refs.newImageInput.value = null;
                    }
                },
            });
        },
        deleteImage(mediaId) {
            if (confirm('Are you sure you want to delete this image?')) {
                this.$inertia.delete(route('admin.properties.deleteImage', { property: this.property.id, mediaId: mediaId }), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.$inertia.visit(route('admin.properties.edit', this.property.id), { preserveState: true, preserveScroll: true });
                    },
                });
            }
        },
    },


};
</script>

<template>

    <Head :title="$t('Edit property')" />

    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 gap-96">

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

                        <div class="my-4">
                            <Label for="avatar">{{ $t('Avatar') }}</Label>
                            <Input
                                id="avatar"
                                type="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                @change="form.avatar = $event.target.files[0]"
                                accept="image/*"
                            />
                            <InputError class="mt-2" :message="form.errors.avatar" />
                            <div v-if="form.progress" class="mt-2">
                                <progress
                                    :value="form.progress.percentage"
                                    max="100"
                                    class="w-full h-2 rounded bg-gray-200"
                                ></progress>
                                <span class="text-xs text-gray-600 ml-2">{{ form.progress.percentage }}%</span>
                            </div>
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
                    <div class="my-4">
                        <h2 class="text-lg font-semibold mb-2">{{ $t('Upload New Image') }}</h2>
                        <form @submit.prevent="uploadImage" class="flex items-center space-x-4">
                            <Input
                                id="new_image"
                                type="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                @change="imageForm.image = $event.target.files[0]"
                                accept="image/*"
                                ref="newImageInput"
                            />
                            <Button type="submit" :disabled="imageForm.processing" class="rounded bg-green-500 px-4 py-2 text-white">
                                <span v-if="imageForm.processing">{{ $t('Uploading') }}...</span>
                                <span v-else>{{ $t('Upload') }}</span>
                            </Button>
                        </form>
                        <InputError class="mt-2" :message="imageForm.errors.image" />
                        <div v-if="imageForm.progress" class="mt-2">
                            <progress
                                :value="imageForm.progress.percentage"
                                max="100"
                                class="w-full h-2 rounded bg-gray-200"
                            ></progress>
                            <span class="text-xs text-gray-600 ml-2">{{ imageForm.progress.percentage }}%</span>
                        </div>
                    </div>

                    <div class="my-6">
                        <h2 class="text-lg font-semibold mb-2">{{ $t('Existing Images') }}</h2>
                        <div v-if="property.media && property.media.length > 0" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <div v-for="image in property.media" :key="image.id" class="relative group">
                                <img :src="image.original_url" :alt="image.name" class="w-full h-32 object-cover rounded-lg shadow-md" />
                                <button @click="deleteImage(image.id)" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1zm2 4a1 1 0 100 2h2a1 1 0 100-2H9z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p v-else class="text-gray-500">{{ $t('No images found for this property.') }}</p>
                    </div>
                </TabsContent>
            </Tabs>
        </div>
    </AppLayout>
</template>
