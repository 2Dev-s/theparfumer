<template>
    <AppLayout>
        <Head title="Politică de Confidențialitate" />

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
                <h1 class="font-cinzel text-2xl md:text-5xl text-amber-200 mb-6">
                    <span class="block text-xl text-amber-500/80 mb-4">PROTECȚIA DATELOR DUMNEAVOASTRĂ</span>
                    Politică de Confidențialitate
                </h1>
                <div class="border-t border-amber-500/30 w-24 mx-auto my-8"></div>
                <p class="text-xl font-cinzel text-amber-100/80 max-w-2xl mx-auto">
                    Discreție și securitate la standarde de excelență
                </p>
            </div>
        </section>

        <!-- Privacy Content -->
        <section class="bg-gray-950 py-20 px-4 sm:px-6">
            <div class="max-w-5xl mx-auto">
                <!-- Gold Decorative Element -->
                <div class="flex justify-center mb-16">
                    <div class="w-24 h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>
                </div>

                <!-- Privacy Container -->
                <div class="bg-gray-900/50 border border-gray-800/50 rounded-lg p-8 md:p-12 backdrop-blur-sm">
                    <!-- Introduction -->
                    <div class="mb-12 text-center">
                        <p class="text-amber-200 font-cinzel text-lg mb-4">Ultima actualizare: 12 Mai 2025</p>
                        <p class="text-gray-300 leading-relaxed">
                            La Parfumerie de Lux, tratăm datele dumneavoastră personale cu aceeași grijă și respect pe care o acordăm
                            celor mai prețioase ingrediente din parfumurile noastre. Această politică detaliază cum colectăm,
                            utilizăm și protejăm informațiile dumneavoastră.
                        </p>
                    </div>

                    <!-- Section 1 -->
                    <div class="mb-16" data-aos="fade-up">
                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="font-cinzel text-2xl text-amber-300">Datele pe care le colectăm</h2>
                        </div>
                        <div class="pl-12">
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Colectăm doar informațiile esențiale pentru a vă oferi o experiență personalizată:
                            </p>
                            <ul class="text-gray-400 space-y-3 pl-5 list-disc">
                                <li><strong>Informații de contact:</strong> Nume, adresă de email, număr de telefon</li>
                                <li><strong>Informații de plată:</strong> Procesate prin intermediul serviciilor securizate de plată</li>
                                <li><strong>Preferințe:</strong> Istoricul comenzilor și preferințele de produse</li>
                                <li><strong>Date tehnice:</strong> Adresa IP, tipul dispozitivului, date de utilizare</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div class="mb-16" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="font-cinzel text-2xl text-amber-300">Cum utilizăm datele</h2>
                        </div>
                        <div class="pl-12">
                            <ul class="text-gray-400 space-y-3 pl-5 list-disc">
                                <li>Pentru procesarea și livrarea comenzilor dumneavoastră</li>
                                <li>Pentru îmbunătățirea continuă a serviciilor noastre</li>
                                <li>Pentru comunicări personalizate despre oferte exclusive</li>
                                <li>Pentru prevenirea fraudelor și securizarea tranzacțiilor</li>
                                <li>Pentru analize interne care ne ajută să vă oferim experiențe mai bune</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Section 3 -->
                    <div class="mb-16" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="font-cinzel text-2xl text-amber-300">Securitatea datelor</h2>
                        </div>
                        <div class="pl-12">
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Implementăm măsuri de securitate de ultimă generație:
                            </p>
                            <ul class="text-gray-400 space-y-3 pl-5 list-disc">
                                <li>Criptare SSL pentru toate transferurile de date</li>
                                <li>Sisteme de securitate PCI-DSS pentru plăți</li>
                                <li>Acces restricționat la datele sensibile</li>
                                <li>Audituri regulate de securitate</li>
                            </ul>
                            <p class="text-gray-300 mt-6 italic">
                                "Protejăm datele dumneavoastră cu aceeași pasiune cu care protejăm rețetele exclusive ale parfumurilor noastre."
                            </p>
                        </div>
                    </div>

                    <!-- Section 4 -->
                    <div class="mb-16" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="font-cinzel text-2xl text-amber-300">Drepturile dumneavoastră</h2>
                        </div>
                        <div class="pl-12">
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Conform GDPR, aveți următoarele drepturi:
                            </p>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="bg-gray-800/30 p-5 rounded-lg border-l-4 border-amber-500">
                                    <h3 class="font-cinzel text-amber-300 mb-2">Acces la date</h3>
                                    <p class="text-gray-400 text-sm">Dreptul de a solicita copii ale datelor dumneavoastră personale</p>
                                </div>
                                <div class="bg-gray-800/30 p-5 rounded-lg border-l-4 border-amber-500">
                                    <h3 class="font-cinzel text-amber-300 mb-2">Rectificare</h3>
                                    <p class="text-gray-400 text-sm">Dreptul de a ne cere să corectăm informațiile inexacte</p>
                                </div>
                                <div class="bg-gray-800/30 p-5 rounded-lg border-l-4 border-amber-500">
                                    <h3 class="font-cinzel text-amber-300 mb-2">Ștergere</h3>
                                    <p class="text-gray-400 text-sm">Dreptul de a solicita ștergerea datelor în anumite condiții</p>
                                </div>
                                <div class="bg-gray-800/30 p-5 rounded-lg border-l-4 border-amber-500">
                                    <h3 class="font-cinzel text-amber-300 mb-2">Opoziție</h3>
                                    <p class="text-gray-400 text-sm">Dreptul de a vă opune prelucrării datelor în anumite cazuri</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5 -->
                    <div data-aos="fade-up" data-aos-delay="400">
                        <div class="flex items-center mb-6">
                            <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <h2 class="font-cinzel text-2xl text-amber-300">Contact</h2>
                        </div>
                        <div class="pl-12">
                            <p class="text-gray-300 mb-6 leading-relaxed">
                                Pentru exercitarea drepturilor dumneavoastră sau orice întrebări legate de confidențialitate:
                            </p>
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1 bg-gray-800/30 p-6 rounded-lg">
                                    <h3 class="font-cinzel text-amber-300 mb-3">Email dedicat</h3>
                                    <a href="mailto:contact.parfumer@gmail.com" class="text-amber-400 hover:text-amber-300 transition-colors">
                                        contact.parfumer@gmail.com
                                    </a>
                                </div>
                                <div class="flex-1 bg-gray-800/30 p-6 rounded-lg">
                                    <h3 class="font-cinzel text-amber-300 mb-3">Oficiul pentru Protecția Datelor</h3>
                                    <p class="text-gray-400">Str. Calea Bucovinei 55, Câmpulung Moldovenesc, Suceava, Romania</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Last Updated -->
                <div class="mt-20 text-center text-gray-500 text-sm">
                    Documentul a fost actualizat ultima dată la 12 Mai 2025
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
/* Custom styling for the privacy policy */
::selection {
    background: #d4af37;
    color: #000;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Fancy bullet points */
ul.list-disc li::marker {
    color: #d4af37;
}

.h-screen-90 {
    height: 35vh;
}

/* Responsive grid adjustments */
@media (max-width: 640px) {
    .grid-cols-2 {
        grid-template-columns: 1fr;
    }
}
</style>
