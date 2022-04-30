<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineProps } from "vue";

const props = defineProps({
    info: Number,
    download: Number,
    weblink: Number,
})
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Company Y Portal
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between">
                            <h3 class="text-2xl">Dashboard</h3>
                        </div>

                        <div>
                            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                                <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Info Items
                                    </dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                        {{ info }}
                                    </dd>
                                </div>
                                <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Download Items
                                    </dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                        {{ download }}
                                    </dd>
                                </div>
                                <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Weblink Items
                                    </dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                        {{ weblink }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
