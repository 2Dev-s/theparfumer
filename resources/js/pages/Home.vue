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
                    Crearea Arte Olfactive
                </h1>
                <div class="border-t border-amber-500/30 w-24 mx-auto my-8"></div>
                <p class="text-xl font-cinzel text-amber-100/80 max-w-2xl mx-auto">
                    Descoperă parfumuri personalizate pentru puținii care apreciază
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
                    <h2 class="font-cinzel text-4xl text-amber-200 mt-4">Semnătura PARFUMÉR</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        v-for="(collection, index) in collections"
                        :key="index"
                        class="group relative h-[600px] overflow-hidden cursor-pointer"
                        data-aos="fade-down" data-aos-delay="300"
                    >
                        <img
                            :src="collection.image"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-all duration-700"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent p-8 flex flex-col justify-end">
                            <h3 class="font-serif text-2xl text-amber-200 mb-2">{{ collection.name }}</h3>
                            <p class="text-amber-500/80 text-sm mb-4">{{ collection.items }} Piese Exclusiviste</p>
                            <button
                                class="text-left text-amber-500/80 hover:text-amber-300 transition-colors text-sm flex items-center">
                                Explorează Colecția
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
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
                    <div class="text-amber-500/80 tracking-widest font-light">ATELIERUL NOSTRU SECRET</div>
                    <h2 class="font-cinzel text-5xl text-amber-100 leading-tight">
                        <span class="block mb-4">Arta</span>
                        <span class="block text-amber-400">Parfumului</span>
                        <span class="block">de Pretutindeni</span>
                    </h2>

                    <p class="text-amber-200/80 text-lg leading-relaxed max-w-xl">
                        În atelierul nostru ascuns în inima Parisului, maeștrii parfumieri lucrează manual fiecare
                        compoziție,
                        transformând ingredientele cele mai rare în opere de artă olfactive. Fiecare flacon este o
                        poveste.
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
        <section class="py-24 bg-gray-950">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-20" data-aos="zoom-in" data-aos-delay="300">
                    <span class="text-amber-500/80 tracking-widest">GUSTURI REFINATE</span>
                    <h2 class="font-cinzel text-4xl text-amber-200 mt-4">Preferat de Connoisseur</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        v-for="(testimonial, index) in testimonials"
                        :key="index"
                        data-aos="zoom-in" data-aos-delay="300"
                        class="p-8 bg-gray-950 rounded-lg border border-amber-900/20 hover:border-amber-900/40 transition-colors"
                    >
                        <div class="text-amber-500/80 text-5xl mb-4">“</div>
                        <p class="text-amber-300/80 italic mb-6">{{ testimonial.quote }}</p>
                        <div class="flex items-center">
                            <img :src="testimonial.image" class="w-12 h-12 rounded-full border-2 border-amber-500/30">
                            <div class="ml-4">
                                <div class="font-cinzel text-amber-200">{{ testimonial.name }}</div>
                                <div class="text-sm text-amber-500/80">{{ testimonial.role }}</div>
                            </div>
                        </div>
                    </div>
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
import { Head } from '@inertiajs/vue3';

const collections = [
    {
        name: 'Femei',
        image: 'https://img.freepik.com/free-photo/bride-holds-bottle-parfume-her-tender-arms_8353-7217.jpg?t=st=1746664538~exp=1746668138~hmac=ed9f6c9640093aa4e6a52f8a07a4c5a90f2245cd5782c30a0ce945c5b0637d0b&w=740',
        items: 12
    },
    {
        name: 'Unisex',
        image: 'https://img.freepik.com/free-photo/elegant-vegan-alcohol-arrangement_23-2149337702.jpg?t=st=1746664558~exp=1746668158~hmac=51b8e8ea191acddb851ce96b3f3c17f726f9f79adbb61bfbbfd43216adf231fe&w=740',
        items: 8
    },
    {
        name: 'Bărbați',
        image: 'https://img.freepik.com/premium-photo/man-formal-suit-bottle-perfume-closeup-fragrance-smell-men-perfumes-fashion-cologne-bottle-man-holding-up-bottle-perfume-men-perfume-hand-suit-background_293990-2206.jpg?w=740',
        items: 5
    }
];

const testimonials = [
    {
        quote: 'Cea mai înaltă formă de sofisticare - purtarea creațiilor lor este ca un lux secret pe care doar câțiva îl înțeleg.',
        name: 'Sophia Maréchal',
        role: 'Editor de Lux, Vogue Paris',
        image: 'https://randomuser.me/api/portraits/women/44.jpg'
    },
    {
        quote: 'Într-o lume plină de parfumuri produse în masă, meșteșugul lor este o revelație a adevăratei arte.',
        name: 'James Rothschild',
        role: 'Colector de Artă',
        image: 'https://randomuser.me/api/portraits/men/32.jpg'
    },
    {
        quote: 'Fiecare parfum spune o poveste mai captivantă decât orice bijuterie din colecția mea.',
        name: 'Amira Al-Fayed',
        role: 'Designer de Bijuterii',
        image: 'https://randomuser.me/api/portraits/women/68.jpg'
    }
];
</script>

<style scoped>
.h-screen-90 {
    height: 93vh;
}
</style>
