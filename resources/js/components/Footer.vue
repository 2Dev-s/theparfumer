<template>
    <footer class="bg-black text-white pt-16 pb-8 px-4 sm:px-8 font-sans">
        <div class="max-w-7xl mx-auto">
            <!-- Conținut Principal al Footer-ului -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 sm:gap-8 md:gap-10 lg:gap-12 mb-16">
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
                        <a href="https://web.facebook.com/profile.php?id=61554256497211" class="text-gray-400 hover:text-amber-400 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 48 48">
                                <path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"></path><path fill="#fff" d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z"></path>
                            </svg>
                        </a>
<!--                        <Link href="#" class="text-gray-400 hover:text-amber-400 transition duration-300">-->
<!--                            <svg width="35" height="35" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <path d="M8.45095 19.7926C8.60723 18.4987 9.1379 17.7743 10.1379 17.0317C11.5688 16.0259 13.3561 16.5948 13.3561 16.5948V13.2197C13.7907 13.2085 14.2254 13.2343 14.6551 13.2966V17.6401C14.6551 17.6401 12.8683 17.0712 11.4375 18.0775C10.438 18.8196 9.90623 19.5446 9.7505 20.8385C9.74562 21.5411 9.87747 22.4595 10.4847 23.2536C10.3345 23.1766 10.1815 23.0889 10.0256 22.9905C8.68807 22.0923 8.44444 20.7449 8.45095 19.7926ZM22.0352 6.97898C21.0509 5.90039 20.6786 4.81139 20.5441 4.04639H21.7823C21.7823 4.04639 21.5354 6.05224 23.3347 8.02482L23.3597 8.05134C22.8747 7.7463 22.43 7.38624 22.0352 6.97898ZM28 10.0369V14.293C28 14.293 26.42 14.2312 25.2507 13.9337C23.6179 13.5176 22.5685 12.8795 22.5685 12.8795C22.5685 12.8795 21.8436 12.4245 21.785 12.3928V21.1817C21.785 21.6711 21.651 22.8932 21.2424 23.9125C20.709 25.246 19.8859 26.1212 19.7345 26.3001C19.7345 26.3001 18.7334 27.4832 16.9672 28.28C15.3752 28.9987 13.9774 28.9805 13.5596 28.9987C13.5596 28.9987 11.1434 29.0944 8.96915 27.6814C8.49898 27.3699 8.06011 27.0172 7.6582 26.6277L7.66906 26.6355C9.84383 28.0485 12.2595 27.9528 12.2595 27.9528C12.6779 27.9346 14.0756 27.9528 15.6671 27.2341C17.4317 26.4374 18.4344 25.2543 18.4344 25.2543C18.5842 25.0754 19.4111 24.2001 19.9423 22.8662C20.3498 21.8474 20.4849 20.6247 20.4849 20.1354V11.3475C20.5435 11.3797 21.2679 11.8347 21.2679 11.8347C21.2679 11.8347 22.3179 12.4734 23.9506 12.8889C25.1204 13.1864 26.7 13.2483 26.7 13.2483V9.91314C27.2404 10.0343 27.7011 10.0671 28 10.0369Z" fill="#EE1D52"/>-->
<!--                                <path d="M26.7009 9.91314V13.2472C26.7009 13.2472 25.1213 13.1853 23.9515 12.8879C22.3188 12.4718 21.2688 11.8337 21.2688 11.8337C21.2688 11.8337 20.5444 11.3787 20.4858 11.3464V20.1364C20.4858 20.6258 20.3518 21.8484 19.9432 22.8672C19.4098 24.2012 18.5867 25.0764 18.4353 25.2553C18.4353 25.2553 17.4337 26.4384 15.668 27.2352C14.0765 27.9539 12.6788 27.9357 12.2604 27.9539C12.2604 27.9539 9.84473 28.0496 7.66995 26.6366L7.6591 26.6288C7.42949 26.4064 7.21336 26.1717 7.01177 25.9257C6.31777 25.0795 5.89237 24.0789 5.78547 23.7934C5.78529 23.7922 5.78529 23.791 5.78547 23.7898C5.61347 23.2937 5.25209 22.1022 5.30147 20.9482C5.38883 18.9122 6.10507 17.6625 6.29444 17.3494C6.79597 16.4957 7.44828 15.7318 8.22233 15.0919C8.90538 14.5396 9.6796 14.1002 10.5132 13.7917C11.4144 13.4295 12.3794 13.2353 13.3565 13.2197V16.5948C13.3565 16.5948 11.5691 16.028 10.1388 17.0317C9.13879 17.7743 8.60812 18.4987 8.45185 19.7926C8.44534 20.7449 8.68897 22.0923 10.0254 22.991C10.1813 23.0898 10.3343 23.1775 10.4845 23.2541C10.7179 23.5576 11.0021 23.8221 11.3255 24.0368C12.631 24.8632 13.7249 24.9209 15.1238 24.3842C16.0565 24.0254 16.7586 23.2167 17.0842 22.3206C17.2888 21.7611 17.2861 21.1978 17.2861 20.6154V4.04639H20.5417C20.6763 4.81139 21.0485 5.90039 22.0328 6.97898C22.4276 7.38624 22.8724 7.7463 23.3573 8.05134C23.5006 8.19955 24.2331 8.93231 25.1734 9.38216C25.6596 9.61469 26.1722 9.79285 26.7009 9.91314Z" fill="#000000"/>-->
<!--                                <path d="M4.48926 22.7568V22.7594L4.57004 22.9784C4.56076 22.9529 4.53074 22.8754 4.48926 22.7568Z" fill="#69C9D0"/>-->
<!--                                <path d="M10.5128 13.7916C9.67919 14.1002 8.90498 14.5396 8.22192 15.0918C7.44763 15.7332 6.79548 16.4987 6.29458 17.354C6.10521 17.6661 5.38897 18.9168 5.30161 20.9528C5.25223 22.1068 5.61361 23.2983 5.78561 23.7944C5.78543 23.7956 5.78543 23.7968 5.78561 23.798C5.89413 24.081 6.31791 25.0815 7.01191 25.9303C7.2135 26.1763 7.42963 26.4111 7.65924 26.6334C6.92357 26.1457 6.26746 25.5562 5.71236 24.8839C5.02433 24.0451 4.60001 23.0549 4.48932 22.7626C4.48919 22.7605 4.48919 22.7584 4.48932 22.7564V22.7527C4.31677 22.2571 3.95431 21.0651 4.00477 19.9096C4.09213 17.8736 4.80838 16.6239 4.99775 16.3108C5.4985 15.4553 6.15067 14.6898 6.92509 14.0486C7.608 13.4961 8.38225 13.0567 9.21598 12.7484C9.73602 12.5416 10.2778 12.3891 10.8319 12.2934C11.6669 12.1537 12.5198 12.1415 13.3588 12.2575V13.2196C12.3808 13.2349 11.4148 13.4291 10.5128 13.7916Z" fill="#69C9D0"/>-->
<!--                                <path d="M20.5438 4.04635H17.2881V20.6159C17.2881 21.1983 17.2881 21.76 17.0863 22.3211C16.7575 23.2167 16.058 24.0253 15.1258 24.3842C13.7265 24.923 12.6326 24.8632 11.3276 24.0368C11.0036 23.823 10.7187 23.5594 10.4844 23.2567C11.5962 23.8251 12.5913 23.8152 13.8241 23.341C14.7558 22.9821 15.4563 22.1734 15.784 21.2774C15.9891 20.7178 15.9864 20.1546 15.9864 19.5726V3H20.4819C20.4819 3 20.4315 3.41188 20.5438 4.04635ZM26.7002 8.99104V9.9131C26.1725 9.79263 25.6609 9.61447 25.1755 9.38213C24.2352 8.93228 23.5026 8.19952 23.3594 8.0513C23.5256 8.1559 23.6981 8.25106 23.8759 8.33629C25.0192 8.88339 26.1451 9.04669 26.7002 8.99104Z" fill="#69C9D0"/>-->
<!--                            </svg>-->
<!--                        </Link>-->
                        <a href="https://www.instagram.com/parfumer.ro/" class="text-gray-400 hover:text-amber-400 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 48 48">
                                <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1" cx="19.38" cy="42.035" r="44.899" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fd5"></stop><stop offset=".328" stop-color="#ff543f"></stop><stop offset=".348" stop-color="#fc5245"></stop><stop offset=".504" stop-color="#e64771"></stop><stop offset=".643" stop-color="#d53e91"></stop><stop offset=".761" stop-color="#cc39a4"></stop><stop offset=".841" stop-color="#c837ab"></stop></radialGradient><path fill="url(#yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"></path><radialGradient id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2" cx="11.786" cy="5.54" r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#4168c9"></stop><stop offset=".999" stop-color="#4168c9" stop-opacity="0"></stop></radialGradient><path fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"></path><path fill="#fff" d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z"></path><circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle><path fill="#fff" d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z"></path>
                            </svg>
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

                <div>
                    <h3 class="text-sm font-semibold tracking-wider text-gray-300 uppercase">Informații</h3>
                    <ul class="mt-6 space-y-3">
                        <li><Link :href="route('pdc')" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Politica de Confidențialitate</Link></li>
                        <li><Link :href="route('tos')" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Termeni și Condiții</Link></li>
                    </ul>
                </div>

                <!-- Coloană Suport Clienți -->
                <div>
                    <h3 class="text-sm font-semibold tracking-wider text-gray-300 uppercase">TOP BRANDURI</h3>
                    <ul class="mt-6 space-y-3">
                        <li><a href="/perfumes?brand=Lattafa" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Lattafa</a></li>
                        <li><a href="/perfumes?brand=Armaf" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Armaf</a></li>
                        <li><a href="/perfumes?brand=Afnan" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Afnan</a></li>
                        <li><a href="/perfumes?brand=French Avenue" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">French Avenue</a></li>
                        <li><a href="/perfumes?brand=Maison Alhambra" class="text-gray-400 hover:text-amber-400 text-sm font-light transition duration-300">Maison Alhambra</a></li>
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
                        <li>
                            <strong class="text-white">CUI:</strong><br>
                            <a href="tel:+0751345435" class="hover:text-amber-400 transition duration-300">49031026</a>
                        </li>
                        <li>
                            <strong class="text-white">Nr. Registrul Comertului:</strong><br>
                            <a href="tel:+0751345435" class="hover:text-amber-400 transition duration-300">J33/1859/2023</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer de Jos -->
