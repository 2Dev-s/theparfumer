<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import VueEasyLightbox from 'vue-easy-lightbox';
import { Button } from '@/components/ui/button';

const props = defineProps<{
    perfume: Array<string>;
    relatedParfumes?: Array<{
        id: number;
        name: string;
        slug: string;
        brand: {
            name: string;
        };
        price: number;
        size: number;
        media: Array<{
            original_url: string;
            preview_url?: string;
        }>;
    }>;
}>();

const visibleRef = ref(false);
const indexRef = ref(0);

// Use actual product images or fallback to placeholders
const imgsRef = computed(() => {
    if (props.perfume.media && props.perfume.media.length > 0) {
        return props.perfume.media.map((media) => ({
            src: media.original_url,
            thumb: media.preview_url || media.original_url,
        }));
    }
    return [
        { src: 'https://img.freepik.com/premium-psd/fruit-perfume-bottle-mockup_23-2151411650.jpg?w=740' },
        { src: 'https://img.freepik.com/premium-psd/logo-mockup-luxury-perfume-bottle_206274-276.jpg?w=740' },
        { src: 'https://img.freepik.com/premium-psd/perfume-bottle-sand_23-2148961294.jpg?w=740' },
    ];
});

const showLightbox = (index: number) => {
    indexRef.value = index;
    visibleRef.value = true;
};
</script>

