<template>
    <nav class="sticky top-0 bg-gray-950 w-full z-50 shadow">
        <div class="max-w-7xl mx-auto px-6 xl:px-8 py-6">
            <div class="flex justify-between items-center">
                <!-- Logo Lux -->
                <Link :href="route('home')" class="flex items-center group">
                    <div class="relative" data-aos="fade-in" data-aos-delay="500">
                        <span class="font-cinzel text-3xl font-bold text-yellow-500 tracking-wider">PARFUMÉR</span>
                        <div
                            class="absolute -bottom-2 inset-x-0 h-px bg-gradient-to-r from-transparent via-gold-500 to-transparent opacity-50 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                </Link>

                <!-- Meniu Desktop - Auriu -->
                <div class="hidden lg:flex space-x-10">
                    <Link
                        v-for="(item, index) in menuItems"
                        :key="index"
                        :href="item.href"
                        data-aos="fade-in"
                        :data-aos-delay="100 * (index + 1)"
                        class="relative text-white hover:scale-105 transition-all duration-300 group"
                    >
                        <span class="text-sm uppercase tracking-widest font-light">{{ item.label }}</span>
                        <div
                            class="absolute -bottom-1.5 left-0 right-0 h-px bg-gold-500/30 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500">
                        </div>
                    </Link>

                </div>

                <!-- Iconuri Dreapta - Diamante -->
                <div class="flex items-center space-x-6" data-aos="fade-in" data-aos-delay="500">
                    <button @click="toggleCart"
                            class="relative p-2 hover:cursor-pointer hover:scale-105 rounded-full transition-all duration-300">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span
                            class="absolute -top-1 -right-1 bg-gold-500 text-[10px] text-white w-5 h-5 rounded-full flex items-center justify-center font-medium">
                            {{ cartItems.length }}
                        </span>
                    </button>

                    <!-- Hamburger Icon - Mobil -->
                    <button @click="toggleMobileMenu" v-if="!isMobileMenuOpen"
                            class="lg:hidden p-2 hover:cursor-pointer text-yellow-500 hover:scale-105 rounded-full transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <transition
                enter-active-class="transition-all duration-500 ease-out"
                leave-active-class="transition-all duration-300 ease-in"
                enter-from-class="opacity-0 -translate-y-4"
                enter-to-class="opacity-100 translate-y-0"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-4"
            >
                <div v-show="isMobileMenuOpen" class="lg:hidden fixed inset-0 z-50 bg-gray-900">
                    <div class="container h-screen flex flex-col justify-center items-center relative">
                        <div class="absolute top-8 right-8">
                            <button @click="toggleMobileMenu" class="text-yellow-500 hover:text-yellow-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-8 text-center">
                            <Link v-for="(item, index) in menuItems" :key="index" :href="item.href"
                               class="block text-3xl font-cinzel text-white hover:text-yellow-300 transition-colors duration-300">
                                {{ item.label }}
                            </Link>
                        </div>

                        <div class="absolute bottom-12 text-yellow-500 text-sm">
                            PARFUMÉR
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <!-- Componenta Cart Redesign -->
        <Cart
            :isOpen="isCartOpen"
            :items="cartItems"
            @close="isCartOpen = false"
            @update-quantity="handleUpdateQuantity"
            @remove-item="handleRemoveItem"
        />
    </nav>
</template>

<script>
import Cart from '@/components/Cart.vue';
import axios from 'axios';
import { Link } from '@inertiajs/vue3';
import eventBus from '@/lib/event-bus.js';

export default {
    components: { Link, Cart },
    data() {
        return {
            isMobileMenuOpen: false,
            isCartOpen: false,
            isLoading: false,
            menuItems: [
                { label: 'Colecții', href: '/perfumes' },
                { label: 'Amestec Privat', href: '#amestec-privat' },
                { label: 'Boutique-uri', href: '#boutique-uri' },
                { label: 'Lumea PARFUMÉR', href: '#lumea-parfumer' },
                { label: 'Contact', href: '#contact' }
            ],

            cartItems: []
        };
    },
    mounted() {
        this.fetchCart();
    },
    created() {
        eventBus.on('add-to-cart', this.addToCart);
    },
    beforeUnmount() {
        eventBus.off('add-to-cart', this.addToCart);
    },
    methods: {
        toggleMobileMenu() {
            this.isMobileMenuOpen = !this.isMobileMenuOpen;
            document.body.style.overflow = this.isMobileMenuOpen ? 'hidden' : 'auto';
        },

        async fetchCart() {
            try {
                this.isLoading = true;
                const response = await axios.get('/cart');
                this.cartItems = response.data.cart;
            } catch (error) {
                console.error('Error fetching cart:', error);
            } finally {
                this.isLoading = false;
            }
        },

        async handleUpdateQuantity({ id, quantity }) {
            try {
                const response = await axios.put(`/cart/update/${id}`, { quantity });
                this.cartItems = response.data.cart;
            } catch (error) {
                console.error('Error updating quantity:', error);
            }
        },

        async handleRemoveItem(productId) {
            try {
                const response = await axios.delete(`/cart/remove/${productId}`);
                this.cartItems = response.data.cart;
            } catch (error) {
                console.error('Error removing item:', error);
            }
        },

        async addToCart(product) {
            try {
                const response = await axios.post('/cart/add', product);
                this.cartItems = response.data.cart;
                this.isCartOpen = true;
            } catch (error) {
                console.error('Error adding to cart:', error);
            }
        },

        toggleCart() {
            this.isCartOpen = !this.isCartOpen;
            if (this.isMobileMenuOpen) this.toggleMobileMenu();
        }
    }
};
</script>


<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600&display=swap');

.font-cinzel {
    font-family: 'Cinzel', serif;
}
</style>
