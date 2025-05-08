
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
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

        <section class="bg-gray-950 py-12" v-if="!perfumes || perfumes.length === 0" data-aos="fade-in" data-aos-delay="400">
            <div class="text-center text-amber-500 text-lg font-cinzel py-12">
                Momentan nu sunt parfumuri disponibile. Revenim în curând cu produse exclusiviste!
            </div>
        </section>

        <section v-else class="bg-gray-950 min-h-screen py-12">
            <!-- Container Responsiv -->
            <div class="container mx-auto px-4">
                <!-- Sidebar filtrări -->
                <div class="w-full py-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <div v-for="perfume in perfumes" :href="route('home')" :key="perfume.id" class="hover:scale-105 transition-all">
                            <div class="relative overflow-hidden" data-aos="fade-in" data-aos-delay="300">
                                <a :href="route('perfume.show', perfume.slug)">
                                    <img
                                        src="https://img.freepik.com/premium-psd/fruit-perfume-bottle-mockup_23-2151411650.jpg?w=740"
                                        alt="Luxury Perfume"
                                        class="perfume-image"
                                    />
                                </a>

                                <!-- Badge Collection -->
                                <div class="absolute top-3 left-3">
                                    <span class="font-cinzel cursor-default text-white text-center bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">PARFUMÉR</span>
                                </div>

                                <div class="absolute top-3 right-3">
                                    <button @click="addToCart(perfume)" class="font-cinzel text-white text-center hover:cursor-pointer hover:scale-105 transition-all hover:bg-white hover:text-black bg-black px-3 py-1 text-xs font-bold uppercase tracking-wide">
                                        ADAUGA IN COS
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <h1 class="text-white text-lg font-cinzel font-bold">{{ perfume.name }}</h1>
                                <h1 class="text-gray-400 text-md font-cinzel">{{ perfume.brand.name }}</h1>
                                <h1 class="text-gold-500 font-cinzel text-sm">{{ perfume.size }} ml</h1>
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
    </AppLayout>
</template>

<script lang="ts">
import { PropType } from 'vue';
import eventBus from '@/lib/event-bus';

export default {
    props: {
        perfumes: Array as PropType<Array<any>>,
    },
    methods: {
        addToCart(perfum) {
            eventBus.emit('add-to-cart', perfum);
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
