<template>
    <nav :class="{'sticky top-0 w-full z-50 shadow': true, 'bg-gray-950': !isSettingsPage}">
        <div class="max-w-7xl mx-auto px-6 xl:px-8 py-6">
            <div class="flex justify-between items-center">
                <!-- Logo Lux -->
                <Link :href="route('home')" class="flex items-center group">
                    <div class="relative" data-aos="fade-in" data-aos-delay="500">
                        <span class="font-cinzel text-3xl font-bold text-yellow-500 tracking-wider">PARFUMER</span>
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
                <div class="flex items-center" data-aos="fade-in" data-aos-delay="500">
                    <!-- User Dropdown (shown when logged in) -->
                    <div v-if="$page.props.auth.user" class="relative group hidden lg:block">
                        <button class="p-2 hover:cursor-pointer hover:scale-105 rounded-full transition-all duration-300">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-gray-950 backdrop-blur-sm border border-amber-800/30 py-1 z-50 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <Link :href="route('dashboard')" class="font-cinzel block px-4 py-2 text-sm text-amber-200 hover:bg-amber-900/20 transition-colors">
                                Profil
                            </Link>
                            <Link :href="route('logout')" method="post" as="button" class="font-cinzel hover:cursor-pointer w-full text-left px-4 py-2 text-sm text-amber-200 hover:bg-amber-900/20 transition-colors">
                                Deconectare
                            </Link>
                        </div>
                    </div>

                    <!-- Regular User Button (shown when not logged in) -->
                    <Link v-else :href="route('login')" class="p-2 hover:cursor-pointer hover:scale-105 rounded-full transition-all duration-300">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </Link>

                    <!-- Shopping Cart Button -->
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

                    <!-- Hamburger Icon - Mobile -->
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
                <div v-show="isMobileMenuOpen" class="lg:hidden fixed inset-0 z-50 bg-gray-950/50 backdrop-blur-sm">
                    <div class="h-screen flex flex-col justify-between items-center p-6 relative overflow-y-auto">
                        <!-- Close Button -->
                        <button
                            @click="toggleMobileMenu"
                            class="absolute top-6 right-6 text-yellow-500 hover:text-yellow-300 transition-colors"
                            aria-label="Close menu"
                        >
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <!-- Main Menu Items -->
                        <div class="flex-1 flex flex-col justify-center items-center w-full">
                            <div class="space-y-6 w-full max-w-xs mx-auto">
                                <Link
                                    v-for="(item, index) in menuItems"
                                    :key="index"
                                    :href="item.href"
                                    @click="toggleMobileMenu"
                                    class="block py-3 text-2xl sm:text-3xl font-cinzel text-white hover:text-yellow-300 transition-colors duration-300 text-center"
                                    :class="{ 'border-b border-amber-800/30': index < menuItems.length - 1 }"
                                >
                                    {{ item.label }}
                                </Link>
                            </div>
                        </div>

                        <!-- Bottom Auth Buttons -->
                        <div class="w-full max-w-xs mx-auto py-6 mb-24 border-t border-amber-800/30">
                            <template v-if="$page.props.auth.user">
                                <Link
                                    :href="route('dashboard')"
                                    class="block mb-4 font-cinzel text-lg text-amber-200 hover:text-amber-300 transition-colors text-center"
                                >
                                    Profil
                                </Link>
                                <Link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    class="block w-full font-cinzel text-lg text-amber-200 hover:text-amber-300 transition-colors text-center"
                                >
                                    Deconectare
                                </Link>
                            </template>
                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="block mb-4 font-cinzel text-lg text-amber-200 hover:text-amber-300 transition-colors text-center"
                                >
                                    Autentificare
                                </Link>
<!--                                <Link-->
<!--                                    :href="route('register')"-->
<!--                                    class="block w-full font-cinzel text-lg text-amber-200 hover:text-amber-300 transition-colors text-center"-->
<!--                                >-->
<!--                                    Înregistrare-->
<!--                                </Link>-->
                            </template>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <!-- Componenta Cart -->
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
                { label: 'FEMEI', href: '/perfumes?collection=female' },
                { label: 'BARBATI', href: '/perfumes?collection=male' },
                { label: 'UNISEX', href: '/perfumes?collection=unisex' },
            ],

            cartItems: []
        };
    },
    computed: {
        isSettingsPage() {
            const path = window.location.pathname;
            return path.includes('settings') || path.includes('cart/view');
        }
    },
    mounted() {
        this.fetchCart();
    },
    created() {
        eventBus.on('add-to-cart', this.addToCart);
        eventBus.on('cart-updated', this.handleUpdateQuantity);
        eventBus.on('remove-item', this.handleRemoveItem);
    },
    beforeUnmount() {
        eventBus.off('add-to-cart', this.addToCart);
        eventBus.off('cart-updated', this.handleUpdateQuantity);
        eventBus.off('remove-item', this.handleRemoveItem);
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
            console.log(productId);
            try {
                const response = await axios.delete(`/cart/remove/${productId}`);
                this.cartItems = response.data.cart;
            } catch (error) {
                console.error('Error removing item:', error);
            }
        },

        async addToCart(product) {
            try {
                const response = await axios.post('/cart/add', {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.media?.[0]?.original_url,
                    size: product.size,
                    concentration: product.concentration
                });

                // Make sure response.data.cart is an array
                this.cartItems = Array.isArray(response.data.cart)
                    ? response.data.cart
                    : Object.values(response.data.cart || {});

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
