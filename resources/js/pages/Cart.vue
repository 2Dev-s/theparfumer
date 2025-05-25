<template>
    <AppLayout>
        <Head title="Cos" />

        <div class="min-h-screen pb-20">
            <div class="relative h-screen-90 flex items-center justify-center overflow-hidden" >
                <div class="relative z-10 text-center px-4" data-aos="fade-in" data-aos-delay="300">
                    <h1 class="font-cinzel text-5xl md:text-7xl text-amber-200 mb-6">
                        <span class="block text-xl  text-amber-500/80 mb-4">Coșul Tău Exclusiv</span>
                        COLECȚIA TA DE LUX
                    </h1>
                    <div class="border-t border-amber-500/30 w-24 mx-auto my-8"></div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 md:mt-12">
                <!-- Cart Container -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Product List -->
                    <div class="lg:col-span-2">
                        <!-- Luxury Card -->
                        <div
                            class="backdrop-blur-sm border border-amber-900/20 rounded-xl p-6 md:p-8 bg-[hsl(0_0%_3.9%)] shadow-xl">
                            <h2 class="font-cinzel text-2xl md:text-3xl text-amber-200 mb-6 flex items-center">
                                <svg class="w-8 h-8 mr-3 text-amber-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Produsele Tale
                            </h2>

                            <!-- Empty State -->
                            <div v-if="!products || products.length === 0" class="text-center py-12">
                                <svg class="w-16 h-16 mx-auto text-amber-500/50 mb-4" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M20 7h-4a4 4 0 00-8 0H4" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M5.5 7l1.6 11.4a2 2 0 002 1.6h5.8a2 2 0 002-1.6L18.5 7" />
                                </svg>
                                <h3 class="font-cinzel text-xl text-amber-300 mb-2">Coșul tău este gol</h3>
                                <p class="text-amber-400/70 mb-6">Începe să adaugi produse de lux pentru a-ți completa
                                    colecția</p>
                                <Link :href="route('perfumes')"
                                      class="font-cinzel cursor-pointer inline-flex items-center px-6 py-3 border border-amber-500/50 text-amber-200 hover:bg-amber-500/10 rounded-full transition-all">
                                    Descoperă Colecția
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5l7 7-7 7" />
                                    </svg>
                                </Link>
                            </div>

                            <!-- Product List -->
                            <div v-else class="divide-y divide-amber-900/20">
                                <div v-for="(product, index) in products" :key="index"
                                     class="py-6 first:pt-0 last:pb-0">
                                    <div class="flex flex-col md:flex-row gap-6">
                                        <!-- Product Image -->
                                        <div
                                            class="w-full md:w-32 h-32 flex-shrink-0 rounded-lg overflow-hidden border border-amber-900/20">
                                            <img
                                                :src="product.image || 'https://img.freepik.com/premium-psd/perfume-bottle-mockup_439185-2579.jpg'"
                                                class="w-full h-full object-cover"
                                                :alt="product.name">
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h3 class="font-cinzel text-lg text-amber-200">{{ product.name
                                                        }}</h3>
                                                    <p class="text-amber-500/80 text-sm mt-1">{{ product.concentration
                                                        }} •
                                                        {{ product.size }} ml</p>
                                                </div>
                                                <p class="font-cinzel text-amber-300">{{ formatPrice(product.price)
                                                    }}</p>
                                            </div>

                                            <div class="mt-4 flex items-center justify-between">
                                                <!-- Quantity Selector -->
                                                <div
                                                    class="flex items-center border border-amber-900/30 rounded-full overflow-hidden">
                                                    <button @click="updateQuantity(product.id, product.quantity - 1)"
                                                            class="px-3 py-1 text-amber-400 hover:bg-amber-900/20 transition-colors"
                                                            :disabled="product.quantity <= 1">
                                                        -
                                                    </button>
                                                    <span class="px-4 text-amber-200">{{ product.quantity }}</span>
                                                    <button @click="updateQuantity(product.id, product.quantity + 1)"
                                                            class="px-3 py-1 text-amber-400 hover:bg-amber-900/20 transition-colors">
                                                        +
                                                    </button>
                                                </div>

                                                <!-- Remove Button -->
                                                <button @click="removeItem(product.id)"
                                                        class="text-amber-500/70 hover:text-amber-300 transition-colors flex items-center">
                                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="1.5"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span class="text-sm">Elimină</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div>
                        <!-- Luxury Summary Card -->
                        <div
                            class="sticky top-6 backdrop-blur-sm border border-amber-900/20 rounded-xl p-6 md:p-8 bg-[hsl(0_0%_3.9%)] shadow-xl">
                            <h2 class="font-cinzel text-2xl md:text-3xl text-amber-200 mb-6 flex items-center">
                                <svg class="w-8 h-8 mr-3 text-amber-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12a2 2 0 01-2 2H6a2 2 0 01-2-2L5 9z" />
                                </svg>
                                Sumar Comandă
                            </h2>

                            <div class="space-y-4">
                                <!-- Subtotal -->
                                <div class="flex justify-between text-amber-300/90">
                                    <span>Subtotal</span>
                                    <span>{{ formatPrice(subtotal) }}</span>
                                </div>

                                <!-- Shipping -->
                                <div class="flex justify-between text-amber-300/90">
                                    <span>Livrare</span>
                                    <span>{{ formatPrice(shipping) }}</span>
                                </div>

                                <!-- Divider -->
                                <div class="border-t border-amber-900/20 my-4"></div>

                                <!-- Total -->
                                <div class="flex justify-between font-cinzel text-lg text-amber-200">
                                    <span>Total</span>
                                    <span>{{ formatPrice(total) }}</span>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <button @click="proceedToCheckout"
                                    class="mt-8 w-full font-cinzel tracking-wider bg-gradient-to-r from-amber-500/10 to-amber-600/10 border border-amber-500/50 text-amber-200 hover:text-amber-100 px-6 py-4 rounded-full hover:bg-amber-500/20 transition-all group relative overflow-hidden">
                                <div class="relative z-10">FINALIZEAZĂ COMANDA</div>
                                <span class="absolute inset-0 bg-gradient-to-r from-amber-500/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            </button>

                            <!-- Continue Shopping -->
                            <Link :href="route('perfumes')"
                                  class="mt-4 flex items-center justify-center text-amber-500/80 hover:text-amber-300 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                                </svg>
                                Continuă cumpărăturile
                            </Link>

                            <!-- Security Note -->
                            <div class="mt-6 p-3 bg-amber-900/10 rounded-lg border border-amber-900/20">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 mt-0.5 text-amber-400 flex-shrink-0" fill="none"
                                         stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <p class="ml-2 text-xs text-amber-500/80">Plata securizată și criptată. Datele tale
                                        sunt
                                        protejate.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import eventBus from '@/lib/event-bus';
