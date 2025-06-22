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
        countryId: {
            type: Number,
            default: null,
        },
        cityId: {
            type: Number,
            default: null,
        },
        districtId: {
            type: Number,
            default: null,
        },
        errors: {
            type: Object,
            default: () => ({})
        },
     
    },
    data() {
        return {
            form: this.$inertia.form({
                country_id: this.countryId,
                city_id: this.cityId,
                district_id: this.districtId,
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
        this.getCountries();
        if (this.countryId) {
            this.getCities();
        }
        if (this.cityId) {
            this.getDistricts();
        }
    },


    
};
</script>

<template>
    <div class="grid grid-cols-3 gap-2">
        <div class="w-full">
            <Label for="country_id" class="block text-sm font-medium text-gray-700">{{ $t('Country') }}</Label>
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
            <InputError class="mt-2" :message="errors.country_id" />
            </div>

        <div class="w-full">
            <Label for="city_id" class="block text-sm font-medium text-gray-700">{{ $t('City') }}</Label>
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
            <InputError class="mt-2" :message="errors.city_id" />
        </div>

        <div class="w-full">    
            <Label for="district_id" class="block text-sm font-medium text-gray-700">{{ $t('District') }}</Label>
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
            <InputError class="mt-2" :message="errors.district_id" />
        </div>
    </div>
</template>
