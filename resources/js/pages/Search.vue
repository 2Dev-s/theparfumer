<template>
    <Head title="Caută Parfumuri" />

    <AppLayout>
        <!-- Hero Section pentru Căutare -->
        <div class="relative h-screen-90 flex items-center justify-center bg-gray-900 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="w-full h-full bg-gradient-to-br from-gray-900 via-purple-900 to-amber-900 opacity-90"></div>
            </div>

            <div class="relative z-10 text-center px-4 w-full max-w-4xl" data-aos="fade-in" data-aos-delay="300">
                <h1 class="font-cinzel text-4xl md:text-6xl text-amber-200 mb-8">
                    <span class="block text-xl text-amber-500/80 mb-4">EXPLOREAZĂ COLECȚIA</span>
                    Găsește Parfumul Perfect
                </h1>

                <!-- Formular de căutare -->
                <form @submit.prevent="handleSearch" class="mt-8">
                    <div class="relative">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Caută după nume, brand sau note..."
                            class="w-full bg-gray-800/70 border border-amber-500/30 text-amber-100 placeholder-amber-500/50 rounded-full py-4 px-6 pr-12 focus:border-amber-300 focus:ring-0 font-serif tracking-wider transition-all duration-300"
                        >
                        <button
                            type="submit"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-amber-400 hover:text-amber-300 transition-colors"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="border-t border-amber-500/30 w-24 mx-auto my-8"></div>
                <p class="text-xl font-cinzel text-amber-100/80 max-w-2xl mx-auto">
                    Descoperă esențe care se potrivesc personalității tale
                </p>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';

interface Perfume {
    id: number;
    name: string;
    price: number;
    slug: string;
    media: Array<{ original_url: string }>;
    brand: {
        name: string;
    };
    topNotes?: Array<{
        id: number;
        name: string;
        icon: string;
    }>;
}

interface Props {
    recommendedPerfumes: Perfume[];
    searchResults?: Perfume[];
    initialSearchQuery?: string;
}

const props = defineProps<Props>();

const searchQuery = ref(props.initialSearchQuery || '');
const showResults = ref(!!props.initialSearchQuery);

const filteredPerfumes = computed(() => {
    if (!searchQuery.value) return [];

    const query = searchQuery.value.toLowerCase();
    return props.recommendedPerfumes.filter(perfume => {
        return (
            perfume.name.toLowerCase().includes(query) ||
            perfume.brand.name.toLowerCase().includes(query) ||
            (perfume.topNotes?.some(note => note.name.toLowerCase().includes(query)))
        );
    });
});

const handleSearch = () => {
    if (searchQuery.value.trim()) {
        // Redirecționează către /perfumes?search=query
        router.visit(`/perfumes?search=${encodeURIComponent(searchQuery.value)}`);
        showResults.value = true;
    }
};
</script>

<style scoped>
.h-screen-90 {
    height: 93vh;
}
</style>
