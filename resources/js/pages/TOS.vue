<template>
    <AppLayout>
        <Head title="Termeni și Condiții" />

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
                    <span class="block text-xl text-amber-500/80 mb-4">Termeni și Condiții</span>
                    POLITICILE NOASTRE
                </h1>
                <div class="border-t border-amber-500/30 w-24 mx-auto my-8"></div>
                <p class="text-xl font-cinzel text-amber-100/80 max-w-2xl mx-auto">
                    Standarde de excelență pentru clienții noștri sofisticați
                </p>
            </div>
        </section>


        <!-- Terms Content -->
        <section class="bg-gray-950 py-20 px-4 sm:px-6">
            <div class="max-w-5xl mx-auto">
                <!-- Gold Decorative Element -->
                <div class="flex justify-center mb-16">
                    <div class="w-24 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>
                </div>

                <!-- Terms Container -->
                <div class="bg-gray-900/50 border border-gray-800/50 rounded-lg p-8 md:p-12 backdrop-blur-sm">
                    <!-- Section 1 -->
                    <div class="mb-16" data-aos="fade-up">
                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-4">
                                <span class="text-black font-bold">1</span>
                            </div>
                            <h2 class="font-cinzel text-2xl text-amber-300">Politica de Confidențialitate</h2>
                        </div>
                        <div class="pl-12">
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Datele dumneavoastră sunt tratate cu cea mai mare discreție, asemenea unui seif privat în cel mai exclusivist club.
                                Colectăm doar informațiile esențiale pentru a vă oferi experiența personalizată pe care o meritați.
                            </p>
                            <ul class="text-gray-400 space-y-3 pl-5 list-disc">
                                <li>Nu partajăm date cu terți fără consimțământul dumneavoastră explicit</li>
                                <li>Utilizăm criptare de grad bancar pentru toate tranzacțiile</li>
                                <li>Puteți solicita ștergerea datelor oricând prin simpla trimitere a unui email</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div class="mb-16" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-4">
                                <span class="text-black font-bold">2</span>
                            </div>
                            <h2 class="font-cinzel text-2xl text-amber-300">Livrări Exclusive</h2>
                        </div>
                        <div class="pl-12">
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Produsele dumneavoastră vor fi livrate cu aceeași grijă cu care un bijutier transportă diamantele cele mai prețioase.
                            </p>
                            <ul class="text-gray-400 space-y-3 pl-5 list-disc">
                                <li>Livrare gratuită pentru comenzi peste 250 RON</li>
                                <li>Livrări doar în România - pentru internațional vă rugăm să ne contactați</li>
                                <li>Termen mediu de livrare: 1-3 zile lucrătoare</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Section 3 -->
                    <div class="mb-16" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-4">
                                <span class="text-black font-bold">3</span>
                            </div>
                            <h2 class="font-cinzel text-2xl text-amber-300">Retururi și Rambursări</h2>
                        </div>
                        <div class="pl-12">
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Deși ne străduim să oferim perfecțiune în fiecare detaliu, înțelegem că uneori standardele dumneavoastră pot fi și mai exigente.
                            </p>
                            <ul class="text-gray-400 space-y-3 pl-5 list-disc">
                                <li>Termen de retur: 14 zile de la primirea coletului</li>
                                <li>Produsele trebuie să fie în ambalaj original, neatins</li>
                                <li>Rambursările se procesează în maxim 5 zile lucrătoare</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Section 4 -->
                    <div data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-4">
                                <span class="text-black font-bold">4</span>
                            </div>
                            <h2 class="font-cinzel text-2xl text-amber-300">Garanții și Servicii</h2>
                        </div>
                        <div class="pl-12">
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Fiecare produs este garantat ca autentic, așa cum ne așteptăm de la un parteneriat cu cele mai prestigioase case de parfumuri.
                            </p>
                            <ul class="text-gray-400 space-y-3 pl-5 list-disc">
                                <li>Garanție autenticitate: toate produsele sunt 100% originale</li>
                                <li>Servicii personalizate de consultanță în parfumuri pentru clienții fideli</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Signature -->
                <div class="mt-20 text-center" data-aos="fade-in">
                    <div class="inline-block border-t border-amber-500/30 pt-6">
                        <p class="font-cinzel text-amber-400 text-lg">Cu respect,</p>
                        <p class="text-gray-400 mt-2">Echipa PARFUMER</p>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<style scoped>
/* Custom animations for the numbers */
[data-aos="fade-up"] {
    transition-property: transform, opacity;
}

/* Gold text selection */
::selection {
    background: #d4af37;
    color: #000;
}


.h-screen-90 {
    height: 35vh;
}


/* Scrollbar styling */
::-webkit-scrollbar {
    width: 8px;
    background: #111827;
}

::-webkit-scrollbar-thumb {
    background: #d4af37;
    border-radius: 4px;
}
</style>
