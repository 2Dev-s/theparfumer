<template>
    <AppLayout>
        <Head title="Comanda anulata" />
        <!-- Hero Section for Cancelled Page -->
        <div class="relative h-screen-90 flex items-center justify-center overflow-hidden bg-black">
            <!-- Background Video -->
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    class="w-full h-full object-cover opacity-40"
                    src="https://videos.pexels.com/video-files/4659830/4659830-uhd_2732_1440_25fps.mp4"
                ></video>
                <div class="absolute inset-0 bg-black/60"></div>
            </div>

            <!-- Cancelled Content -->
            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto" data-aos="fade-in">
                <!-- Cancelled Icon -->
                <div class="w-24 h-24 bg-rose-900/20 rounded-full flex items-center justify-center mx-auto mb-8 border border-rose-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>

                <!-- Heading -->
                <h1 class="font-cinzel text-4xl md:text-6xl text-rose-200 mb-6">
                    <span class="block text-lg text-rose-500/80 mb-4">COMANDA ANULATĂ</span>
                    Ne pare rău, {{ customerName }}!
                </h1>

                <div class="border-t border-rose-500/30 w-24 mx-auto my-8"></div>

                <!-- Order Summary -->
                <div class="bg-rose-900/10 p-8 rounded-lg border border-rose-900/20 mb-8 backdrop-blur-sm">
                    <h3 class="font-cinzel text-xl text-rose-300 mb-4">Comanda a fost anulată</h3>
                    <p class="text-rose-200/80 mt-4">
                        Nu a fost procesată nicio plată. Dacă ați întâmpinat probleme, vă rugăm să ne contactați.
                    </p>
                </div>

                <!-- Additional Info -->
                <p class="text-rose-200/80 max-w-xl mx-auto mb-8">
                    Dacă ați anulat din greșeală, puteți relua comanda folosind butonul de mai jos.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-4 mt-12">
                    <Link
                        href="/perfumes"
                        class="px-8 py-3 border border-rose-500/50 text-rose-200 hover:bg-rose-500/10 transition-all font-cinzel tracking-widest text-sm text-center"
                    >
                        ÎNAPOI LA PARFUMURI
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    customerName: {
        type: String,
        default: 'Client'
    }
});
</script>

<style>
.h-screen-90 {
    height: 93vh;
}
</style>
