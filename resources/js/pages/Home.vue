<template>
    <Head title="Acasă" />

    <AppLayout>
        <!-- Secțiunea Hero -->
        <div class="relative h-screen-90 flex items-center justify-center overflow-hidden" >
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    class="w-full h-full object-cover opacity-90"
                    src="https://videos.pexels.com/video-files/4659830/4659830-uhd_2732_1440_25fps.mp4"
                ></video>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            <div class="relative z-10 text-center px-4" data-aos="fade-in" data-aos-delay="300">
                <h1 class="font-cinzel text-5xl md:text-7xl text-amber-200 mb-6">
                    <span class="block text-xl  text-amber-500/80 mb-4">GUSTUL DESĂVÂRȘIT</span>
                    Crearea Artei Olfactive
                </h1>
                <div class="border-t border-amber-500/30 w-24 mx-auto my-8"></div>
                <p class="text-xl font-cinzel text-amber-100/80 max-w-2xl mx-auto">
                    Descoperă parfumuri pentru puținii care apreciază
                </p>
            </div>

            <a href="#coletions" class="absolute bottom-12 left-1/2 -translate-x-1/2 animate-bounce" >
                <svg class="w-8 h-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>

        <!-- Colecții -->
        <section class="py-24 bg-gray-950 relative" id="coletions">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-20" data-aos="fade-down" data-aos-delay="300">
                    <span class="text-amber-500/80 tracking-widest">COLECȚII PRIVATE</span>
                    <h2 class="font-cinzel text-4xl text-amber-200 mt-4">Semnătura PARFUMER</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        v-for="(collection, index) in collections"
                        :key="index"
                        class="group relative h-[600px] overflow-hidden cursor-pointer"
                        data-aos="fade-down" data-aos-delay="300"
                    >
                        <a :href="`/perfumes?collection=${collection.arg}`">
                            <img
                                :src="collection.image"
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-all duration-700"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent p-8 flex flex-col justify-end">
                                <h3 class="font-serif text-2xl text-amber-200 mb-2">{{ collection.name }}</h3>
                                <button
                                    class="text-left text-amber-500/80 hover:text-amber-300 transition-colors text-sm flex items-center">
                                    Explorează Colecția
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sectiunea "Atelierul Nostru" -->
        <section class="relative h-screen min-h-[800px] flex items-center bg-black overflow-hidden">

            <div
                class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
                <!-- Coloana Text -->
                <div class="space-y-8" data-aos="fade-down" data-aos-delay="300">
                    <h2 class="font-cinzel text-5xl text-amber-100 leading-tight">
                        <span class="block mb-4">Arta</span>
                        <span class="block text-amber-400">Parfumului</span>
                        <span class="block">de Pretutindeni</span>
                    </h2>

                    <p class="text-amber-200/80 text-lg leading-relaxed max-w-xl">
                        Descoperă o colecție atent selecționată de parfumuri, inspirate din culturi bogate și tradiții olfactive diverse.
                        Fiecare esență spune o poveste – de la misterul Orientului până la rafinamentul franțuzesc.
                        Alege parfumul care te reprezintă și transformă fiecare zi într-o experiență memorabilă.
                    </p>
                </div>

                <!-- Coloana Imagine Interactiva -->
                <div class="relative h-[500px] rounded-xl overflow-hidden shadow-2xl" data-aos="fade-down" data-aos-delay="300">
                    <!-- Imagine principala -->
                    <img
                        src="https://img.freepik.com/premium-psd/logo-mockup-luxury-perfume-bottle_206274-276.jpg?w=740"
                        class="absolute inset-0 w-full h-full object-cover" alt="Atelier de parfum">


                    <!-- Overlay cu text la hover -->
                    <div
                        class="absolute inset-0 bg-black/50 opacity-0 hover:opacity-100 transition-opacity duration-500 flex items-center justify-center p-8">
                        <p class="text-amber-100 text-center font-light max-w-md">
                            "O singură picătură conține esența a peste 300 de petale de trandafir,
                            recoltate manual la răsărit în Valea Rozelor din Bulgaria"
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoniale -->
        <section class="bg-gray-950 py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 mb-14">
                <div class="mb-20 text-center" data-aos="zoom-in" data-aos-delay="300">
                    <span class="tracking-widest text-amber-500/80">RECOMANDĂRILE NOASTRE</span>
                    <h2 class="font-cinzel mt-4 text-4xl text-amber-200">Parfumuri Exquisite</h2>
                </div>

                <div class="grid grid-cols-1 gap-12" :class="{
            'md:grid-cols-2': recommendedPerfumes.length === 2,
            'max-w-3xl mx-auto': recommendedPerfumes.length === 1
        }">
                    <a
                        v-for="perfume in recommendedPerfumes"
                        :key="perfume.id"
                        data-aos="zoom-in"
                        data-aos-delay="300"
                        :href="route('perfume.show', perfume.slug)"
                        class="group rounded-lg bg-gray-950 p-8 transition-colors"
                    >
                        <!-- Enlarged image container -->
                        <div class="relative mb-8 h-full w-full overflow-hidden rounded-lg">
                            <img
                                :src="perfume.media?.[0]?.original_url"
                                :alt="perfume.name"
                                class="h-full w-full object-contain object-center transition-transform duration-700 group-hover:scale-110"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-950/70 via-gray-950/10 to-transparent"></div>
                        </div>

                        <div class="mb-3 flex items-start justify-between">
                            <h3 class="font-cinzel text-2xl text-amber-200">{{ perfume.name }}</h3>
                            <span class="text-lg text-amber-500">{{ perfume.price }} RON</span>
                        </div>

                        <p class="mb-5 text-base text-amber-300/80">{{ perfume.brand.name }}</p>
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <!-- Newsletter Section - Luxury Edition -->
        <section  class="relative py-32 bg-[url('https://img.freepik.com/premium-psd/perfume-bottle-sand_23-2148961294.jpg?w=740')] bg-cover bg-fixed bg-center">
            <div class="absolute inset-0 bg-gradient-to-b from-black/85 via-black/70 to-black/90" ></div>

            <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16" >
                    <h2 class="font-serif text-4xl text-amber-100 mt-6 mb-4"  data-aos="zoom-in-up" data-aos-delay="300">
                        <span class="block font-cinzel">Acces Exclusiv</span>
                        <span class="text-amber-300 font-cinzel">Pentru Cunoscători</span>
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
                                class="w-full bg-transparent font-cinzel border-0 border-b border-amber-500/30 text-amber-100 placeholder-amber-500/50 focus:border-amber-300 focus:ring-0 py-4 px-0 font-light tracking-widest transition-all duration-300"
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

                    <p class="text-xs text-amber-500/60 text-center mt-8 max-w-xs mx-auto font-cinzel"  data-aos="zoom-in-up" data-aos-delay="300">
                        Vă promitem să nu vă inundăm inboxul. Doar conținut exclusiv, la fiecare lună.
                    </p>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

