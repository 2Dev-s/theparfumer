<template>
    <nav :class="{ 'sticky top-0 z-50 w-full shadow': true, 'bg-gray-950': !isSettingsPage }">
        <div class="mx-auto max-w-7xl px-6 py-6 xl:px-8">
            <div class="flex items-center justify-between">
                <!-- Logo Lux -->
                <Link :href="route('home')" class="group flex items-center">
                    <div class="relative" data-aos="fade-in" data-aos-delay="500">
                        <span class="font-cinzel text-3xl font-bold tracking-wider text-yellow-500">PARFUMER</span>
                        <div
                            class="via-gold-500 absolute inset-x-0 -bottom-2 h-px bg-gradient-to-r from-transparent to-transparent opacity-50 transition-opacity group-hover:opacity-100"
                        ></div>
                    </div>
                </Link>

                <!-- Meniu Desktop - Auriu -->
                <div class="hidden space-x-10 lg:flex">
                    <Link
                        v-for="(item, index) in menuItems"
                        :key="index"
                        :href="item.href"
                        data-aos="fade-in"
                        :data-aos-delay="100 * (index + 1)"
                        class="group relative text-white transition-all duration-300 hover:scale-105"
                    >
                        <span class="text-sm font-light tracking-widest uppercase">{{ item.label }}</span>
                        <div
                            class="bg-gold-500/30 absolute right-0 -bottom-1.5 left-0 h-px origin-left scale-x-0 transform transition-transform duration-500 group-hover:scale-x-100"
                        ></div>
                    </Link>
                </div>

                <!-- Iconuri Dreapta - Diamante -->
                <div class="flex items-center" data-aos="fade-in" data-aos-delay="500">
                    <!-- User Dropdown (shown when logged in) -->
                    <div v-if="$page.props.auth.user" class="group relative hidden lg:block">
                        <button class="rounded-full p-2 transition-all duration-300 hover:scale-105 hover:cursor-pointer">
                            <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            class="invisible absolute right-0 z-50 mt-2 w-48 border border-amber-800/30 bg-gray-950 py-1 opacity-0 backdrop-blur-sm transition-all duration-300 group-hover:visible group-hover:opacity-100"
                        >
                            <Link
                                :href="route('dashboard')"
                                class="font-cinzel block px-4 py-2 text-sm text-amber-200 transition-colors hover:bg-amber-900/20"
                            >
                                Profil
                            </Link>
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="font-cinzel w-full px-4 py-2 text-left text-sm text-amber-200 transition-colors hover:cursor-pointer hover:bg-amber-900/20"
                            >
                                Deconectare
                            </Link>
                        </div>
                    </div>

                    <!-- Regular User Button (shown when not logged in) -->
                    <Link v-else :href="route('login')" class="rounded-full p-2 transition-all duration-300 hover:scale-105 hover:cursor-pointer">
                        <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                    </Link>

                    <!-- Shopping Cart Button -->
                    <button @click="toggleCart" class="relative rounded-full p-2 transition-all duration-300 hover:scale-105 hover:cursor-pointer">
                        <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                            />
                        </svg>
                        <span
                            class="bg-gold-500 absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full text-[10px] font-medium text-white"
                        >
                            {{ cartItems.length }}
                        </span>
                    </button>

                    <button
                        @click="toggleFavorites"
                        class="relative mr-2 rounded-full p-2 transition-all duration-300 hover:scale-105 hover:cursor-pointer"
                    >
                        <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                            />
                        </svg>
                        <span
                            v-if="favoriteItems.length > 0"
                            class="bg-gold-500 absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full text-[10px] font-medium text-white"
                        >
                            {{ favoriteItems.length }}
                        </span>
                    </button>

                    <!-- Hamburger Icon - Mobile -->
                    <button
                        @click="toggleMobileMenu"
                        v-if="!isMobileMenuOpen"
                        class="rounded-full p-2 text-yellow-500 transition-all duration-300 hover:scale-105 hover:cursor-pointer lg:hidden"
                    >
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                v-if="!isMobileMenuOpen"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
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
                <div v-show="isMobileMenuOpen" class="fixed inset-0 z-50 bg-gray-950/50 backdrop-blur-sm lg:hidden">
                    <div class="relative flex h-screen flex-col items-center justify-between overflow-y-auto p-6">
                        <!-- Close Button -->
                        <button
                            @click="toggleMobileMenu"
                            class="absolute top-6 right-6 text-yellow-500 transition-colors hover:text-yellow-300"
                            aria-label="Close menu"
                        >
                            <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <!-- Main Menu Items -->
                        <div class="flex w-full flex-1 flex-col items-center justify-center">
                            <div class="mx-auto w-full max-w-xs space-y-6">
                                <Link
                                    v-for="(item, index) in menuItems"
                                    :key="index"
                                    :href="item.href"
                                    @click="toggleMobileMenu"
                                    class="font-cinzel block py-3 text-center text-2xl text-white transition-colors duration-300 hover:text-yellow-300 sm:text-3xl"
                                    :class="{ 'border-b border-amber-800/30': index < menuItems.length - 1 }"
                                >
                                    {{ item.label }}
                                </Link>
                            </div>
                        </div>

                        <!-- Bottom Auth Buttons -->
                        <div class="mx-auto mb-24 w-full max-w-xs border-t border-amber-800/30 py-6">
                            <template v-if="$page.props.auth.user">
                                <Link
                                    :href="route('dashboard')"
                                    class="font-cinzel mb-4 block text-center text-lg text-amber-200 transition-colors hover:text-amber-300"
                                >
                                    Profil
                                </Link>
                                <Link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    class="font-cinzel block w-full text-center text-lg text-amber-200 transition-colors hover:text-amber-300"
                                >
                                    Deconectare
                                </Link>
                            </template>
                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="font-cinzel mb-4 block text-center text-lg text-amber-200 transition-colors hover:text-amber-300"
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

        <Favourite
            :isOpen="isFavoritesOpen"
            :items="favoriteItems"
            :isLoading="favoritesLoading"
            @close="isFavoritesOpen = false"
            @remove-item="removeFavorite"
        />
    </nav>
