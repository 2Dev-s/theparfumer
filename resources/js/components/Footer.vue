<template>
    <footer class="bg-black text-white pt-16 pb-8 px-4 sm:px-8 font-sans">
        <div class="max-w-7xl mx-auto">
            <!-- Conținut Principal al Footer-ului -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <!-- Coloană Brand -->
                <div class="space-y-6">
                    <div class="flex items-center">
                        <span class="text-2xl font-light tracking-wider">PARFUMER</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed font-light">
                        Creăm capodopere olfactive. Fiecare parfum spune o poveste despre lux, pasiune și eleganță atemporală.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <!-- Iconuri Social Media -->
                        <a href="#" class="text-gray-400 hover:text-amber-400 transition duration-300">
                            <!-- Facebook -->
                        </a>
                        <a href="#" class="text-gray-400 hover:text-amber-400 transition duration-300">
                            <!-- Twitter -->
                        </a>
                        <a href="#" class="text-gray-400 hover:text-amber-400 transition duration-300">
                            <!-- Instagram -->
                        </a>
                    </div>
                </div>

                <!-- Coloană Colecții -->
                <div>
                    <h3 class="text-sm font-semibold tracking-wider text-gray-300 uppercase">Colecții</h3>
                    <ul class="mt-6 space-y-3">
                        <li><a href="/perfumes?collection=female" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Femei</a></li>
                        <li><a href="/perfumes?collection=male" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Barbati</a></li>
                        <li><a href="/perfumes?collection=unisex" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Unisex</a></li>
                    </ul>
                </div>

                <!-- Coloană Suport Clienți -->
                <div>
                    <h3 class="text-sm font-semibold tracking-wider text-gray-300 uppercase">Suport Clienți</h3>
                    <ul class="mt-6 space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Comenzi și Plăți</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Expediere și Livrare</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Retururi și Schimburi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Întrebări Frecvente</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold tracking-wider text-gray-300 uppercase">Contact</h3>
                    <ul class="mt-6 space-y-4 text-sm text-gray-400 font-light leading-relaxed">
                        <li>
                            <strong class="text-white">Adresă:</strong><br>
                            Str. Calea Bucovinei 55, Câmpulung Moldovenesc, Suceava, Romania
                        </li>
                        <li>
                            <strong class="text-white">Email:</strong><br>
                            <a href="mailto:contact.parfumer@gmail.com" class="hover:text-amber-400 transition duration-300">contact.parfumer@gmail.com</a>
                        </li>
                        <li>
                            <strong class="text-white">Telefon:</strong><br>
                            <a href="tel:+0751345435" class="hover:text-amber-400 transition duration-300">+40 751 345 435</a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Footer de Jos -->
            <div class="border-t border-gray-800 pt-6 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
                <p>&copy; 2025 PARFUMER. Toate drepturile rezervate.</p>
                <div class="flex space-x-4 mt-4 sm:mt-0">
                    <a href="#" class="hover:text-amber-400 transition duration-300">Politica de Confidențialitate</a>
                    <a href="#" class="hover:text-amber-400 transition duration-300">Termeni și Condiții</a>
                </div>
            </div>
        </div>
    </footer>
</template>
