<template>
    <AppLayout>
        <Head title="Comanda finalizata" />

        <!-- Hero Section for Success Page -->
        <div class="relative flex items-center justify-center overflow-hidden bg-black">
            <!-- Background Video (same as homepage) -->
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    class="h-full w-full object-cover opacity-40"
                    src="https://videos.pexels.com/video-files/4659830/4659830-uhd_2732_1440_25fps.mp4"
                ></video>
                <div class="absolute inset-0 bg-black/60"></div>
            </div>

            <!-- Success Content -->
            <div class="relative z-10 mx-auto max-w-4xl px-4 text-center" data-aos="fade-in">
                <!-- Heading -->
                <h1 class="font-cinzel mb-6 text-3xl text-amber-200 md:text-4xl mt-14">FINALIZEAZĂ COMANDA</h1>

                <div class="mx-auto my-8 w-24 border-t border-amber-500/30"></div>

                <div class="mx-auto mt-14 mb-12 max-w-5xl rounded-xl border border-amber-900/20 p-8 backdrop-blur-sm md:p-10" data-aos="fade-down">
                    <div class="mb-10 text-center">
                        <div class="mb-6 flex items-center justify-center">
                            <div class="h-px flex-grow bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                            <span class="font-cinzel mx-6 px-4 text-xl tracking-widest text-amber-400">
                                Completează adresa de livrare pentru a primi parfumul tău
                            </span>
                            <div class="h-px flex-grow bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                        </div>
                    </div>

                    <form @submit.prevent="submitPersonal" class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <Label class="font-cinzel mb-2 block tracking-wider text-amber-300/80">Stradă</Label>
                                <input
                                    class="font-cinzel w-full border border-yellow-500 px-4 py-4 outline-0 focus:border-yellow-700"
                                    v-model="personalForm.street"
                                    placeholder="Introdu adresa ta"
                                />
                            </div>

                            <div>
                                <Label class="font-cinzel mb-2 block tracking-wider text-amber-300/80">Oraș</Label>
                                <input
                                    class="font-cinzel w-full border border-yellow-500 px-4 py-4 outline-0 focus:border-yellow-700"
                                    v-model="personalForm.city"
                                    placeholder="Orașul tău"
                                />
                            </div>

                            <div>
                                <Label class="font-cinzel mb-2 block tracking-wider text-amber-300/80">Județ</Label>
                                <input
                                    class="font-cinzel w-full border border-yellow-500 px-4 py-4 outline-0 focus:border-yellow-700"
                                    v-model="personalForm.state"
                                    placeholder="Județul tău"
                                />
                            </div>

                            <div>
                                <Label class="font-cinzel mb-2 block tracking-wider text-amber-300/80">Cod Poștal</Label>
                                <input
                                    class="font-cinzel w-full border border-yellow-500 px-4 py-4 outline-0 focus:border-yellow-700"
                                    v-model="personalForm.postal_code"
                                    placeholder="Cod poștal"
                                />
                            </div>

                            <div>
                                <Label class="font-cinzel mb-2 block tracking-wider text-amber-300/80">Țară</Label>
                                <input
                                    class="font-cinzel w-full border border-yellow-500 px-4 py-4 outline-0 focus:border-yellow-700"
                                    v-model="personalForm.country"
                                    placeholder="Țara ta"
                                />
                            </div>

                            <div class="md:col-span-2">
                                <Label class="font-cinzel mb-2 block tracking-wider text-amber-300/80">Telefon</Label>
                                <input
                                    class="font-cinzel w-full border border-yellow-500 px-4 py-4 outline-0 focus:border-yellow-700"
                                    v-model="personalForm.phone"
                                    placeholder="Număr de telefon"
                                />
                            </div>

                            <div>
                                <Label class="font-cinzel mb-2 block tracking-wider text-amber-300/80">Denumire Companie (OPTIONAL)</Label>
                                <input
                                    class="font-cinzel w-full border border-yellow-500 px-4 py-4 outline-0 focus:border-yellow-700"
                                    v-model="personalForm.company_name"
                                    placeholder="Numele companiei"
                                />
                            </div>
                            <div>
                                <Label class="font-cinzel mb-2 block tracking-wider text-amber-300/80">CUI/CIF (OPTIONAL)</Label>
                                <input
                                    class="font-cinzel w-full border border-yellow-500 px-4 py-4 outline-0 focus:border-yellow-700"
                                    v-model="personalForm.tax_id"
                                    placeholder="Cod de identificare"
                                />
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6">
                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-show="personalForm.recentlySuccessful" class="font-cinzel flex items-center text-sm text-amber-400/80">
                                    <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Modificările au fost salvate
                                </p>
                            </Transition>

                            <Button
                                class="font-cinzel group relative overflow-hidden rounded-full border border-amber-500/50 bg-transparent px-8 py-3 tracking-wider text-amber-200 transition-all hover:bg-amber-500/10 hover:text-amber-100"
                            >
                                <span class="relative z-10">SALVEAZĂ ADRESA</span>
                                <span
                                    class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                                ></span>
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const routeParams = route().params;

const personalForm = useForm({
    company_name: '',
    tax_id: '',
    street: '',
    city: '',
    state: '',
    postal_code: '',
    country: '',
    phone: '',
    session_id: routeParams.session_id, // Set from props
});

const submitPersonal = () => {
    personalForm.get(route('addresses.order.update'), {
        preserveScroll: true,
    });
};

defineProps({
    customerName: {
        type: String,
        default: 'Client',
    },
    amount: {
        type: String,
        required: true,
    },
    currency: {
        type: String,
        required: true,
    },
});
</script>
