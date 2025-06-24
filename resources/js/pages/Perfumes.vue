<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
</script>

<template>
    <Head title="Colecții" />

    <AppLayout>
        <section class="h-screen-90 relative flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    class="h-full w-full object-cover opacity-90"
                    src="https://videos.pexels.com/video-files/1705055/1705055-hd_1920_1080_30fps.mp4"
                ></video>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            <div class="relative z-10 px-4 text-center" data-aos="fade-in" data-aos-delay="300">
                <h1 class="font-cinzel mb-6 text-5xl text-amber-200 md:text-7xl">
                    <span class="mb-4 block text-xl text-amber-500/80">PARFUMURI EXCLUSIVE</span>
                    Descoperă colecția
                </h1>
                <div class="mx-auto my-8 w-24 border-t border-amber-500/30"></div>
                <p class="font-cinzel mx-auto max-w-2xl text-xl text-amber-100/80">Parfumuri unice, pentru cei cu gusturi rafinate.</p>
            </div>
        </section>

        <section class="min-h-screen bg-gray-950 py-12">
            <!-- Container Responsiv -->
            <div class="container mx-auto px-4">
                <form @submit.prevent="submit" class="mb-12">
                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                        <!-- Search Input (full width on mobile, spans 2 cols on sm, 3 cols on md, full width on lg) -->
                        <div class="sm:col-span-2 md:col-span-3 lg:col-span-2">
                            <input
                                v-model="filters.search"
                                type="text"
                                placeholder="Căutare parfum..."
                                class="font-cinzel w-full border border-yellow-500 bg-gray-950 px-4 py-3 hover:border-gray-400 focus:border-yellow-700 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                            />
                        </div>

                        <!-- Sort Select -->
                        <div>
                            <select
                                v-model="filters.sort"
                                class="font-cinzel w-full border border-yellow-500 bg-gray-950 px-4 py-3 hover:border-gray-400 focus:border-yellow-700 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                            >
                                <option value="">Sortează</option>
                                <option value="new_arrival">Cele mai noi</option>
                                <option value="price_asc">Preț: crescător</option>
                                <option value="price_desc">Preț: descrescător</option>
                            </select>
                        </div>

                        <!-- Sex Select -->
                        <div>
                            <select
                                v-model="filters.collection"
                                class="font-cinzel w-full border border-yellow-500 bg-gray-950 px-4 py-3 hover:border-gray-400 focus:border-yellow-700 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                            >
                                <option value="">Sortează după sex</option>
                                <option value="female">Femei</option>
                                <option value="male">Barbati</option>
                                <option value="unisex">Unisex</option>
                            </select>
                        </div>

                        <!-- Brand Select -->
                        <div>
                            <select
                                v-model="filters.brand"
                                class="font-cinzel w-full border border-yellow-500 bg-gray-950 px-4 py-3 hover:border-gray-400 focus:border-yellow-700 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                            >
                                <option value="">Brand</option>
                                <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
                            </select>
                        </div>

                        <!-- Category Select -->
                        <div>
                            <select
                                v-model="filters.category"
                                class="font-cinzel w-full border border-yellow-500 bg-gray-950 px-4 py-3 hover:border-gray-400 focus:border-yellow-700 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                            >
                                <option value="">Categorie</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>

                        <!-- Search Button (full width on mobile, spans all cols on larger screens) -->
                        <div class="sm:col-span-2 md:col-span-3 lg:col-span-1">
                            <button
                                type="submit"
                                data-aos="fade-in"
                                data-aos-delay="700"
                                class="font-cinzel flex w-full items-center justify-center gap-2 bg-amber-500 px-6 py-3 font-bold tracking-wider text-black uppercase transition-colors duration-300 hover:cursor-pointer hover:bg-amber-600"
                                tabindex="5"
                                :disabled="form.processing"
                            >
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                <span v-if="!form.processing">Caută</span>
                                <span v-else class="opacity-70">Se încarcă...</span>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="bg-gray-950 py-12" v-if="!perfumes || perfumes.length === 0" data-aos="fade-in" data-aos-delay="400">
                    <div class="font-cinzel px-6 py-12 text-center text-lg text-amber-500">
                        Momentan nu sunt parfumuri disponibile. Revenim în curând cu produse exclusiviste!
                    </div>
                </div>

                <!-- Sidebar filtrări -->
                <div class="w-full py-12" v-else>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        <div v-for="perfume in perfumes" :href="route('home')" :key="perfume.id" class="transition-all hover:scale-105">
                            <div class="relative overflow-hidden" data-aos="fade-in" data-aos-delay="300">
                                <a :href="route('perfume.show', perfume.slug)">
                                    <img :src="perfume.media?.[0]?.original_url" alt="Luxury Perfume" class="perfume-image" />
                                </a>

                                <!-- Badge Collection -->
                                <div class="absolute top-3 left-3">
                                    <span
                                        class="font-cinzel cursor-default bg-black px-3 py-1 text-center text-xs font-bold tracking-wide text-white uppercase"
                                        >PARFUMER</span
                                    >
                                </div>

                                <div class="absolute top-3 right-3">
                                    <button
                                        @click="addToCart(perfume)"
                                        class="font-cinzel bg-black px-3 py-1 text-center text-xs font-bold tracking-wide text-white uppercase transition-all hover:scale-105 hover:cursor-pointer hover:bg-white hover:text-black"
                                    >
                                        ADAUGĂ ÎN COȘ
                                    </button>
                                </div>

                                <div class="absolute right-3 bottom-3" v-if="!perfume.is_favorite">
                                    <button
                                        @click="toggleFavourite(perfume)"
                                        class="font-cinzel bg-black px-3 py-1 text-center text-xs font-bold tracking-wide text-white uppercase transition-all hover:scale-105 hover:cursor-pointer hover:bg-white hover:text-black"
                                    >
                                        ADAUGA LA FAVORITE
                                    </button>
                                </div>

                                <div v-else class="absolute right-3 bottom-3">
                                    <button
                                        @click="toggleFavourite(perfume)"
                                        class="font-cinzel bg-amber-500 bg-black px-3 py-1 text-center text-xs font-bold tracking-wide text-black text-white uppercase transition-all hover:scale-105 hover:cursor-pointer hover:bg-amber-600 hover:text-black"
                                    >
                                        FAVORIT
                                    </button>
                                </div>

                                <!-- Correct the method name and parameter typo in the button -->
                            </div>
                            <div class="mt-4 text-center">
                                <h1 class="font-cinzel text-lg font-bold text-white">{{ perfume.name }}</h1>
                                <h1 class="text-md font-cinzel text-gray-400">{{ perfume.brand.name }}</h1>
                                <div class="flex items-center justify-center space-x-4">
                                    <span class="font-cinzel text-sm tracking-wider text-amber-400">{{ perfume.size }} ml</span>
                                    <span class="text-gray-500">|</span>
                                    <div>
                                        <span
                                            v-if="perfume.price_old > perfume.price"
                                            class="font-cinzel ml-2 text-sm tracking-wider text-white line-through opacity-70"
                                        >
                                            {{ perfume.price_old }} RON
                                        </span>
                                        <span class="mx-2"></span>
                                        <span class="font-cinzel text-sm tracking-wider text-white"> {{ perfume.price }}.00 RON </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="relative bg-[url('https://img.freepik.com/premium-psd/perfume-bottle-sand_23-2148961294.jpg?w=740')] bg-cover bg-fixed bg-center py-32"
        >
            <div class="absolute inset-0 bg-gradient-to-b from-black/85 via-black/70 to-black/90"></div>

            <div class="relative z-10 mx-auto max-w-5xl px-6 lg:px-8">
                <div class="mb-16 text-center">
                    <h2 class="mt-6 mb-4 font-serif text-4xl text-amber-100" data-aos="zoom-in-up" data-aos-delay="300">
                        <span class="font-cinzel block">Acces Exclusiv</span>
                        <span class="font-cinzel text-amber-300">Pentru Cunoscători</span>
                    </h2>
                    <div class="mx-auto my-6 w-24 border-t border-amber-500/30" data-aos="zoom-in-up" data-aos-delay="300"></div>
                    <p class="mx-auto max-w-2xl text-lg text-amber-200/80" data-aos="zoom-in-up" data-aos-delay="300">
                        Abonează-te la newsletter-ul nostru pentru a primi invitații la lansări private, istorii despre ingrediente rare și oferte
                        personalizate.
                    </p>
                </div>

                <div class="mx-auto mt-12 max-w-md">
                    <form class="space-y-6" data-aos="zoom-in-up" data-aos-delay="300">
                        <div class="relative">
                            <input
                                type="email"
                                placeholder="Adresa ta de email"
                                class="font-cinzel w-full border-0 border-b border-amber-500/30 bg-transparent px-0 py-4 font-light tracking-widest text-amber-100 placeholder-amber-500/50 transition-all duration-300 focus:border-amber-300 focus:ring-0"
                            />
                            <div class="absolute bottom-0 left-0 h-px w-0 bg-amber-300 transition-all duration-500 group-focus-within:w-full"></div>
                        </div>

                        <div class="flex items-center justify-center space-x-4 pt-4">
                            <button
                                type="submit"
                                class="group relative overflow-hidden rounded-full border border-amber-500/50 bg-transparent px-10 py-3 font-serif text-sm tracking-widest text-amber-200 transition-all hover:cursor-pointer hover:bg-amber-500/10"
                            >
                                <span class="font-cinzel relative z-10 font-bold">ABONEAZĂ-TE</span>
                                <span
                                    class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                                ></span>
                            </button>
                        </div>
                    </form>

                    <p class="font-cinzel mx-auto mt-8 max-w-xs text-center text-xs text-amber-500/60" data-aos="zoom-in-up" data-aos-delay="300">
                        Vă promitem să nu vă inundăm inboxul. Doar conținut exclusiv, la fiecare lună.
                    </p>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script lang="ts">
