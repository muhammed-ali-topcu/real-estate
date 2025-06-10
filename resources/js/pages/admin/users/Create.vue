<script>
import InputError from '@/components/InputError.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Select } from '@/components/ui/select/index.js';

export default {
    components: {
        Select,
        AppLayout,
        Head,
        InputError,
        Input,
        Label
    },
    props: {
        roles: Array

    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                roles:[],
            })
        };
    },
    methods: {
        submit() {
            this.form.post(route('admin.users.store'), {
                preserveScroll: true
            });
        }
    },
    created() {
        console.log(this.roles);
    }

};
</script>

<template>
    <Head :title="$t('Add user')" />

    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 gap-96">
            <form @submit.prevent="submit">

                <h1 class="text-xl font-semibold leading-tight tracking-tight text-gray-900 dark:text-white">
                    {{ $t('Add user') }}
                </h1>
                <div class="grid ">
                    <Label for="name">{{ $t('Name') }}</Label>
                    <Input id="name" class="mt-1 block w-full" v-model="form.name" required :placeholder="$t('Name')" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="grid  mt-4">
                    <Label for="email">{{ $t('Email') }}</Label>
                    <Input id="email" class="block w-full" v-model="form.email" required :placeholder="$t('Email')" />
                    <InputError class="" :message="form.errors.email" />
                </div>

                <div class="space-y-2">
                    <Label for="roles">{{ $t('Role') }}</Label>
                    <select id="roles" class="mt-1 block w-full" v-model="form.roles"  multiple>
                        <option v-for="role in roles" :value="role">
                            {{ $t(role) }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.roles" />
                </div>


                <div class="grid gap-4 mt-4">
                    <Label for="password">{{ $t('Password') }}</Label>
                    <Input id="password" class="mt-1 block w-full" v-model="form.password" required
                           :placeholder="$t('Password')" type="password" />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-4 mt-4">
                    <Label for="password_confirmation">{{ $t('Confirm password') }}</Label>
                    <Input
                        id="password_confirmation"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        :placeholder="$t('Confirm password')"
                        type="password"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>
                <button type="submit" class="m-2 rounded bg-blue-400 px-2">{{ $t('Save') }}</button>
            </form>
        </div>
    </AppLayout>
</template>
