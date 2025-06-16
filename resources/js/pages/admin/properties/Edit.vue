<script>
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox/index.js';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

export default {
    components: {
        Checkbox,
        AppLayout,
        Head,
        Button,
        InputError,
        Input,
        Label,
    },
    props: {
        user: Object,
        roles: Array,
    },
    data() {
        return {
            form: useForm({
                name: this.user.name,
                email: this.user.email,
                roles: this.user.roles,
                is_active: this.user.is_active,
                change_password: false,
                password: '',
                password_confirmation: '',
            }),
        };
    },
    methods: {
        submit() {
            this.form.put(route('admin.users.update', this.user.id));
        },
    },

};
</script>

<template>
    <AppLayout>
        <Head :title="$t('Edit user')" />

        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="mx-auto w-full max-w-2xl">
                <h1 class="mb-6 text-2xl font-semibold">Edit User</h1>

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="space-y-2">
                        <Label for="name">Name</Label>
                        <Input id="name" v-model="form.name" required autocomplete="name" placeholder="Full name" :disabled="form.processing" />
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

                    <div class="space-y-2">
                        <Label for="roles">{{ $t('Role') }}</Label>
                        <select id="roles" class="mt-1 block w-full" v-model="form.roles" multiple>
                            <option v-for="role in roles" :value="role">
                                {{ $t(role) }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.roles" />
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="">
                            <Label for="is_active">
                                <Checkbox id="is_active" name="is_active" v-model="form.is_active" />
                                {{ $t('Active') }}
                            </Label>
                            <InputError class="mt-2" :message="form.errors.is_active" />
                        </div>

                        <div class="space-y-2">
                            <Label for="change_password">
                                <Checkbox id="change_password" name="change_password" v-model="form.change_password" />
                                {{ $t('change password') }}
                            </Label>

                            <InputError class="mt-2" :message="form.errors.change_password" />
                        </div>
                    </div>

                    <div v-if="form.change_password" class="space-y-2">
                        <div class="mt-4 grid gap-4">
                            <Label for="password">{{ $t('New Password') }}</Label>
                            <Input
                                id="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                :placeholder="$t('Password')"
                                type="password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                        <div class="mt-4 grid gap-4">
                            <Label for="password_confirmation">{{ $t('Confirm password') }}</Label>
                            <Input
                                id="password_confirmation"
                                class="mt-1 block w-full"
                                v-model="form.password_confirmation"

                                :placeholder="$t('Confirm password')"
                                type="password"
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <Button type="button" variant="outline" @click="$inertia.visit(route('admin.users.index'))" :disabled="form.processing">
                            Cancel
                        </Button>
                        <Button type="submit" :disabled="form.processing">
                            <span v-if="form.processing">Saving...</span>
                            <span v-else>Save Changes</span>
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
