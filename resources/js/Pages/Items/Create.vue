<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineProps, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";

const form = reactive({
    name: null,
    description: null,
    content_type: 'info',
    content: {
        header: null,
        content: null,
        url: null
    }
})

function submit() {
    Inertia.post(`/admin/items`, form)
}

</script>

<template>
    <Head title="Dashboard"/>

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
                        <h3 class="text-2xl">Create Item</h3>
                    </div>

                    <div class="p-6">
                        <form @submit.prevent="submit">

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <div class="mt-1">
                                    <input type="text" name="name" id="name" v-model="form.name"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                           placeholder="Item Name"/>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="name" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea name="name" id="name" v-model="form.description"
                                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                              placeholder="Item Description"/>
                                </div>
                            </div>


                            <div class="mt-3">
                                <label for="content_type" class="block text-sm font-medium text-gray-700">Type</label>
                                <select id="content_type" name="content_type" v-model="form.content_type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="info">Info</option>
                                    <option value="download">Download</option>
                                    <option value="WEBLINK">Weblink</option>
                                </select>
                            </div>

                            <template v-if="form.content_type === 'info'">

                                <div class="mt-3">
                                    <label for="header" class="block text-sm font-medium text-gray-700">Header</label>
                                    <div class="mt-1">
                                        <input type="text" name="header" id="header" v-model="form.content.header"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                               placeholder="Item Header"/>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                                    <div class="mt-1">
                                        <textarea name="name" id="content" v-model="form.content.content" rows="10"
                                                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                  placeholder="Item Content"/>
                                    </div>
                                </div>
                            </template>
                            <template v-else>

                                <div class="mt-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">URL</label>
                                    <div class="mt-1">
                                        <input type="text" name="url" id="url" v-model="form.content.url"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                               placeholder="Item URL"/>
                                    </div>
                                </div>
                            </template>


                            <div class="mt-3">
                                <button type="submit" class="w-auto flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                            </div>

                            <div class="mt-3">
                                <Link class="text-indigo-600 hover:text-indigo-900 cursor-pointer"
                                      :href="route('admin.items.index')">
                                    Cancel
                                </Link>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>