<!--            <div class="border-t border-gray-800 pt-6 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">-->
<!--                <p>&copy; 2025 PARFUMER. Toate drepturile rezervate.</p>-->
<!--                <div class="flex space-x-4 mt-4 sm:mt-0">-->
<!--                    <Link :href="route('pdc')" class="hover:text-amber-400 transition duration-300">Politica de Confidențialitate</Link>-->
<!--                    <Link :href="route('tos')" class="hover:text-amber-400 transition duration-300">Termeni și Condiții</Link>-->
<!--                </div>-->
<!--            </div>-->

            <div class="pt-6 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
                <div class="flex space-x-4 mt-4 sm:mt-0">
                    <a href="https://anpc.ro/ce-este-sal/" class="hover:text-amber-400 transition duration-300">
                        <img src="https://simpixel.ro/wp-content/uploads/2022/09/SAL.svg" width="150">
                    </a>
                    <a href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home2.show&lng=EN" class="hover:text-amber-400 transition duration-300">
                        <img src="https://simpixel.ro/wp-content/uploads/2022/09/SOL.svg" width="150">
                    </a>
                </div>
            </div>

            <!-- Added "Creeat de catre TwoDevs" text here -->
            <div class="pt-6 text-center text-sm text-gray-500 flex justify-center items-center">
                <p>Website realizat de</p><a href="https://twodevs.ro/" class="ml-1 text-yellow-500 font-bold">TwoDevs</a>
            </div>
        </div>
    </footer>
</template>
<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
