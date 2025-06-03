<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { wTrans } from 'laravel-vue-i18n';

import InputError from '@/components/InputError.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';


const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});


const submit = () => {
    form.post(route('admin.users.store'), {
        preserveScroll: true
    });
};

</script>

<template>
    <Head :title="$t('Add user')" />

    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <form @submit.prevent="submit">
                <div class="grid gap-2">
                    <Label for="name">{{ $t('Name') }}</Label>
                    <Input id="name" class="mt-1 block w-full" v-model="form.name" required :placeholder="$t('Name')" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">{{ $t('Email') }}</Label>
                    <Input id="email" class="mt-1 block w-full" v-model="form.email" required
                           :placeholder="$t('Email')" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">{{ $t('Password') }}</Label>
                    <Input id="password" class="mt-1 block w-full" v-model="form.password" required
                           :placeholder="$t('Password')" type="password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">{{ $t('Confirm password') }}</Label>
                    <Input id="password_confirmation" class="mt-1 block w-full" v-model="form.password_confirmation"
                           required :placeholder="$t('Confirm password')" type="password" />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>


                <button type="submit" class="rounded bg-blue-400 px-2 m-2">{{ $t('Save') }}</button>
            </form>

        </div>
    </AppLayout>
</template>
