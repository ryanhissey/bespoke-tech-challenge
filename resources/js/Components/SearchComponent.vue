<script>
import { debounce } from "lodash";
import Card from "@/Components/Card";
import { BookOpenIcon, DownloadIcon, ExternalLinkIcon } from '@heroicons/vue/outline';

export default {
    data() {
        return {
            minSearchLength: 3,
            success: false,
            error: false,
            loading: false,
            searchTerms: null,
            results: [],
            resultsLength: 0
        };
    },
    watch: {
        searchTerms(after, before) {
            if (this.searchTerms.length >= this.minSearchLength) {
                this.search();
            }
            if (this.searchTerms.length < this.minSearchLength) {
                this.results = [];
            }
        }
    },
    methods: {
        search: debounce(function () {
            this.loading = true;
            axios.get('/admin/item/search', { params: { searchTerms: this.searchTerms } })
                .then((response) => {
                    this.results = response.data;
                    this.success = true;
                    this.loading = false;
                })
                .catch((error) => {
                    this.error = true;
                    this.loading = false;
                    console.log(error)
                })
        }, 300),
        showNoResults: function () {
            return true;
        },
        resultCount(){
            return this.resultsLength;
        }
    },
    components: {
        "book-open": BookOpenIcon,
        "download": DownloadIcon,
        "external-link": ExternalLinkIcon,
    }
}
</script>

<template>
    <div>
        <input type="text" v-model="searchTerms" class="mt-4">
        <template v-if="loading === true">
            <div class="grid place-content-center">
                <div class="flex items-center gap-2 text-gray-500">
                    <span class="h-6 w-6 block rounded-full border-4 border-t-blue-300 animate-spin"></span>
                    loading...
                </div>
            </div>
        </template>
        <template v-if="results.length > 0">
            <div class="grid gap-4 grid-cols-6 mt-4">
                <template v-for="result in results" :key="result.id">
                    <div class="relative w-full">
                        <p class="absolute inset-x-0 bottom-0 bg-black text-white p-4">{{ result.name }}</p>
                        <div class="bg-black p-4 absolute left-0 top-0">
                            <component :is="result.type_icon" class="h-5 w-5 text-white"/>
                        </div>
                        <img :src="result.image_url" :alt="result.name"/>
                    </div>
                </template>
            </div>
            <div class ="mt-4">
                <p><span v-text="results.length"/> Result(s)</p>
            </div>
        </template>
    </div>
</template>
