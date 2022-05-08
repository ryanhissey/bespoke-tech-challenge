<script setup>
import { defineProps } from "vue";
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    links: Object
})
</script>

<template>
    <div class="flex flex-wrap -mb-1">
        <template v-for="(link) in links">
            <div v-if="link.url === null" class="mr-2 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                 v-html="link.label"/>
            <Link v-else
                  class="mr-2 mb-1 px-4 py-3 text-sm leading-4 border rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  :class="{ 'bg-indigo-700 text-white hover:bg-indigo-700': link.active }" :href="link.url"
                  v-html="link.label"/>
        </template>
    </div>
</template>
