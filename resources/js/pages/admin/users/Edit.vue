<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import InputError from '@/components/InputError.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const props = defineProps<{ user: any }>();

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    // Add other user fields as needed
});

const submit = () => {
    form.put(route('admin.users.update', props.user.id));
};
</script>

<template>
    <AppLayout>
        <Head :title="$t('Edit user')" />

        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="max-w-2xl mx-auto w-full">
                <h1 class="text-2xl font-semibold mb-6">Edit User</h1>

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="space-y-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            v-model="form.name"
                            required
                            autocomplete="name"
                            placeholder="Full name"
                            :disabled="form.processing"
                        />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="space-y-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autocomplete="email"
                            placeholder="Email address"
                            :disabled="form.processing"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <Button
                            type="button"
                            variant="outline"
                            @click="$inertia.visit(route('admin.users.index'))"
                            :disabled="form.processing"
                        >
                            Cancel
                        </Button>
                        <Button
                            type="submit"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Saving...</span>
                            <span v-else>Save Changes</span>
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
