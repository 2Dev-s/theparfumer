<template>
    <div>
        <!-- Overlay with satin effect -->
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

        <!-- Favourites panel -->
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
                class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md flex-col border-l border-amber-500/20 bg-gray-950 shadow-2xl"
            >
                <!-- Header -->
                <div class="flex items-center justify-between border-b border-amber-500/10 px-8 py-6">
                    <h3 class="font-cinzel text-xl text-amber-500">
                        <span class="mb-1 block text-sm">Lista ta de favorite</span>
                        {{ items.length }} Articol{{ items.length !== 1 ? 'e' : '' }}
                    </h3>
                    <button
                        @click="$emit('close')"
                        class="text-amber-500 transition-colors hover:text-amber-300"
                    >
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Main content -->
                <div class="flex-1 overflow-y-auto bg-gray-950">
                    <!-- Loading/error states -->
                    <div v-if="isLoading" class="p-8 text-center">
                        <div class="space-y-6 animate-pulse">
                            <div class="h-24 rounded-lg bg-amber-900/20"></div>
                            <div class="h-24 rounded-lg bg-amber-900/20"></div>
                        </div>
                    </div>

                    <div v-else-if="error" class="p-8 text-center text-amber-500">
                        ⚠️ Eroare la încărcare: {{ error }}
                    </div>

                    <!-- Product list -->
                    <div v-else class="divide-y divide-amber-900/30">
                        <div v-if="items.length === 0" class="p-12 text-center">
                            <div class="inline-block text-amber-500/60">
                                <svg class="mx-auto mb-4 h-16 w-16 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <p class="text-sm font-light text-amber-500">Lista ta de favorite așteaptă<br>compoziții excepționale</p>
                            </div>
                        </div>

                        <!-- Product item -->
                        <div
                            v-for="item in items"
                            :key="item.id"
                            class="group relative p-6 transition-colors hover:bg-gray-900/10"
                        >
                            <div class="flex gap-5">
                                <!-- Product image -->
                                <div class="relative flex-shrink-0">
                                    <img
                                        :src="item.media?.[0]?.original_url || 'https://img.freepik.com/premium-psd/fruit-perfume-bottle-mockup_23-2151411650.jpg?w=740'"
                                        class="h-24 w-24 rounded-lg border border-amber-900/20 object-cover shadow-lg"
                                    >
                                    <div class="absolute inset-0 rounded-lg border-2 border-transparent transition-all group-hover:border-amber-500/30"></div>
                                </div>

                                <!-- Product details -->
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-cinzel text-amber-300 mb-1">{{ item.name }}</h4>
                                    <p class="mb-3 text-sm text-amber-500/80">{{ item.brand?.name }}</p>
                                    <p class="mb-4 font-medium text-amber-500">{{ item.price }} RON</p>

                                    <!-- Actions -->
                                    <div class="flex items-center justify-between">
                                        <Link
                                            :href="route('perfume.show', item.slug)"
                                            class="text-xs uppercase tracking-widest text-amber-500/60 transition-colors hover:cursor-pointer hover:text-amber-300"
                                        >
                                            Vezi detalii
                                        </Link>
                                        <button
                                            @click="$emit('remove-item', item.id)"
                                            class="text-xs uppercase tracking-widest text-amber-500/60 transition-colors hover:cursor-pointer hover:text-amber-300"
                                        >
                                            Elimină
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="border-t border-amber-500/20 bg-gray-900/30 p-6">
                    <Link
                        :href="route('perfumes')"
                        class="block w-full cursor-pointer border border-amber-500 py-4 text-center font-cinzel text-sm uppercase tracking-widest text-amber-500 transition-all hover:cursor-pointer hover:scale-105"
                    >
                        Caută parfumuri
                    </Link>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    isOpen: Boolean,
    items: {
        type: Array,
        default: () => []
    },
    isLoading: Boolean,
    error: String
});

defineEmits(['close', 'remove-item']);
</script>
