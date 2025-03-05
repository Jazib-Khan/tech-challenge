<script setup lang="ts">
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import Card from '@/components/Card.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const props = defineProps<{
    name?: string;
    items: Array;
    search?: string;
}>();

const searchQuery = ref(props.search || '');

// Watch for changes in searchQuery and make a request
watch(searchQuery, (newQuery) => {
    router.get('/dashboard', { search: newQuery }, { preserveState: true, replace: true });
});
</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="[{ title: 'Dashboard', href: '/dashboard' }]">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="p-6 bg-white rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Search items..."
                    class="mt-2 w-full p-2 border rounded-md text-gray-500"
                />
            </div>

            <div class="p-6 bg-white rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <h3 class="text-2xl text-gray-500">Latest Items</h3>
                <div v-if="items.length" class="grid gap-4 grid-cols-6 mt-4">
                    <Card v-for="item in items" :key="item.id" :item="item" />
                </div>
                <p v-else class="text-gray-500 mt-4">No items found.</p>
            </div>
        </div>
    </AppLayout>
</template>
