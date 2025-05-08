<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import VueEasyLightbox from 'vue-easy-lightbox';

const visibleRef = ref(false);
const indexRef = ref(0); // Indexul imaginii afișate

// Lista imaginilor (poți înlocui cu imaginile reale din produs)
const imgsRef = ref([
    { src: 'https://img.freepik.com/premium-psd/fruit-perfume-bottle-mockup_23-2151411650.jpg?w=740' },
    { src: 'https://img.freepik.com/premium-psd/logo-mockup-luxury-perfume-bottle_206274-276.jpg?w=740' },
    { src: 'https://img.freepik.com/premium-psd/perfume-bottle-sand_23-2148961294.jpg?w=740' }
]);

const showLightbox = (index: number) => {
    indexRef.value = index;
    visibleRef.value = true;
};
</script>

<template>
    <Head title="Haute Collection" />

    <AppLayout>
        <section class="relative min-h-screen bg-gray-950 flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
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
                                        :src="thumb.src"
                                        alt="Thumbnail"
                                        class="w-full h-24 object-cover"
                                    />
                                </div>
                            </div>
                            <!-- Badge Collection -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="font-cinzel cursor-default text-white text-center bg-black/80 px-3 py-1 text-xs font-bold uppercase tracking-wide rounded">
                                    PARFUMÉR
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

                                    <div v-if="perfume.stock > 0" class="flex items-center">
                                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                                        <span class="text-xs text-gray-300 uppercase tracking-wider">In Stoc</span>
                                    </div>
                                    <div v-else class="flex items-center">
                                        <span class="w-2 h-2 bg-red-400 rounded-full mr-2"></span>
                                        <span class="text-xs text-gray-400 uppercase tracking-wider">Stoc Epuizat</span>
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
                                    <div class="flex items-center my-10">
                                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
                                        <span class="mx-6 font-cinzel text-amber-400 text-xl tracking-widest px-4">
                                            COMPOZIȚIA AROMATICĂ
                                        </span>
                                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/40 to-transparent"></div>
                                    </div>


                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <!-- Note de Vârf -->
                                        <div v-if="perfume.top_notes?.length" class="group relative">
                                            <div
                                                class="absolute -inset-1 bg-amber-500/10 rounded-lg opacity-0 transition-opacity duration-300"></div>
                                            <div
                                                class="relative h-full p-4 ">
                                                <h4 class="font-cinzel text-amber-400 text-xl uppercase tracking-widest mb-3">
                                                    Note de Vârf</h4>
                                                <ul class="space-y-2">
                                                    <li v-for="note in perfume.top_notes" :key="`top-${note}`"
                                                        class="flex items-center">
                                                        <span class="w-1 h-1 bg-amber-400 rounded-full mr-2"></span>
                                                        <span class="text-gray-300 text-md capitalize font-cinzel ">{{ note }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Note de Inimă -->
                                        <div v-if="perfume.middle_notes?.length" class="group relative">
                                            <div
                                                class="absolute -inset-1 bg-amber-500/10 rounded-lg opacity-0 transition-opacity duration-300"></div>
                                            <div
                                                class="relative h-full p-4 ">
                                                <h4 class="font-cinzel text-amber-400 text-xl uppercase tracking-widest mb-3">
                                                    Note de Inimă</h4>
                                                <ul class="space-y-2">
                                                    <li v-for="note in perfume.middle_notes" :key="`middle-${note}`"
                                                        class="flex items-center">
                                                        <span class="w-1 h-1 bg-amber-400 rounded-full mr-2"></span>
                                                        <span class="text-gray-300 text-md capitalize font-cinzel ">{{ note }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Note de Bază -->
                                        <div v-if="perfume.base_notes?.length" class="group relative">
                                            <div
                                                class="absolute -inset-1 bg-amber-500/10 rounded-lg opacity-0 transition-opacity duration-300"></div>
                                            <div
                                                class="relative h-full p-4 ">
                                                <h4 class="font-cinzel text-amber-400 text-xl uppercase tracking-widest mb-3">
                                                    Note de Bază</h4>
                                                <ul class="space-y-2">
                                                    <li v-for="note in perfume.base_notes" :key="`base-${note}`"
                                                        class="flex items-center">
                                                        <span class="w-1 h-1 bg-amber-400 rounded-full mr-2"></span>
                                                        <span class="text-gray-300 text-md capitalize font-cinzel ">{{ note }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add to Cart Button -->
                            <button
                                class="mt-8 w-full hover:cursor-pointer bg-amber-500 hover:bg-amber-600 text-black font-bold font-cinzel py-3 px-6 uppercase tracking-wider transition-colors duration-300"
                                @click="addToCart(perfume)"
                            >
                                Adaugă în coș
                            </button>
                        </div>
                    </div>

                    <!-- Related Products Section -->
                    <div class="mt-24">
                        <h3 class="text-2xl md:text-3xl font-cinzel text-white mb-8 text-center">
                            S-ar putea să îți placă și
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            <div
                                v-for="(item, index) in 4"
                                :key="index"
                                class="group relative overflow-hidden rounded-xl transition-all duration-500"
                                data-aos="fade-in"
                                data-aos-delay="300"
                            >
                                <div class="relative overflow-hidden">
                                    <!-- Main Product Image -->
                                    <a :href="route('perfume.show', perfume.slug)" class="block overflow-hidden">
                                        <img
                                            src="https://img.freepik.com/premium-psd/fruit-perfume-bottle-mockup_23-2151411650.jpg?w=740"
                                            alt="Luxury Perfume"
                                            class="w-full h-80 object-cover transition-transform duration-700 group-hover:scale-105"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    </a>

                                    <!-- Exclusive Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span class="font-cinzel cursor-default text-white text-center bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">PARFUMÉR</span>
                                    </div>

                                    <div class="absolute top-4 right-4">
                                        <button @click="addToCart(perfume)" class="font-cinzel text-white text-center hover:cursor-pointer hover:scale-105 transition-all hover:bg-white hover:text-black bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">
                                            ADAUGA IN COS
                                        </button>
                                    </div>
                                </div>

                                <!-- Product Details -->
                                <div class="mt-5 text-center px-4 pb-4">
                                    <h1 class="text-white text-lg font-cinzel font-bold tracking-wider mb-1">{{ perfume.name }}</h1>
                                    <h2 class="text-gray-400 text-sm font-cinzel tracking-wider mb-2">{{ perfume.brand.name }}</h2>
                                    <div class="flex items-center justify-center space-x-4">
                                        <span class="text-amber-400 font-cinzel text-sm tracking-wider">{{ perfume.size }} ml</span>
                                        <span class="text-gray-500">|</span>
                                        <span class="text-white font-cinzel text-sm tracking-wider">{{ perfume.price }} RON</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section  class="relative py-32 bg-[url('https://img.freepik.com/premium-psd/perfume-bottle-sand_23-2148961294.jpg?w=740')] bg-cover bg-fixed bg-center">
            <div class="absolute inset-0 bg-gradient-to-b from-black/85 via-black/70 to-black/90" ></div>

            <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16" >
                    <svg data-aos="zoom-in-up" data-aos-delay="300" class="w-16 h-16 mx-auto text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <h2 class="font-serif text-4xl text-amber-100 mt-6 mb-4"  data-aos="zoom-in-up" data-aos-delay="300">
                        <span class="block">Acces Exclusiv</span>
                        <span class="text-amber-300">Pentru Cunoscători</span>
                    </h2>
                    <div class="border-t border-amber-500/30 w-24 mx-auto my-6"  data-aos="zoom-in-up" data-aos-delay="300"></div>
                    <p class="text-lg text-amber-200/80 max-w-2xl mx-auto"  data-aos="zoom-in-up" data-aos-delay="300">
                        Abonează-te la newsletter-ul nostru pentru a primi invitații la lansări private,
                        istorii despre ingrediente rare și oferte personalizate.
                    </p>
                </div>

                <div class="mt-12 max-w-md mx-auto">
                    <form class="space-y-6"  data-aos="zoom-in-up" data-aos-delay="300">
                        <div class="relative">
                            <input
                                type="email"
                                placeholder="Adresa ta de email"
                                class="w-full bg-transparent border-0 border-b border-amber-500/30 text-amber-100 placeholder-amber-500/50 focus:border-amber-300 focus:ring-0 py-4 px-0 font-light tracking-widest transition-all duration-300"
                            >
                            <div class="absolute bottom-0 left-0 w-0 h-px bg-amber-300 transition-all duration-500 group-focus-within:w-full"></div>
                        </div>

                        <div class="flex items-center justify-center space-x-4 pt-4">
                            <button
                                type="submit"
                                class="relative hover:cursor-pointer overflow-hidden bg-transparent border border-amber-500/50 text-amber-200 px-10 py-3 rounded-full hover:bg-amber-500/10 transition-all font-serif tracking-widest text-sm group"
                            >
                                <span class="relative font-cinzel font-bold z-10">ABONEAZĂ-TE</span>
                                <span class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            </button>
                        </div>
                    </form>

                    <p class="text-xs text-amber-500/60 text-center mt-8 max-w-xs mx-auto"  data-aos="zoom-in-up" data-aos-delay="300">
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

export default {
    props: {
        perfume: Object
    },
    methods: {
        addToCart(perfum) {
            eventBus.emit('add-to-cart', perfum);
        }
    }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&display=swap');

.font-cinzel {
    font-family: 'Cinzel', serif;
}

/* Smooth transitions for hover effects */
.transition-smooth {
    transition: all 0.3s ease-in-out;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .product-grid {
        grid-template-columns: 1fr;
    }

    .thumbnail-gallery {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 640px) {
    .related-products {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
