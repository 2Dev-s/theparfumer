<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem, type SharedData } from '@/types';
import eventBus from '@/lib/event-bus';
import axios from 'axios';
import { ref } from 'vue';

interface Product {
    id: number;
    name: string;
    image: string;
    price: number;
    concentration: string;
    size: number;
    is_favorite: boolean;
}

interface Props {
    products: Product[];
}

const props = defineProps<Props>();
const products = ref<Product[]>(props.products);
const isLoading = ref<Record<number, boolean>>({});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Setări profil',
        href: '/settings/profile',
    },
    {
        title: 'Favorite',
        href: '/favorites',
    }
];

const formatPrice = (price: number) => {
    return new Intl.NumberFormat('ro-RO', { style: 'currency', currency: 'RON' }).format(price);
};

const addToCart = (product: Product) => {
    eventBus.emit('add-to-cart', product);
};

const toggleFavourite = async (product: Product) => {
    isLoading.value[product.id] = true;

    try {
        const originalState = product.is_favorite;
        product.is_favorite = !product.is_favorite;

        // Optimistic UI update
        if (!product.is_favorite) {
            products.value = products.value.filter(p => p.id !== product.id);
        }

        const response = await axios.post(`/perfumes/${product.id}/favourite`);

        // Sync with server response
        if (response.data.status === 'removed' && originalState) {
            products.value = products.value.filter(p => p.id !== product.id);
            console.log(1)
        } else if (response.data.status === 'added' && !originalState) {
            products.value = [...products.value, { ...product, is_favorite: true }];
        }

        // Optionally emit event to update other components
        window.location.reload();
    } catch (error) {
        console.error('Error toggling favorite:', error);
        // Revert UI on error
        product.is_favorite = originalState;
        if (product.is_favorite && !products.value.some(p => p.id === product.id)) {
            products.value = [...products.value, product];
        }
    } finally {
        isLoading.value[product.id] = false;
    }
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Favorite" />

        <SettingsLayout>
            <div class="lg:col-span-2">
                <!-- Luxury Card -->
                <div class="backdrop-blur-sm border border-amber-900/20 rounded-xl p-6 md:p-8 bg-[hsl(0_0%_3.9%)] shadow-xl">
                    <h2 class="font-cinzel text-2xl md:text-3xl text-amber-200 mb-6 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Favoritele Tale
                    </h2>

                    <!-- Empty State -->
                    <div v-if="!products || products.length === 0" class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-amber-500/50 mb-4" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <h3 class="font-cinzel text-xl text-amber-300 mb-2">Lista ta de favorite este goală</h3>
                        <p class="text-amber-400/70 mb-6">Adaugă produse la favorite pentru a le salva și vizualiza mai târziu</p>
                        <Link :href="route('perfumes')"
                              class="font-cinzel cursor-pointer inline-flex items-center px-6 py-3 border border-amber-500/50 text-amber-200 hover:bg-amber-500/10 rounded-full transition-all">
                            Descoperă Colecția
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>

                    <!-- Product List -->
                    <div v-else class="divide-y divide-amber-900/20">
                        <div v-for="product in products" :key="product.id" class="py-6 first:pt-0 last:pb-0">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Product Image -->
                                <div class="w-full md:w-32 h-32 flex-shrink-0 rounded-lg overflow-hidden border border-amber-900/20">
                                    <img :src="product.main_image_url || 'https://img.freepik.com/premium-psd/perfume-bottle-mockup_439185-2579.jpg'"
                                         class="w-full h-full object-cover" :alt="product.name">
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-cinzel text-lg text-amber-200">{{ product.name }}</h3>
                                            <p class="text-amber-500/80 text-sm mt-1">
                                                {{ product.concentration }} • {{ product.size }} ml
                                            </p>
                                        </div>
                                        <p class="font-cinzel text-amber-300">{{ formatPrice(product.price) }}</p>
                                    </div>

                                    <div class="mt-4 flex items-center justify-between">
                                        <!-- Add to Cart Button -->
                                        <button @click="addToCart(product)"
                                                class="font-cinzel text-sm px-4 py-2 bg-amber-600/20 hover:bg-amber-600/30 border border-amber-600/50 text-amber-200 rounded-full transition-colors">
                                            Adaugă în coș
                                        </button>

                                        <!-- Remove Button -->
                                        <button
                                            @click="toggleFavourite(product)"
                                            :disabled="isLoading[product.id]"
                                            class="text-amber-500/70 hover:text-amber-300 transition-colors flex items-center"
                                        >
                                            <svg
                                                v-if="!isLoading[product.id]"
                                                class="w-5 h-5 mr-1"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                />
                                            </svg>
                                            <span v-if="!isLoading[product.id]" class="text-sm">Elimină</span>
                                            <span v-else class="text-sm">Se încarcă...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<style>
/* Custom scrollbar for luxury feel */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #111827;
}

::-webkit-scrollbar-thumb {
    background: #b45309;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #d97706;
}
</style>