interface Perfume {
    id: number;
    name: string;
    price: number;
    slug: string;
    media: Array<{ original_url: string }>;
    brand: {
        name: string;
    };
    topNotes?: Array<{
        id: number;
        name: string;
        icon: string;
    }>;
    fragranceFamily?: string;
}

interface Props {
    recommendedPerfumes: Perfume[];
}

defineProps<Props>();

const collections = [
    {
        name: 'Femei',
        image: 'https://img.freepik.com/free-photo/bride-holds-bottle-parfume-her-tender-arms_8353-7217.jpg?t=st=1746664538~exp=1746668138~hmac=ed9f6c9640093aa4e6a52f8a07a4c5a90f2245cd5782c30a0ce945c5b0637d0b&w=740',
        items: 12,
        arg: 'female'
    },
    {
        name: 'Unisex',
        image: 'https://img.freepik.com/free-photo/elegant-vegan-alcohol-arrangement_23-2149337702.jpg?t=st=1746664558~exp=1746668158~hmac=51b8e8ea191acddb851ce96b3f3c17f726f9f79adbb61bfbbfd43216adf231fe&w=740',
        items: 8,
        arg: 'unisex'
    },
    {
        name: 'Bărbați',
        image: 'https://img.freepik.com/premium-photo/man-formal-suit-bottle-perfume-closeup-fragrance-smell-men-perfumes-fashion-cologne-bottle-man-holding-up-bottle-perfume-men-perfume-hand-suit-background_293990-2206.jpg?w=740',
        items: 5,
        arg: 'male'
    }
];
</script>

<style scoped>
.h-screen-90 {
    height: 93vh;
}
</style>