</template>

<script>
import Cart from '@/components/Cart.vue';
import eventBus from '@/lib/event-bus.js';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import Favourite from '@/components/Favourite.vue';

export default {
    components: { Favourite, Link, Cart },
    data() {
        return {
            isMobileMenuOpen: false,
            isCartOpen: false,
            isLoading: false,

            isFavoritesOpen: false,
            favoriteItems: [],
            favoritesLoading: false,

            menuItems: [
                { label: 'Colecții', href: '/perfumes' },
                { label: 'FEMEI', href: '/perfumes?collection=female' },
                { label: 'BARBATI', href: '/perfumes?collection=male' },
                { label: 'UNISEX', href: '/perfumes?collection=unisex' },
                { label: 'Ambient', href: '/perfumes?collection=unisex' },
                { label: 'Seturi', href: '/perfumes?collection=unisex' },
            ],

            cartItems: [],
        };
    },
    computed: {
        isSettingsPage() {
            const path = window.location.pathname;
            return path.includes('settings') || path.includes('cart/view');
        },
    },
    mounted() {
        this.fetchCart();
        this.fetchFavorites();
    },
    created() {
        eventBus.on('add-to-cart', this.addToCart);
        eventBus.on('cart-updated', this.handleUpdateQuantity);
        eventBus.on('remove-item', this.handleRemoveItem);
        eventBus.on('add-favourite', this.toggleFavorites);
    },
    beforeUnmount() {
        eventBus.off('add-to-cart', this.addToCart);
        eventBus.off('cart-updated', this.handleUpdateQuantity);
        eventBus.off('remove-item', this.handleRemoveItem);
        eventBus.off('add-favourite', this.toggleFavorites);
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
                const response = await axios.post('/cart/add', {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    price_id: product.price_id,
                    image: product.media?.[0]?.original_url,
                    size: product.size,
                    concentration: product.concentration,
                });

                this.cartItems = Array.isArray(response.data.cart) ? response.data.cart : Object.values(response.data.cart || {});

                this.isCartOpen = true;
            } catch (error) {
                console.error('Error adding to cart:', error);
            }
        },
        async fetchFavorites() {
            this.favoritesLoading = true;
            try {
                const response = await axios.get('/favorites');
                this.favoriteItems = response.data;
            } catch (error) {
                console.error('Error fetching favorites:', error);
            } finally {
                this.favoritesLoading = false;
            }
        },

        async removeFavorite(perfumeId) {
            try {
                await axios.post(`/perfumes/${perfumeId}/favourite`);
                this.favoriteItems = this.favoriteItems.filter(item => item.id !== perfumeId);
            } catch (error) {
                console.error('Error removing favorite:', error);
            }
        },

        toggleFavorites() {
            this.isFavoritesOpen = !this.isFavoritesOpen;
            if (this.isFavoritesOpen) {
                this.fetchFavorites();
            }
        },

        toggleCart() {
            this.isCartOpen = !this.isCartOpen;
            if (this.isMobileMenuOpen) this.toggleMobileMenu();
        },
    },
};
</script>
