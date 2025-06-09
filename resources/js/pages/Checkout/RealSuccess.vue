<template>
    <AppLayout>
        <Head title="Comanda finalizata" />
        
        <!-- Hero Section for Success Page -->
        <div class="relative h-screen-90 flex items-center justify-center overflow-hidden bg-black">
            <!-- Background Video (same as homepage) -->
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

            <!-- Success Content -->
            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto" data-aos="fade-in">
                <!-- Success Icon -->
                <div class="w-24 h-24 bg-amber-900/20 rounded-full flex items-center justify-center mx-auto mb-8 border border-amber-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <!-- Heading -->
                <h1 class="font-cinzel text-4xl md:text-6xl text-amber-200 mb-6">
                    <span class="block text-lg text-amber-500/80 mb-4">COMANDA #{{ orderNumber }}</span>
                    Mulțumim, {{ customerName }}!
                </h1>

                <div class="border-t border-amber-500/30 w-24 mx-auto my-8"></div>

                <!-- Order Summary -->
                <div class="bg-amber-900/10 p-8 rounded-lg border border-amber-900/20 mb-8 backdrop-blur-sm">
                    <h3 class="font-cinzel text-xl text-amber-300 mb-4">Sumar Comandă</h3>
                    <p class="text-2xl font-serif text-amber-100">
                        {{ amount }} <span class="uppercase text-lg">{{ currency }}</span>
                    </p>
                    <p class="text-amber-500/80 mt-4">Un email cu comanda a fost trimis</p>
                </div>

                <!-- Additional Info -->
                <p class="text-amber-200/80 max-w-xl mx-auto mb-8">
                    Parfumul dumneavoastră va fi pregătit cu grijă de maeștrii noștri parfumieri și expediat în cel mai scurt timp.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-4 mt-12">
                    <Link
                        href="/perfumes"
                        class="px-8 py-3 border border-amber-500/50 text-amber-200 hover:bg-amber-500/10 transition-all font-cinzel tracking-widest text-sm text-center"
                    >
                        EXPLOREAZĂ COLECȚIILE
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';

const personalForm = useForm({
    street: '',
    city: '',
    state: '',
    postal_code: '',
    country: '',
    phone: ''
});

const companyForm = useForm({
    company_name: '',
    tax_id: '',
    street: '',
    city: '',
    state: '',
    postal_code: '',
    country: '',
    phone: ''
});

const submitPersonal = () => {
    personalForm.post(route('addresses.order.update'), {
        preserveScroll: true,
    });
};

const submitCompany = () => {
    companyForm.post(route('addresses.order.update'), {
        preserveScroll: true,
    });
};

defineProps({
    customerName: {
        type: String,
        default: 'Client'
    },
    amount: {
        type: String,
        required: true
    },
    currency: {
        type: String,
        required: true
    },
    orderNumber: {
        type: String,
        required: true
    }
});

const packagingPreviews = [
    {
        image: 'https://img.freepik.com/premium-photo/luxury-gift-box-with-golden-ribbon-black-background_911657-125.jpg?w=740',
        title: 'Cutia Noastră Signature',
        description: 'Handcrafted black box with gold embossing'
    },
    {
        image: 'https://img.freepik.com/premium-photo/luxury-perfume-bottle-with-gold-cap-black-background_911657-123.jpg?w=740',
        title: 'Flacon Personalizat',
        description: 'Each bottle hand-filled and inspected'
    },
    {
        image: 'https://img.freepik.com/premium-photo/luxury-gift-box-with-golden-ribbon-black-background_911657-126.jpg?w=740',
        title: 'Detalii de Lux',
        description: 'Includes certificate of authenticity'
    }
];

const nextSteps = [
    {
        title: 'Confirmare Email',
        description: 'Veți primi detalii despre comandă și factura în maxim 15 minute'
    },
    {
        title: 'Prelucrare',
        description: 'Parfumul dumneavoastră este pregătit manual în atelierul nostru'
    },
    {
        title: 'Expediere',
        description: 'Veți primi un email cu tracking când coletul pleacă spre dumneavoastră'
    }
];
</script>

<style>
.h-screen-90 {
    height: 93vh;
}
</style>
