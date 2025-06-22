<script>
import InputError from '@/components/InputError.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Select } from '@/components/ui/select/index.js';
import axios from 'axios';
export default {
    components: {
        Select,
        AppLayout,
        Head,
        InputError,
        Input,
        Label,
    },

    emits: ['update:country-id','update:city-id','update:district-id'],

    props: {
     
    },
    data() {
        return {
            form: this.$inertia.form({
                country_id: null,
                city_id: null,
                district_id: null,
            }),
            countries: [],
            cities: [],
            districts: [],
           
        };
    },
    watch: {
        'form.country_id': function (value) {
            this.getCities();
            this.form.city_id = null;
            this.form.district_id = null;
            this.$emit('update:country-id', value);
        },
        'form.city_id': function (value) {
            this.getDistricts();
            this.form.district_id = null;
            this.$emit('update:city-id', value);
        },
        'form.district_id': function (value) {
            this.$emit('update:district-id', value);
            },
    },
    methods: {
        getCountries() {
            axios.get(route('admin.address.countries'), {
                preserveScroll: true,
            }).then((response) => {
                console.log(response.data);
                this.countries = response.data.countries;
            });
        },

        getCities() {
            if (this.form.country_id) {
                axios.get(route('admin.address.cities', this.form.country_id), {}, {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.city_id = null
                        this.form.district_id = null
                    }
                }).then((response) => {
                    console.log(response.data);
                    this.cities = response.data.cities;
                });
            }
        },
        getDistricts() {
            if (this.form.city_id) {
                axios.get(route('admin.address.districts', this.form.city_id), {}, {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.district_id = null
                    }
                }).then((response) => {
                    console.log(response.data);
                    this.districts = response.data.districts;
                });
            }
        },
    },
    created() {
        console.log('created')
        this.getCountries();
    },


    
};
</script>

<template>
    <div class="grid grid-cols-3 gap-2">
        <div class="w-full">
            <label for="country_id" class="block text-sm font-medium text-gray-700">{{ $t('Country') }}</label>
            <select 
                id="country_id" 
                v-model="form.country_id" 
                @change="getCities"
                class="mt-1 block w-full rounded border p-1"
            >
                <option value="">{{ $t('Select a country') }}</option>
                <option v-for="country in countries" :key="country.id" :value="country.id">
                    {{ country.name }}
                </option>
            </select>
        </div>

        <div class="w-full">
            <label for="city_id" class="block text-sm font-medium text-gray-700">{{ $t('City') }}</label>
            <select 
                id="city_id" 
                v-model="form.city_id" 
                @change="getDistricts"
                class="mt-1 block w-full rounded border p-1"
            >
                <option value="">{{ $t('Select a city') }}</option>
                <option v-for="city in cities" :key="city.id" :value="city.id">
                    {{ city.name }}
                </option>
            </select>
        </div>

        <div class="w-full">    
            <label for="district_id" class="block text-sm font-medium text-gray-700">{{ $t('District') }}</label>
            <select 
                id="district_id" 
                v-model="form.district_id"
                class="mt-1 block w-full rounded border p-1"
            >
                <option value="">{{ $t('Select a district') }}</option>
                <option v-for="district in districts" :key="district.id" :value="district.id">
                    {{ district.name }}
                </option>
            </select>
        </div>
    </div>
</template>

