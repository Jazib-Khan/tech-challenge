<script setup lang="ts">
import { BookOpen, Download, ExternalLink, Trash, FileText } from 'lucide-vue-next';
import { defineEmits } from 'vue';

const props = defineProps<{
    item: {
        id: number;
        name: string;
        description: string;
        content_type: string;
        type_icon: string;
        image_url: string;
    }
}>();

const emit = defineEmits(['delete']);

const iconMap = {
    "book-open": BookOpen,
    "download": Download,
    "external-link": ExternalLink,
    "info": FileText
};
</script>

<template>
    <div class="relative w-full bg-white border rounded-lg shadow-md overflow-hidden group">
        <!-- Item Image -->
        <img
            class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
            :src="item.image_url"
            :alt="item.name"
        />

        <!-- Item Details Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-white p-4 text-center">
            <h4 class="text-lg font-semibold mb-2">{{ item.name }}</h4>
            <p class="text-sm mb-2 line-clamp-3">{{ item.description }}</p>
            <p class="text-xs bg-gray-700 px-2 py-1 rounded">Type: {{ item.content_type }}</p>
        </div>

        <!-- Item Type Icon -->
        <div class="bg-black p-4 absolute left-0 top-0">
            <component
                :is="iconMap[item.type_icon] || FileText"
                class="h-5 w-5 text-white"
            />
        </div>

        <!-- Delete Button -->
        <button
            class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors"
            @click="emit('delete', item.id)"
        >
            <Trash class="w-4 h-4"/>
        </button>

        <!-- Item Name -->
        <p class="absolute inset-x-0 bottom-0 bg-black text-white p-4 text-center">
            {{ item.name }}
        </p>
    </div>
</template>