import axios from 'axios';

export default {
    components: { Head, Link, AppLayout },
    props: {
        products: Array
    },
    computed: {
        subtotal() {
            return this.products.reduce((sum: number, product: any) => sum + (product.price * product.quantity), 0);
        },
        shipping() {
            return this.subtotal > 500 ? 0 : 50;
        },
        total() {
            return this.subtotal + this.shipping;
        }
    },
    methods: {
        formatPrice(price: number) {
            return new Intl.NumberFormat('ro-RO', {
                style: 'currency',
                currency: 'RON',
                minimumFractionDigits: 2
            }).format(price);
        },
        updateQuantity(productId, quantity) {
            if (quantity < 1) return;

            eventBus.emit('cart-updated', { id: productId, quantity });
            setTimeout(() => {
                window.location.reload();
            }, 100);
        },
        removeItem(productId) {
            eventBus.emit('remove-item', productId);
            setTimeout(() => {
                window.location.reload();
            }, 100);
        },
        async proceedToCheckout() {
            try {
                const response = await axios.post(route('checkout.create'), {
                    products: this.products.map(p => ({
                        price_id: p.price_id,
                        quantity: p.quantity
                    }))
                });

                if (response.data.url) {
                    window.location.href = response.data.url;
                }
            } catch (error) {
                console.error('Checkout error:', error);
            }
        }
    }
};
</script>

<style scoped>
/* Custom animations */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

@keyframes spin-reverse {
    to {
        transform: rotate(-360deg);
    }
}

.animate-spin {
    animation: spin 2s linear infinite;
}

.animate-spin-reverse {
    animation: spin-reverse 3s linear infinite;
}

.h-screen-90 {
    height: 30vh;
}
</style>
