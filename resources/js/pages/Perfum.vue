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
        return props.perfume.media.map(media => ({
            src: media.original_url,
            thumb: media.preview_url || media.original_url
        }));
    }
    return [
        { src: 'https://img.freepik.com/premium-psd/fruit-perfume-bottle-mockup_23-2151411650.jpg?w=740' },
        { src: 'https://img.freepik.com/premium-psd/logo-mockup-luxury-perfume-bottle_206274-276.jpg?w=740' },
        { src: 'https://img.freepik.com/premium-psd/perfume-bottle-sand_23-2148961294.jpg?w=740' }
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
        <section class="relative min-h-screen bg-gray-950 flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    class="w-full h-full object-cover opacity-10"
                    src="https://videos.pexels.com/video-files/4154241/4154241-uhd_2732_1440_25fps.mp4"
                ></video>
                <div class="inset-0"></div>
            </div>

            <div class="relative z-10 w-full py-12">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Product Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 xl:gap-16">
                        <!-- Main Product Image -->
                        <div class="relative overflow-hidden rounded-lg shadow-xl">
                            <img
                                :src="imgsRef[0].src"
                                alt="Luxury Perfume"
                                class="w-full h-auto object-cover max-h-[600px] cursor-zoom-in"
                                @click="showLightbox(0)"
                            />
                            <div class="mt-6 grid grid-cols-3 gap-4">
                                <div
                                    v-for="(thumb, index) in imgsRef"
                                    :key="index"
                                    class="cursor-pointer border-2 border-transparent hover:border-amber-500 transition-all duration-200 rounded-lg overflow-hidden"
                                    @click="showLightbox(index)"
                                >
                                    <img
                                        :src="thumb.thumb || thumb.src"
                                        alt="Thumbnail"
                                        class="w-full h-24 object-cover"
                                    />
                                </div>
                            </div>
                            <!-- Badge Collection -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="font-cinzel cursor-default text-white text-center bg-black/80 px-3 py-1 text-xs font-bold uppercase tracking-wide rounded">
                                    PARFUMER
                                </span>
                            </div>
                        </div>
                        <!-- Product Details -->
                        <div class="flex flex-col">

                            <div class="flex-1">
                                <!-- Nume și Brand -->
                                <div class="mb-6">
                                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-cinzel text-white mb-2 tracking-wider">
                                        {{ perfume.name }}
                                    </h1>
                                    <h2 class="text-xl font-cinzel text-amber-400/80 mb-4 italic">
                                        oferit de {{ perfume.brand.name }}
                                    </h2>
                                    <div class="w-24 h-px bg-gradient-to-r from-amber-500/50 to-transparent mb-6"></div>
                                </div>

                                <!-- Concentrație și Stoc -->
                                <div class="flex items-center gap-6 mb-8">
                                    <div class="relative">
                                        <span class="font-cinzel text-amber-400 text-sm uppercase tracking-widest">
                                            {{ perfume.concentration }}
                                        </span>
                                        <div class="absolute -bottom-1 left-0 right-0 h-px bg-amber-500/30"></div>
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
                                              'w-2 h-2 rounded-full mr-2 animate-pulse': true,
                                              'bg-green-400': perfume.stock > 10,
                                              'bg-yellow-400': perfume.stock <= 10 && perfume.stock > 0,
                                              'bg-red-400': perfume.stock === 0,
                                            }"
                                          ></span>
                                            <span
                                                class="text-xs uppercase tracking-wider"
                                            >
                                            {{ perfume.stock > 0 ? (perfume.stock > 10 ? 'In Stoc' : 'Stoc Limitat') : 'Stoc Epuizat' }}
                                          </span>
                                    </div>

                                </div>

                                <!-- Descriere -->
                                <p class="text-gray-300/90 mb-10 leading-relaxed font-light italic">
                                    "{{ perfume.description }}"
                                </p>

                                <!-- Preț -->
                                <div class="mb-10">
                                    <p class="text-amber-400 font-cinzel text-2xl mb-2">
                                        {{ perfume.price }} RON
                                    </p>
                                    <p class="text-gray-400 text-sm">
                                        {{ perfume.size }} ml • {{ Math.round(perfume.price / perfume.size * 100) / 100
                                        }} RON/ml
                                    </p>
                                </div>

                                <!-- Piramida de Note - Versiune Lux -->
                                <div class="mb-10">
                                    <div class="flex items-center my-6 md:my-10">
                                        <div
                                            class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
                                        <span
                                            class="mx-3 sm:mx-6 font-cinzel text-amber-400 text-sm sm:text-base md:text-xl tracking-widest px-2 sm:px-4">
                                            COMPOZIȚIA AROMATICĂ
                                        </span>
                                        <div
                                            class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <!-- Note de Vârf -->
                                        <div v-if="perfume.top_notes" class="group relative">
                                            <div
                                                class="absolute -inset-1 bg-amber-500/10 rounded-lg opacity-0 transition-opacity duration-300"></div>
                                            <div class="relative h-full p-4">
                                                <h4 class="font-cinzel text-amber-400 text-xl uppercase tracking-widest mb-3">
                                                    Note de Vârf</h4>
                                                <ul class="space-y-2">
                                                    <li v-for="note in perfume.top_notes.split(',')"
                                                        :key="`top-${note}`"
                                                        class="flex items-center">
                                                        <span class="w-1 h-1 bg-amber-400 rounded-full mr-2"></span>
                                                        <span
                                                            class="text-gray-300 text-md capitalize font-cinzel">{{ note.trim()
                                                            }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Note de Inimă -->
                                        <div v-if="perfume.middle_notes" class="group relative">
                                            <div
                                                class="absolute -inset-1 bg-amber-500/10 rounded-lg opacity-0 transition-opacity duration-300"></div>
                                            <div class="relative h-full p-4">
                                                <h4 class="font-cinzel text-amber-400 text-xl uppercase tracking-widest mb-3">
                                                    Note de Inimă</h4>
                                                <ul class="space-y-2">
                                                    <li v-for="note in perfume.middle_notes.split(',')"
                                                        :key="`middle-${note}`"
                                                        class="flex items-center">
                                                        <span class="w-1 h-1 bg-amber-400 rounded-full mr-2"></span>
                                                        <span
                                                            class="text-gray-300 text-md capitalize font-cinzel">{{ note.trim()
                                                            }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Note de Bază -->
                                        <div v-if="perfume.base_notes" class="group relative">
                                            <div
                                                class="absolute -inset-1 bg-amber-500/10 rounded-lg opacity-0 transition-opacity duration-300"></div>
                                            <div class="relative h-full p-4">
                                                <h4 class="font-cinzel text-amber-400 text-xl uppercase tracking-widest mb-3">
                                                    Note de Bază</h4>
                                                <ul class="space-y-2">
                                                    <li v-for="note in perfume.base_notes.split(',')"
                                                        :key="`base-${note}`"
                                                        class="flex items-center">
                                                        <span class="w-1 h-1 bg-amber-400 rounded-full mr-2"></span>
                                                        <span
                                                            class="text-gray-300 text-md capitalize font-cinzel">{{ note.trim()
                                                            }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add to Cart Button -->
                            <div class="relative w-full flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8">

                                <!-- Add to Cart Button -->
                                <button
                                    :class="[
                                        'flex-1 hover:cursor-pointer bg-amber-500 text-black font-bold font-cinzel py-3 px-6 uppercase tracking-wider transition-colors duration-300 text-center',
                                        perfume.stock > 0 ? 'hover:bg-amber-600' : 'bg-gray-500 cursor-not-allowed'
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
                                        'flex-1 font-cinzel text-center hover:cursor-pointer hover:scale-105 transition-all px-6 py-3 text-xs sm:text-sm font-bold uppercase tracking-wide',
                                        localFavourite
                                            ? 'bg-amber-500 hover:bg-amber-600 text-black'
                                            : 'bg-black hover:bg-white hover:text-black text-white'
                                    ]"
                                    >
                                    {{ localFavourite ? 'Favorit' : 'Adaugă la favorite' }}
                                </button>

                            </div>
                        </div>
                    </div>

                    <!-- Related Products Section -->
                    <div class="mt-24">
                        <h3 v-if="relatedParfumes && relatedParfumes.length > 0"
                            class="text-2xl md:text-3xl font-cinzel text-white mb-8 text-center">
                            S-ar putea să îți placă și
                        </h3>
                        <div v-if="relatedParfumes && relatedParfumes.length > 0"
                             class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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
                                            :src="perfume.media?.[0]?.original_url || 'https://img.freepik.com/premium-psd/fruit-perfume-bottle-mockup_23-2151411650.jpg?w=740'"
                                            alt="Luxury Perfume"
                                            class="w-full h-80 object-cover transition-transform duration-700 group-hover:scale-105"
                                        />
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    </a>

                                    <!-- Exclusive Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="font-cinzel cursor-default text-white text-center bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">PARFUMER</span>
                                    </div>

                                    <div class="absolute top-4 right-4">
                                        <button @click="addToCart(perfume)"
                                                class="font-cinzel text-white text-center hover:cursor-pointer hover:scale-105 transition-all hover:bg-white hover:text-black bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">
                                            ADAUGĂ ÎN COȘ
                                        </button>
                                    </div>
                                </div>

                                <!-- Product Details -->
                                <div class="mt-5 text-center px-4 pb-4">
                                    <h1 class="text-white text-lg font-cinzel font-bold tracking-wider mb-1">
                                        {{ perfume.name }}</h1>
                                    <h2 class="text-gray-400 text-sm font-cinzel tracking-wider mb-2">
                                        {{ perfume.brand.name }}</h2>
                                    <div class="flex items-center justify-center space-x-4">
                                        <span class="text-amber-400 font-cinzel text-sm tracking-wider">{{ perfume.size
                                            }} ml</span>
                                        <span class="text-gray-500">|</span>
                                        <span class="text-white font-cinzel text-sm tracking-wider">{{ perfume.price }} RON</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-else class="text-center py-12">
                            <p class="font-cinzel text-yellow-500 text-lg italic">Momentan nu avem recomandări
                                disponibile.</p>
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

        <vue-easy-lightbox
            :visible="visibleRef"
            :imgs="imgsRef"
            :index="indexRef"
            @hide="visibleRef = false"
        ></vue-easy-lightbox>
    </AppLayout>
</template>

<script lang="ts">
import eventBus from '@/lib/event-bus';
import axios from 'axios';

export default {
    props: {
        perfume: Object,
        relatedParfumes: Array,
        is_favourite: Boolean
    },
    data() {
        return {
            localFavourite: this.is_favourite
        };
    },
    methods: {
        addToCart(perfum) {
            eventBus.emit('add-to-cart', perfum);
        },

        async toggleFavourite(perfume) {
            try {
                // Optimistic update
                this.localFavourite = !this.localFavourite;

                const response = await axios.post(`/perfumes/${perfume.slug}/favourite`, {
                    type: 'perfume'
                });

                // Adjust based on backend response
                this.localFavourite = response.data.status !== 'removed';
            } catch (error) {
                console.error('Error toggling favorite:', error);
                // Revert on error
                this.localFavourite = !this.localFavourite;
            }
        }
    }
};

</script>
