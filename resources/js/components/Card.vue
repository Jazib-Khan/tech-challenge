<script setup lang="ts">
import { BookOpen, Download, ExternalLink, Trash } from 'lucide-vue-next';
import { defineEmits } from 'vue';

const props = defineProps<{
    item: object
}>();

const emit = defineEmits(['delete']);

const iconMap = {
    "book-open": BookOpen,
    "download": Download,
    "external-link": ExternalLink,
};
</script>

<template>
    <div class="relative w-full bg-white border rounded-lg shadow">
        <p class="absolute inset-x-0 bottom-0 bg-black text-white p-4">{{ item.name }}</p>
        <div class="bg-black p-4 absolute left-0 top-0">
            <component :is="iconMap[item.type_icon]" class="h-5 w-5 text-white"/>
        </div>
        <img class="w-full" :src="item.image_url" :alt="item.name" />
        <button
            class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full"
            @click="emit('delete', item.id)"
        >
            <Trash class="w-4 h-4"/>
        </button>
    </div>
</template>
