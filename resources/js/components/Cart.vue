<template>
    <div>
        <!-- Overlay cu efect de satin -->
        <transition
            enter-active-class="ease-out duration-500"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="ease-in duration-300"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="isOpen"
                class="fixed inset-0 z-40 bg-black/10 backdrop-blur-sm"
                @click="$emit('close')"
            ></div>
        </transition>

        <!-- Coșul cu design de lux -->
        <transition
            enter-active-class="transform transition ease-out duration-500"
            enter-from-class="translate-x-full"
            enter-to-class="translate-x-0"
            leave-active-class="transform transition ease-in duration-400"
            leave-from-class="translate-x-0"
            leave-to-class="translate-x-full"
        >
            <div
                v-if="isOpen"
                class="fixed inset-y-0 bg-gray-950 right-0 z-50 w-full max-w-md shadow-2xl flex flex-col border-l border-yellow-500/20"
            >
                <!-- Header cu detalii aurii -->
                <div class="flex justify-between items-center px-8 py-6 border-b border-yellow-500/10">
                    <h3 class="font-cinzel text-xl text-yellow-500">
                        <span class="block text-sm mb-1">Coș de cumpărături</span>
                        {{ items.length }} Articol{{ items.length !== 1 ? 'e' : '' }}
                    </h3>
                    <button
                        @click="$emit('close')"
                        class="text-yellow-500 hover:text-gold-300 transition-colors"
                    >
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Conținut principal -->
                <div class="flex-1 overflow-y-auto bg-gray-950">
                    <!-- Stări de încărcare/eroare -->
                    <div v-if="isLoading" class="p-8 text-center">
                        <div class="animate-pulse space-y-6">
                            <div class="h-24 bg-gold-900/20 rounded-lg"></div>
                            <div class="h-24 bg-gold-900/20 rounded-lg"></div>
                        </div>
                    </div>

                    <div v-else-if="error" class="p-8 text-center text-yellow-500">
                        ⚠️ Eroare la încărcare: {{ error }}
                    </div>

                    <!-- Listă produse -->
                    <div v-else class="divide-y divide-gold-900/30">
                        <div v-if="items.length === 0" class="p-12 text-center">
                            <div class="inline-block text-gold-500/60">
                                <svg class="w-16 h-16 mx-auto mb-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <p class="font-light text-yellow-500 text-sm">Coșul dumneavoastră așteaptă<br>compoziții excepționale</p>
                            </div>
                        </div>

                        <!-- Item produs -->
                        <div v-for="item in items" :key="item.id" class="group relative p-6 hover:bg-midnight-750 transition-colors">
                            <div class="flex gap-5">
                                <!-- Product image - now using actual image if available -->
                                <div class="relative flex-shrink-0">
                                    <img
                                        :src="item.image || 'https://img.freepik.com/premium-psd/fruit-perfume-bottle-mockup_23-2151411650.jpg?w=740'"
                                        class="w-24 h-24 object-cover rounded-lg shadow-lg border border-gold-900/20"
                                    >
                                    <div class="absolute inset-0 border-2 border-transparent group-hover:border-gold-500/30 rounded-lg transition-all"></div>
                                </div>

                                <!-- Product details - updated to match your cart structure -->
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-cinzel text-gold-300 mb-1">{{ item.name }}</h4>
                                    <p v-if="item.size" class="text-sm text-gold-500/80 mb-3">{{ item.size }} ml • {{ item.concentration || item.room_type }}</p>

                                    <!-- Quantity controls -->
                                    <div class="flex items-center gap-3 mb-4">
                                        <button
                                            @click="updateQuantity(item.id, item.quantity - 1)"
                                            class="w-8 h-8 flex items-center justify-center border border-gold-900/30 rounded-md hover:bg-gold-900/10 transition-colors text-gold-500/80 hover:text-gold-300"
                                            :disabled="item.quantity <= 1"
                                        >
                                            -
                                        </button>
                                        <span class="text-gold-300 w-6 text-center">{{ item.quantity }}</span>
                                        <button
                                            @click="updateQuantity(item.id, item.quantity + 1)"
                                            class="w-8 h-8 flex items-center justify-center border border-gold-900/30 rounded-md hover:bg-gold-900/10 transition-colors text-gold-500/80 hover:text-gold-300"
                                        >
                                            +
                                        </button>
                                    </div>

                                    <!-- Price and actions -->
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-yellow-500">{{ (item.quantity * item.price).toFixed(2) }} RON</span>
                                        <button
                                            @click="removeItem(item.id)"
                                            class="text-xs hover:text-yellow-500 hover:cursor-pointer uppercase tracking-widest text-gold-500/60 hover:text-gold-300 transition-colors"
                                        >
                                            Elimină
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total și Checkout -->
                <div class="p-6 bg-midnight-850/80 border-t border-yellow-500/20">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-sm uppercase tracking-widest text-yellow-500/80">Total</span>
                        <span class="font-cinzel text-xl text-yellow-500">{{ total.toFixed(2) }} RON</span>
                    </div>
                    <Link :href="route('cart.view')" class="w-full cursor-pointer block text-yellow-500 py-4 hover:cursor-pointer font-cinzel uppercase tracking-widest text-sm transition-all transform hover:scale-105 border-yellow-500 border text-center">
                        Finalizează Comanda
                    </Link>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: { Link },
    props: {
        isOpen: Boolean,
        items: {
            type: Array,
            default: () => []
        },
        isLoading: Boolean,
        error: String
    },
    methods: {
        updateQuantity(productId, newQuantity) {
            if(newQuantity < 1) return;
            this.$emit('update-quantity', {
                id: productId,
                quantity: newQuantity
            });
        },
        removeItem(productId) {
            this.$emit('remove-item', productId);
        }
    },
    computed: {
        total() {
            console.log(this.items)
            return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        }
    }
}
</script>



