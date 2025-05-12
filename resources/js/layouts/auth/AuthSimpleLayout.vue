<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
<!--    <div class="absolute inset-0 z-0">-->
<!--        <video-->
<!--            autoplay-->
<!--            muted-->
<!--            loop-->
<!--            class="w-full h-full object-cover opacity-10"-->
<!--            src="https://videos.pexels.com/video-files/4154241/4154241-uhd_2732_1440_25fps.mp4"-->
<!--        ></video>-->
<!--    </div>-->

    <div class="flex min-h-svh flex-col items-center justify-center gap-6 bg-gray-950 p-6 md:p-10">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-4">
                    <Link :href="route('home')" class="flex items-center group">
                        <div class="relative" data-aos="fade-in" data-aos-delay="100">
                            <span class="font-cinzel text-5xl text-yellow-500 tracking-wider">PARFUMER</span>
                            <div
                                class="absolute -bottom-2 inset-x-0 h-px bg-gradient-to-r from-transparent via-gold-500 to-transparent opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    </Link>
                    <div class="space-y-2 text-center">
                        <h1 class="text-xl font-medium font-cinzel" data-aos="fade-in" data-aos-delay="200">{{ title }}</h1>
<!--                        <p class="text-center text-sm text-muted-foreground font-cinzel text-yellow-500" data-aos="fade-in" data-aos-delay="300">{{ description }}</p>-->
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