<template>
    <Head :title="perfume.name" />

    <AppLayout>
        <section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-gray-950">
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    class="h-full w-full object-cover opacity-10"
                    src="https://videos.pexels.com/video-files/4154241/4154241-uhd_2732_1440_25fps.mp4"
                ></video>
                <div class="inset-0"></div>
            </div>

            <div class="relative z-10 w-full py-12">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Product Grid -->
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12 xl:gap-16">
                        <!-- Main Product Image -->
                        <div class="relative overflow-hidden rounded-lg shadow-xl">
                            <img
                                :src="imgsRef[0].src"
                                alt="Luxury Perfume"
                                class="h-auto max-h-[600px] w-full cursor-zoom-in object-cover"
                                @click="showLightbox(0)"
                            />
                            <div class="mt-6 grid grid-cols-3 gap-4">
                                <div
                                    v-for="(thumb, index) in imgsRef"
                                    :key="index"
                                    class="cursor-pointer overflow-hidden rounded-lg border-2 border-transparent transition-all duration-200 hover:border-amber-500"
                                    @click="showLightbox(index)"
                                >
                                    <img :src="thumb.thumb || thumb.src" alt="Thumbnail" class="h-24 w-full object-cover" />
                                </div>
                            </div>
                            <!-- Badge Collection -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="font-cinzel cursor-default rounded bg-black/80 px-3 py-1 text-center text-xs font-bold tracking-wide text-white uppercase"
                                >
                                    PARFUMER
                                </span>
                            </div>
                        </div>
                        <!-- Product Details -->
                        <div class="flex flex-col">
                            <div class="flex-1">
                                <!-- Nume și Brand -->
                                <div class="mb-6">
                                    <h1 class="font-cinzel mb-2 text-3xl tracking-wider text-white md:text-4xl lg:text-5xl">
                                        {{ perfume.name }}
                                    </h1>
                                    <h2 class="font-cinzel mb-4 text-xl text-amber-400/80 italic">oferit de {{ perfume.brand.name }}</h2>
                                    <div class="mb-6 h-px w-24 bg-gradient-to-r from-amber-500/50 to-transparent"></div>
                                </div>

                                <!-- Concentrație și Stoc -->
                                <div class="mb-8 flex items-center gap-6">
                                    <div class="relative" v-if="perfume.concentration">
                                        <span class="font-cinzel text-sm tracking-widest text-amber-400 uppercase">
                                            {{ perfume.concentration }}
                                        </span>
                                        <div class="absolute right-0 -bottom-1 left-0 h-px bg-amber-500/30"></div>
                                    </div>

                                    <div
                                        class="flex items-center"
                                        :class="{
                                            'text-gray-300': perfume.stock > 0,
                                            'text-gray-400': perfume.stock === 0,
                                        }"
                                    >
                                        <span
                                            :class="{
                                                'mr-2 h-2 w-2 animate-pulse rounded-full': true,
                                                'bg-green-400': perfume.stock > 10,
                                                'bg-yellow-400': perfume.stock <= 10 && perfume.stock > 0,
                                                'bg-red-400': perfume.stock === 0,
                                            }"
                                        ></span>
                                        <span class="text-xs tracking-wider uppercase">
                                            {{ perfume.stock > 0 ? (perfume.stock > 10 ? 'In Stoc' : 'Stoc Limitat') : 'Stoc Epuizat' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Descriere -->
                                <p class="mb-10 leading-relaxed font-light text-gray-300/90 italic">"{{ perfume.description }}"</p>

                                <!-- Preț -->
                                <div class="mb-10">
                                    <p class="font-cinzel mb-2 text-2xl text-amber-400">{{ perfume.price }} RON</p>
                                    <p class="text-sm text-gray-400">
                                        {{ perfume.size }} ml • {{ Math.round((perfume.price / perfume.size) * 100) / 100 }} RON/ml
                                    </p>
                                </div>

                                <!-- Piramida de Note - Versiune Lux -->
                                <div class="mb-10">
                                    <div class="my-6 flex items-center md:my-10">
                                        <div class="h-px flex-grow bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
                                        <span
                                            class="font-cinzel mx-3 px-2 text-sm tracking-widest text-amber-400 sm:mx-6 sm:px-4 sm:text-base md:text-xl"
                                        >
                                            DETALII
                                        </span>
                                        <div class="h-px flex-grow bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
                                    </div>

                                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                                        <div v-if="perfume.fragrance_notes" class="group relative">
                                            <div class="absolute -inset-1 rounded-lg bg-amber-500/10 opacity-0 transition-opacity duration-300"></div>
                                            <div class="relative h-full p-4">
                                                <h4 class="font-cinzel mb-3 text-xl tracking-widest text-amber-400 uppercase">Note</h4>
                                                <span class="text-md font-cinzel text-gray-300 capitalize">{{ perfume.fragrance_notes }} Ore</span>
                                            </div>
                                        </div>

                                        <div v-if="perfume.duration_hours" class="group relative">
                                            <div class="absolute -inset-1 rounded-lg bg-amber-500/10 opacity-0 transition-opacity duration-300"></div>
                                            <div class="relative h-full p-4">
                                                <h4 class="font-cinzel mb-3 text-xl tracking-widest text-amber-400 uppercase">Duratie</h4>
                                                <span class="text-md font-cinzel text-gray-300 capitalize">{{ perfume.duration_hours }} Ore</span>
                                            </div>
                                        </div>

                                        <div v-if="perfume.room_type" class="group relative">
                                            <div class="absolute -inset-1 rounded-lg bg-amber-500/10 opacity-0 transition-opacity duration-300"></div>
                                            <div class="relative h-full p-4">
                                                <h4 class="font-cinzel mb-3 text-xl tracking-widest text-amber-400 uppercase">Tipul camerei</h4>
                                                <span class="text-md font-cinzel text-gray-300 capitalize">{{ perfume.room_type }} Ore</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add to Cart Button -->
                            <div class="relative mt-8 flex w-full flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <!-- Add to Cart Button -->
                                <button
                                    :class="[
                                        'font-cinzel flex-1 bg-amber-500 px-6 py-3 text-center font-bold tracking-wider text-black uppercase transition-colors duration-300 hover:cursor-pointer',
                                        perfume.stock > 0 ? 'hover:bg-amber-600' : 'cursor-not-allowed bg-gray-500',
                                    ]"
                                    :disabled="perfume.stock <= 0"
                                    @click="perfume.stock > 0 && addToCart(perfume)"
                                >
                                    {{ perfume.stock > 0 ? 'Adaugă în coș' : 'Stoc epuizat' }}
                                </button>

                                <!-- Add to Favorites Button -->
                                <button
                                    @click="toggleFavourite(perfume)"
                                    :class="[
                                        'font-cinzel flex-1 px-6 py-3 text-center text-xs font-bold tracking-wide uppercase transition-all hover:scale-105 hover:cursor-pointer sm:text-sm',
                                        localFavourite
                                            ? 'bg-amber-500 text-black hover:bg-amber-600'
                                            : 'bg-black text-white hover:bg-white hover:text-black',
                                    ]"
                                >
                                    {{ localFavourite ? 'Favorit' : 'Adaugă la favorite' }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Related Products Section -->
                    <div class="mt-24">
                        <h3 v-if="relatedParfumes && relatedParfumes.length > 0" class="font-cinzel mb-8 text-center text-2xl text-white md:text-3xl">
                            S-ar putea să îți placă și
                        </h3>
                        <div
                            v-if="relatedParfumes && relatedParfumes.length > 0"
                            class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
                        >
                            <div
                                v-for="perfume in relatedParfumes"
                                :key="perfume.id"
                                class="group relative overflow-hidden rounded-xl transition-all duration-500"
                                data-aos="fade-in"
                                data-aos-delay="300"
                            >
                                <div class="relative overflow-hidden">
                                    <!-- Main Product Image -->
                                    <a :href="route('perfume.show', perfume.slug)" class="block overflow-hidden">
                                        <img
                                            :src="
                                                perfume.media?.[0]?.original_url ||
                                                'https://img.freepik.com/premium-psd/fruit-perfume-bottle-mockup_23-2151411650.jpg?w=740'
                                            "
                                            alt="Luxury Perfume"
                                            class="h-80 w-full object-cover transition-transform duration-700 group-hover:scale-105"
                                        />
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                                        ></div>
                                    </a>

                                    <!-- Exclusive Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="font-cinzel cursor-default bg-black px-3 py-1 text-center text-xs font-bold tracking-wide text-white uppercase"
                                            >PARFUMER</span
                                        >
                                    </div>

                                    <div class="absolute top-4 right-4">
                                        <button
                                            @click="addToCart(perfume)"
                                            class="font-cinzel bg-black px-3 py-1 text-center text-xs font-bold tracking-wide text-white uppercase transition-all hover:scale-105 hover:cursor-pointer hover:bg-white hover:text-black"
                                        >
                                            ADAUGĂ ÎN COȘ
                                        </button>
                                    </div>
                                </div>

                                <!-- Product Details -->
                                <div class="mt-5 px-4 pb-4 text-center">
                                    <h1 class="font-cinzel mb-1 text-lg font-bold tracking-wider text-white">
                                        {{ perfume.name }}
                                    </h1>
                                    <h2 class="font-cinzel mb-2 text-sm tracking-wider text-gray-400">
                                        {{ perfume.brand.name }}
                                    </h2>
                                    <div class="flex items-center justify-center space-x-4">
                                        <span class="font-cinzel text-sm tracking-wider text-amber-400">{{ perfume.size }} ml</span>
                                        <span class="text-gray-500">|</span>
                                        <span class="font-cinzel text-sm tracking-wider text-white">{{ perfume.price }} RON</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-else class="py-12 text-center">
                            <p class="font-cinzel text-lg text-yellow-500 italic">Momentan nu avem recomandări disponibile.</p>
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

        <vue-easy-lightbox :visible="visibleRef" :imgs="imgsRef" :index="indexRef" @hide="visibleRef = false"></vue-easy-lightbox>
    </AppLayout>
</template>

<script lang="ts">
import eventBus from '@/lib/event-bus';
import axios from 'axios';

export default {
    props: {
        perfume: Object,
        relatedParfumes: Array,
        is_favourite: Boolean,
    },
    data() {
        return {
            localFavourite: this.is_favourite,
        };
    },
    methods: {
        addToCart(perfum) {
            eventBus.emit('add-to-cart', perfum);
        },

        async toggleFavourite(perfume) {
            try {
                console.log(this.localFavourite);
                // Optimistic update
                this.localFavourite = !this.localFavourite;

                const response = await axios.post(`/perfumes/${perfume.slug}/favourite`, {
                    type: 'perfume',
                });

                // Adjust based on backend response
                this.localFavourite = response.data.status !== 'removed';

                eventBus.emit('add-favourite', perfume);
            } catch (error) {
                console.error('Error toggling favorite:', error);
                // Revert on error
                this.localFavourite = !this.localFavourite;
            }
        },
    },
};
</script>
