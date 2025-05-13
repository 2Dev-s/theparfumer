<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Cont',
        href: '/settings/profile'
    },
    {
        title: 'Securitate',
        href: '/settings/password'
    },
    {
        title: 'Adrese',
        href: '/settings/addresses'
    },
    {
        title: 'Favorite',
        href: '/settings/favourite'
    },
    {
        title: 'Comenzi',
        href: '/settings/orders'
    }
];

const page = usePage();

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';
</script>

<template>
    <div class="px-4 py-6 sm:px-6 sm:py-8 md:px-8 md:py-10 lg:px-10 lg:py-12">
        <!-- Luxury Header - Responsive -->
        <div class="mb-8 sm:mb-10 md:mb-12 text-center">
            <h1 class="font-cinzel text-3xl sm:text-4xl md:text-5xl text-amber-200 mb-3 sm:mb-4">
                Setări cont
            </h1>
            <div class="flex items-center justify-center my-4 sm:my-6">
                <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                <span class="mx-4 sm:mx-6 font-cinzel text-amber-500/80 tracking-widest text-xs sm:text-sm">
                    ACCES EXCLUSIV
                </span>
                <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
            </div>
            <p class="text-amber-200/80 text-sm sm:text-base max-w-2xl mx-auto font-light">
                Gestionează-ți contul exclusiv și preferințele personale
            </p>
        </div>

        <!-- Main Content Grid - Responsive -->
        <div
            class="flex flex-col space-y-6 sm:space-y-8 lg:flex-row lg:space-y-0 lg:space-x-8 xl:space-x-12 mx-auto max-w-5xl">
            <!-- Luxury Sidebar Navigation - Responsive -->
            <aside class="w-full lg:w-56 xl:w-64">
                <nav
                    class="flex flex-row lg:flex-col space-x-2 lg:space-x-0 lg:space-y-2 p-1 bg-gradient-to-b from-amber-900/10 to-transparent rounded-lg border border-amber-900/20 overflow-x-auto lg:overflow-visible">
                    <Link
                        v-for="item in sidebarNavItems"
                        :key="item.href"
                        :href="item.href"
                        :class="[
                            'px-3 sm:px-4 py-2 sm:py-3 text-left font-cinzel tracking-wider transition-all duration-300 whitespace-nowrap',
                            'hover:bg-amber-900/20 hover:text-amber-200',
                            'focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500/50',
                            currentPath === item.href
                                ? 'text-amber-300 bg-amber-900/20 lg:border-l-4 border-amber-500'
                                : 'text-amber-200/80'
                        ]"
                    >
                        <span class="flex items-center">
                            <svg
                                class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                :class="currentPath === item.href ? 'text-amber-400' : 'text-amber-500/60'"
                            >
                                <path v-if="item.title === 'Cont'" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                <path v-if="item.title === 'Securitate'" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                <path v-if="item.title === 'Adrese'" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                <path v-if="item.title === 'Comenzi'" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M16 7V5a3 3 0 00-3-3h-2a3 3 0 00-3 3v2m0 0h14l1 12a2 2 0 01-2 2H6a2 2 0 01-2-2l1-12z" />
                                <path v-if="item.title === 'Favorite'" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            {{ item.title }}
                        </span>
                    </Link>
                </nav>

                <!-- VIP Status Badge - Responsive -->
                <div
                    class="mt-6 sm:mt-8 p-3 sm:p-4 bg-gradient-to-br from-amber-900/20 to-amber-900/10 border border-amber-800/30 rounded-lg">
                    <div class="flex items-center">
                        <div class="bg-amber-500/10 p-1.5 sm:p-2 rounded-full">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-amber-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="font-cinzel text-sm sm:text-base text-amber-200">Membru V.I.P</h3>
                            <p class="text-xs text-amber-500/80 mt-0.5 sm:mt-1">Privilegii exclusive</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area - Responsive -->
            <div class="flex-1 min-w-0">
                <section
                    class="space-y-8 sm:space-y-10 md:space-y-12 p-4 sm:p-6 md:p-8 backdrop-blur-sm rounded-xl border border-amber-900/20">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>

<style scoped>

/* Smooth transitions for interactive elements */
nav a {
    transition: all 0.3s ease;
}

/* Custom focus states */
nav a:focus-visible {
    outline: 2px solid rgba(217, 119, 6, 0.5);
    outline-offset: 2px;
}

/* Scrollbar styling for mobile navigation */
nav::-webkit-scrollbar {
    height: 4px;
}

nav::-webkit-scrollbar-track {
    background: transparent;
}

nav::-webkit-scrollbar-thumb {
    background: rgba(180, 83, 9, 0.3);
    border-radius: 2px;
}

nav::-webkit-scrollbar-thumb:hover {
    background: rgba(180, 83, 9, 0.5);
}
</style>
