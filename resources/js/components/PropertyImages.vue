<template>
    <div>
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
            <div v-if="localProperty.media && localProperty.media.length > 0" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div v-for="image in localProperty.media" :key="image.id" class="relative group">
                    <img :src="image.original_url" :alt="image.name" class="w-full h-32 object-cover rounded-lg shadow-md" />
                    <button @click="deleteImage(image.id)" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-20 group-hover:opacity-100 transition-opacity">
                        <Icon name="Trash2" class="h-5 w-5" />
                    </button>
                </div>
            </div>
            <p v-else class="text-gray-500">{{ $t('No images found for this property.') }}</p>
        </div>
    </div>
</template>

<script>
import InputError from '@/components/InputError.vue';
import Input from '@/components/ui/input/Input.vue';
import Button from '@/components/ui/button/Button.vue';
import Icon from '@/components/Icon.vue';

export default {
    components: {
        InputError,
        Input,
        Button,
        Icon,
    },
    props: {
        property: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            imageForm: this.$inertia.form({
                image: null,
            }),
            localProperty: this.property,
        };
    },
    methods: {
        uploadImage() {
            this.imageForm.post(route('admin.properties.uploadImage', this.property.id), {
                preserveScroll: true,
                onSuccess: (page) => {
                    this.imageForm.reset();
                    if (this.$refs.newImageInput) {
                        this.$refs.newImageInput.value = null;
                    }
                    this.localProperty = page.props.property; // Update local property with new media
                },
            });
        },
        deleteImage(mediaId) {
            if (confirm('Are you sure you want to delete this image?')) {
                this.$inertia.delete(route('admin.properties.deleteImage', { property: this.property.id, mediaId: mediaId }), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.localProperty = page.props.property; // Update local property with new media
                    },
                });
            }
        },
    },
    watch: {
        property: {
            handler(newVal) {
                this.localProperty = newVal;
            },
            deep: true,
        },
    },
};
</script> 