import eventBus from '@/lib/event-bus';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

export default {
    props: {
        perfumes: Array,
        brands: Array,
        categories: Array,
    },
    data() {
        return {
            filters: {
                search: '',
                sort: '',
                collection: '',
                brand: '',
                category: '',
            },
            form: useForm(this.filters),
            isFavourite: '',
        };
    },
    methods: {
        submit() {
            const parfumeCollection = ref<HTMLElement | null>(null);

            const cleanParams = Object.entries(this.filters).reduce((acc, [key, value]) => {
                if (value && value !== '') {
                    acc[key] = value;
                }
                return acc;
            }, {});

            const queryParams = new URLSearchParams(cleanParams).toString();
            const url = queryParams ? `${route('perfumes')}?${queryParams}` : route('perfumes');

            this.form.post(url, {
                onSuccess: () => {
                    if (parfumeCollection.value) {
                        parfumeCollection.value.scrollIntoView({ behavior: 'smooth' });
                    }
                },
                onError: (errors) => {
                    console.error(errors);
                },
            });
        },

        addToCart(perfum) {
            eventBus.emit('add-to-cart', perfum);
        },

        async toggleFavourite(perfume) {
            try {
                // Optimistically update UI
                const index = this.perfumes.findIndex((p) => p.id === perfume.id);
                this.perfumes[index].is_favorite = !this.perfumes[index].is_favorite;

                // Make API call
                const response = await axios.post(`/perfumes/${perfume.slug}/favourite`, {
                    type: 'perfume'
                });

                // Sync with actual response if needed
                if (response.data.status === 'removed') {
                    this.perfumes[index].is_favorite = false;
                } else {
                    this.perfumes[index].is_favorite = true;
                }

                console.log(response.data);
                eventBus.emit('add-favourite', perfume);
            } catch (error) {
                console.error('Error toggling favorite:', error);
                // Revert UI on error
                const index = this.perfumes.findIndex((p) => p.id === perfume.id);
                this.perfumes[index].is_favorite = !this.perfumes[index].is_favorite;
            }
        },
    },
};
</script>

<style scoped>
body {
    font-family: 'Georgia', serif;
}

.h-screen-90 {
    height: 45vh;
}

.perfume-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    display: block;
    margin: 0 auto;
}
</style>
