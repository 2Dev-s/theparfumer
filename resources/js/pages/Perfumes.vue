<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
</script>

<template>
    <Head title="Colecții" />

    <AppLayout>
        <section class="relative h-screen-90 flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    class="w-full h-full object-cover opacity-90"
                    src="https://videos.pexels.com/video-files/1705055/1705055-hd_1920_1080_30fps.mp4"
                ></video>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            <div class="relative z-10 text-center px-4" data-aos="fade-in" data-aos-delay="300">
                <h1 class="font-cinzel text-5xl md:text-7xl text-amber-200 mb-6">
                    <span class="block text-xl text-amber-500/80 mb-4">PARFUMURI EXCLUSIVE</span>
                    Descoperă colecția
                </h1>
                <div class="border-t border-amber-500/30 w-24 mx-auto my-8"></div>
                <p class="text-xl font-cinzel text-amber-100/80 max-w-2xl mx-auto">
                    Parfumuri unice, pentru cei cu gusturi rafinate.
                </p>
            </div>
        </section>

        <section class="bg-gray-950 min-h-screen py-12">
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
                                class="w-full bg-gray-950 font-cinzel border border-yellow-500 focus:border-yellow-700 px-4 py-3 hover:border-gray-400 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                            />
                        </div>

                        <!-- Sort Select -->
                        <div>
                            <select
                                v-model="filters.sort"
                                class="w-full bg-gray-950 font-cinzel border border-yellow-500 focus:border-yellow-700 px-4 py-3 hover:border-gray-400 focus:ring-2 focus:ring-amber-500 focus:outline-none"
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
                                class="w-full bg-gray-950 font-cinzel border border-yellow-500 focus:border-yellow-700 px-4 py-3 hover:border-gray-400 focus:ring-2 focus:ring-amber-500 focus:outline-none"
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
                                class="w-full bg-gray-950 font-cinzel border border-yellow-500 focus:border-yellow-700 px-4 py-3 hover:border-gray-400 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                            >
                                <option value="">Brand</option>
                                <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
                            </select>
                        </div>

                        <!-- Category Select -->
                        <div>
                            <select
                                v-model="filters.category"
                                class="w-full bg-gray-950 font-cinzel border border-yellow-500 focus:border-yellow-700 px-4 py-3 hover:border-gray-400 focus:ring-2 focus:ring-amber-500 focus:outline-none"
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
                                class="w-full font-cinzel hover:cursor-pointer bg-amber-500 hover:bg-amber-600 text-black font-bold py-3 px-6 uppercase tracking-wider transition-colors duration-300 flex items-center justify-center gap-2"
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

                <div class="bg-gray-950 py-12" v-if="!perfumes || perfumes.length === 0" data-aos="fade-in"
                         data-aos-delay="400">
                    <div class="text-center text-amber-500 text-lg font-cinzel py-12 px-6">
                        Momentan nu sunt parfumuri disponibile. Revenim în curând cu produse exclusiviste!
                    </div>
                </div>

                <!-- Sidebar filtrări -->
                <div class="w-full py-12" v-else>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <div v-for="perfume in perfumes" :href="route('home')" :key="perfume.id"
                             class="hover:scale-105 transition-all">
                            <div class="relative overflow-hidden" data-aos="fade-in" data-aos-delay="300">
                                <a :href="route('perfume.show', perfume.slug)">
                                    <img
                                        :src="perfume.media?.[0]?.original_url "
                                        alt="Luxury Perfume"
                                        class="perfume-image"
                                    />
                                </a>

                                <!-- Badge Collection -->
                                <div class="absolute top-3 left-3">
                                    <span
                                        class="font-cinzel cursor-default text-white text-center bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">PARFUMER</span>
                                </div>

                                <div class="absolute top-3 right-3">
                                    <button @click="addToCart(perfume)"
                                            class="font-cinzel text-white text-center hover:cursor-pointer hover:scale-105 transition-all hover:bg-white hover:text-black bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">
                                        ADAUGĂ ÎN COȘ
                                    </button>
                                </div>

                                <div class="absolute bottom-3 right-3" v-if="perfume.is_favorite">
                                    <button
                                        @click="toggleFavourite(perfume)"
                                        class="font-cinzel text-white text-center hover:cursor-pointer hover:scale-105 transition-all hover:bg-white hover:text-black bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">
                                        ADAUGA LA FAVORITE
                                    </button>
                                </div>

                                <div v-else class="absolute bottom-3 right-3">
                                    <button
                                        @click="toggleFavourite(perfume)"
                                        class="font-cinzel text-white text-center hover:cursor-pointer hover:scale-105 transition-all bg-amber-500 text-black hover:bg-amber-600 hover:text-black bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">
                                        FAVORIT
                                    </button>
                                </div>

                                <!-- Correct the method name and parameter typo in the button -->

                            </div>
                            <div class="mt-4 text-center">
                                <h1 class="text-white text-lg font-cinzel font-bold">{{ perfume.name }}</h1>
                                <h1 class="text-gray-400 text-md font-cinzel">{{ perfume.brand.name }}</h1>
                                <div class="flex items-center justify-center space-x-4">
                                        <span class="text-amber-400 font-cinzel text-sm tracking-wider">{{ perfume.size
                                            }} ml</span>
                                    <span class="text-gray-500">|</span>
                                    <span class="text-white font-cinzel text-sm tracking-wider">{{ perfume.price
                                        }} RON</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="relative py-32 bg-[url('https://img.freepik.com/premium-psd/perfume-bottle-sand_23-2148961294.jpg?w=740')] bg-cover bg-fixed bg-center">
            <div class="absolute inset-0 bg-gradient-to-b from-black/85 via-black/70 to-black/90"></div>

            <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="font-serif text-4xl text-amber-100 mt-6 mb-4" data-aos="zoom-in-up" data-aos-delay="300">
                        <span class="block font-cinzel">Acces Exclusiv</span>
                        <span class="text-amber-300 font-cinzel">Pentru Cunoscători</span>
                    </h2>
                    <div class="border-t border-amber-500/30 w-24 mx-auto my-6" data-aos="zoom-in-up"
                         data-aos-delay="300"></div>
                    <p class="text-lg text-amber-200/80 max-w-2xl mx-auto" data-aos="zoom-in-up" data-aos-delay="300">
                        Abonează-te la newsletter-ul nostru pentru a primi invitații la lansări private,
                        istorii despre ingrediente rare și oferte personalizate.
                    </p>
                </div>

                <div class="mt-12 max-w-md mx-auto">
                    <form class="space-y-6" data-aos="zoom-in-up" data-aos-delay="300">
                        <div class="relative">
                            <input
                                type="email"
                                placeholder="Adresa ta de email"
                                class="w-full bg-transparent font-cinzel border-0 border-b border-amber-500/30 text-amber-100 placeholder-amber-500/50 focus:border-amber-300 focus:ring-0 py-4 px-0 font-light tracking-widest transition-all duration-300"
                            >
                            <div
                                class="absolute bottom-0 left-0 w-0 h-px bg-amber-300 transition-all duration-500 group-focus-within:w-full"></div>
                        </div>

                        <div class="flex items-center justify-center space-x-4 pt-4">
                            <button
                                type="submit"
                                class="relative hover:cursor-pointer overflow-hidden bg-transparent border border-amber-500/50 text-amber-200 px-10 py-3 rounded-full hover:bg-amber-500/10 transition-all font-serif tracking-widest text-sm group"
                            >
                                <span class="relative font-cinzel font-bold z-10">ABONEAZĂ-TE</span>
                                <span
                                    class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            </button>
                        </div>
                    </form>

                    <p class="text-xs text-amber-500/60 text-center mt-8 max-w-xs mx-auto font-cinzel"
                       data-aos="zoom-in-up" data-aos-delay="300">
                        Vă promitem să nu vă inundăm inboxul. Doar conținut exclusiv, la fiecare lună.
                    </p>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script lang="ts">
import { ref } from 'vue';
import eventBus from '@/lib/event-bus';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: {
        perfumes: Array,
        brands: Array,
        categories: Array
    },
    data() {
        return {
            filters: {
                search: '',
                sort: '',
                collection: '',
                brand: '',
                category: ''
            },
            form: useForm(this.filters),
            isFavourite: ''
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
                }
            });
        },

        addToCart(perfum) {
            eventBus.emit('add-to-cart', perfum);
        },

        async toggleFavourite(perfume) {
            try {
                // Optimistically update UI
                const index = this.perfumes.findIndex(p => p.id === perfume.id);
                this.perfumes[index].is_favorite = !this.perfumes[index].is_favorite;

                // Make API call
                const response = await axios.post(`/perfumes/${perfume.id}/favourite`);

                // Sync with actual response if needed
                if (response.data.status === 'removed') {
                    this.perfumes[index].is_favorite = false;
                } else {
                    this.perfumes[index].is_favorite = true;
                }
            } catch (error) {
                console.error('Error toggling favorite:', error);
                // Revert UI on error
                const index = this.perfumes.findIndex(p => p.id === perfume.id);
                this.perfumes[index].is_favorite = !this.perfumes[index].is_favorite;
            }
        }
    }
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
