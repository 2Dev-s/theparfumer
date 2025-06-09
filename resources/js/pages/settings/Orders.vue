<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { ref } from 'vue';

interface Order {
    id: number;
    order_number: string;
    status: string;
    total_amount: number;
    currency: string;
    created_at: string;
    products: Array<{
        id: number;
        name: string;
        price: number;
        quantity: number;
        image_url: string|null;
        concentration: string;
        size: string;
    }>;
}

interface Props {
    orders: Order[];
}

const props = defineProps<Props>();
const orders = ref<Order[]>(props.orders);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Setări profil',
        href: '/settings/profile',
    },
    {
        title: 'Comenzi',
        href: '/settings/orders',
    }
];

const formatPrice = (price: number) => {
    return new Intl.NumberFormat('ro-RO', { style: 'currency', currency: 'RON' }).format(price);
};

const getStatusColor = (status: string) => {
    switch (status.toLowerCase()) {
        case 'completed':
            return 'text-green-400';
        case 'processing':
            return 'text-amber-400';
        case 'canceled':
            return 'text-rose-400';
        case 'shipped':
            return 'text-blue-400';
        default:
            return 'text-gray-400';
    }
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Comenzile Mele" />

        <SettingsLayout>
            <div class="lg:col-span-2">
                <!-- Luxury Card -->
                <div class="backdrop-blur-sm border border-amber-900/20 rounded-xl p-6 md:p-8 bg-[hsl(0_0%_3.9%)] shadow-xl">
                    <h2 class="font-cinzel text-2xl md:text-3xl text-amber-200 mb-6 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Comenzile Tale
                    </h2>

                    <!-- Empty State -->
                    <div v-if="!orders || orders.length === 0" class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-amber-500/50 mb-4" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="font-cinzel text-xl text-amber-300 mb-2">Nu ai nicio comandă înregistrată</h3>
                        <p class="text-amber-400/70 mb-6">Descoperă colecția noastră de parfumuri exclusive</p>
                        <Link :href="route('perfumes')"
                              class="font-cinzel cursor-pointer inline-flex items-center px-6 py-3 border border-amber-500/50 text-amber-200 hover:bg-amber-500/10 rounded-full transition-all">
                            Descoperă Colecția
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </Link>
                    </div>

                    <!-- Orders List -->
                    <div v-else class="space-y-6">
                        <div v-for="order in orders" :key="order.id" class="border border-amber-900/20 rounded-lg overflow-hidden">
                            <!-- Order Header -->
                            <div class="bg-amber-900/10 p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div>
                                    <h3 class="font-cinzel text-amber-200">
                                        Comandă {{ order.order_number }}
                                    </h3>
                                    <p class="text-sm text-amber-500/80 mt-1">
                                        Plasată pe {{ order.created_at }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="font-cinzel text-amber-300">
                                        {{ formatPrice(order.total_amount) }}
                                    </span>
                                    <span :class="['text-sm font-medium', getStatusColor(order.status)]">
                                        {{ order.status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Order Products -->
                            <div class="divide-y divide-amber-900/20">
                                <div v-for="product in order.products" :key="product.id" class="p-4">
                                    <div class="flex gap-4">
                                        <!-- Product Image -->
                                        <div class="w-16 h-16 flex-shrink-0 rounded overflow-hidden border border-amber-900/20">
                                            <img :src="product.image_url || 'https://img.freepik.com/premium-psd/perfume-bottle-mockup_439185-2579.jpg'"
                                                 class="w-full h-full object-cover" :alt="product.name">
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <h4 class="font-cinzel text-amber-200">{{ product.name }}</h4>
                                            <p class="text-amber-500/80 text-sm mt-1">
                                                {{ product.concentration }} • {{ product.size }} ml
                                            </p>
                                            <p class="text-amber-300 text-sm mt-2">
                                                {{ formatPrice(product.price) }} × {{ product.quantity }}
                                            </p>
                                        </div>
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

<style scoped>
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
