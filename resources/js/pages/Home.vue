<template>
    <Head title="Acasă" />

    <PromotionalCodePopup :promotionalCode="promotionalCode" />

    <AppLayout>
        <!-- Secțiunea Hero -->
        <div class="h-screen-90 relative flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    class="h-full w-full object-cover opacity-90"
                    src="https://videos.pexels.com/video-files/4659830/4659830-uhd_2732_1440_25fps.mp4"
                ></video>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            <div class="relative z-10 px-4 text-center" data-aos="fade-in" data-aos-delay="300">
                <h1 class="font-cinzel mb-6 text-5xl text-amber-200 md:text-7xl">
                    <span class="mb-4 block text-xl text-amber-500/80">GUSTUL DESĂVÂRȘIT</span>
                    Crearea Artei Olfactive
                </h1>
                <div class="mx-auto my-8 w-24 border-t border-amber-500/30"></div>
                <p class="font-cinzel mx-auto max-w-2xl text-xl text-amber-100/80">Descoperă parfumuri pentru puținii care apreciază</p>
            </div>

            <a href="#coletions" class="absolute bottom-12 left-1/2 -translate-x-1/2 animate-bounce">
                <svg class="h-8 w-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>

        <!-- Colecții -->
        <section class="relative bg-gray-950 py-24" id="coletions">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mb-20 text-center" data-aos="fade-down" data-aos-delay="300">
                    <span class="tracking-widest text-amber-500/80">COLECȚII PRIVATE</span>
                    <h2 class="font-cinzel mt-4 text-4xl text-amber-200">Semnătura PARFUMER</h2>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div
                        v-for="(collection, index) in collections"
                        :key="index"
                        class="group relative h-[600px] cursor-pointer overflow-hidden"
                        data-aos="fade-down"
                        data-aos-delay="300"
                    >
                        <a :href="`/perfumes?collection=${collection.arg}`">
                            <img
                                :src="collection.image"
                                class="h-full w-full transform object-cover transition-all duration-700 group-hover:scale-105"
                            />
                            <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/80 via-transparent to-transparent p-8">
                                <h3 class="mb-2 font-serif text-2xl text-amber-200">{{ collection.name }}</h3>
                                <button class="flex items-center text-left text-sm text-amber-500/80 transition-colors hover:text-amber-300">
                                    Explorează Colecția
                                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sectiunea "Atelierul Nostru" -->
        <section class="relative flex h-screen min-h-[800px] items-center overflow-hidden bg-black">
            <div class="relative z-10 mx-auto grid max-w-7xl grid-cols-1 items-center gap-16 px-6 lg:grid-cols-2 lg:px-8">
                <!-- Coloana Text -->
                <div class="space-y-8" data-aos="fade-down" data-aos-delay="300">
                    <h2 class="font-cinzel text-5xl leading-tight text-amber-100">
                        <span class="mb-4 block">Arta</span>
                        <span class="block text-amber-400">Parfumului</span>
                        <span class="block">de Pretutindeni</span>
                    </h2>

                    <p class="max-w-xl text-lg leading-relaxed text-amber-200/80">
                        Descoperă o colecție atent selecționată de parfumuri, inspirate din culturi bogate și tradiții olfactive diverse. Fiecare
                        esență spune o poveste – de la misterul Orientului până la rafinamentul franțuzesc. Alege parfumul care te reprezintă și
                        transformă fiecare zi într-o experiență memorabilă.
                    </p>
                </div>

                <!-- Coloana Imagine Interactiva -->
                <div class="relative h-[500px] overflow-hidden rounded-xl shadow-2xl" data-aos="fade-down" data-aos-delay="300">
                    <!-- Imagine principala -->
                    <img
                        src="https://images.unsplash.com/photo-1590736704728-f4730bb30770?q=80&w=774&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="absolute inset-0 h-full w-full object-cover"
                        alt="Atelier de parfum"
                    />

                    <!-- Overlay cu text la hover -->
                    <div
                        class="absolute inset-0 flex items-center justify-center bg-black/50 p-8 opacity-0 transition-opacity duration-500 hover:opacity-100"
                    >
                        <p class="max-w-md text-center font-light text-amber-100">
                            "O singură picătură conține esența a peste 300 de petale de trandafir, recoltate manual la răsărit în Valea Rozelor din
                            Bulgaria"
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoniale -->
        <section class="bg-gray-950 py-24">
            <div class="mx-auto mb-14 max-w-7xl px-6 lg:px-8">
                <div class="mb-20 text-center" data-aos="zoom-in" data-aos-delay="300">
                    <span class="tracking-widest text-amber-500/80">RECOMANDĂRILE NOASTRE</span>
                    <h2 class="font-cinzel mt-4 text-4xl text-amber-200">Parfumuri Exquisite</h2>
                </div>

                <div
                    class="grid grid-cols-1 gap-12"
                    :class="{
                        'md:grid-cols-2': recommendedPerfumes.length === 2,
                        'mx-auto max-w-3xl': recommendedPerfumes.length === 1,
                    }"
                >
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

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PromotionalCodePopup from '@/components/PromotionalCodePopup.vue';

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
    promotionalCode: string;
}

defineProps<Props>();

const collections = [
    {
        name: 'Femei',
        image: 'https://img.freepik.com/free-photo/bride-holds-bottle-parfume-her-tender-arms_8353-7217.jpg?t=st=1746664538~exp=1746668138~hmac=ed9f6c9640093aa4e6a52f8a07a4c5a90f2245cd5782c30a0ce945c5b0637d0b&w=740',
        items: 12,
        arg: 'female',
    },
    {
        name: 'Unisex',
        image: 'https://img.freepik.com/free-photo/elegant-vegan-alcohol-arrangement_23-2149337702.jpg?t=st=1746664558~exp=1746668158~hmac=51b8e8ea191acddb851ce96b3f3c17f726f9f79adbb61bfbbfd43216adf231fe&w=740',
        items: 8,
        arg: 'unisex',
    },
    {
        name: 'Bărbați',
        image: 'https://img.freepik.com/premium-photo/man-formal-suit-bottle-perfume-closeup-fragrance-smell-men-perfumes-fashion-cologne-bottle-man-holding-up-bottle-perfume-men-perfume-hand-suit-background_293990-2206.jpg?w=740',
        items: 5,
        arg: 'male',
    },
];
</script>

<style scoped>
.h-screen-90 {
    height: 93vh;
}
</style>
