<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Adrese',
        href: '/settings/addresses',
    },
];

const props = defineProps({
    personalAddress: Object,
    companyAddress: Object
});

// Personal address form
const personalForm = useForm({
    street: props.personalAddress?.street || '',
    city: props.personalAddress?.city || '',
    state: props.personalAddress?.state || '',
    postal_code: props.personalAddress?.postal_code || '',
    country: props.personalAddress?.country || '',
    phone: props.personalAddress?.phone || ''
});

// Company address form
const companyForm = useForm({
    company_name: props.companyAddress?.company_name || '',
    tax_id: props.companyAddress?.tax_id || '',
    street: props.companyAddress?.street || '',
    city: props.companyAddress?.city || '',
    state: props.companyAddress?.state || '',
    postal_code: props.companyAddress?.postal_code || '',
    country: props.companyAddress?.country || '',
    phone: props.companyAddress?.phone || ''
});

const submitPersonal = () => {
    personalForm.post(route('addresses.personal.update'), {
        preserveScroll: true,
    });
};

const submitCompany = () => {
    companyForm.post(route('addresses.company.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Configurare Adrese" />

        <SettingsLayout>
            <!-- Luxury Header -->
            <div class="relative overflow-hidden bg-black/90 mb-12 rounded-xl" data-aos="fade-up">
                <div class="absolute inset-0 z-0 opacity-20">
                    <div class="absolute inset-0 bg-[url('https://img.freepik.com/free-vector/luxury-perfume-logo-concept_23-2148476347.jpg')] bg-cover bg-center"></div>
                </div>
                <div class="relative z-10 p-8 md:p-12">
                    <h1 class="font-cinzel text-3xl md:text-4xl text-amber-200 text-center">Gestionare Adrese</h1>
                    <div class="flex items-center justify-center my-6">
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                        <span class="mx-6 font-cinzel text-amber-500/80 tracking-widest text-sm">EXCLUSIVE SERVICE</span>
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                    </div>
                    <p class="text-amber-200/80 text-center max-w-2xl mx-auto">
                        Gestionează-ți adresele personale și de companie pentru o experiență de livrare perfectă
                    </p>
                </div>
            </div>

            <!-- Personal Address Form -->
            <div class="backdrop-blur-sm border border-amber-900/20 rounded-xl p-8 md:p-10 mb-12" data-aos="fade-down">
                <div class="mb-10 text-center">
                    <div class="flex items-center justify-center mb-6">
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                        <span class="mx-6 font-cinzel text-amber-400 text-xl tracking-widest px-4">
                            ADRESĂ PERSONALĂ
                        </span>
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                    </div>
                </div>

                <form @submit.prevent="submitPersonal" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Stradă</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="personalForm.street"
                                placeholder="Introdu adresa ta"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Oraș</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="personalForm.city"
                                placeholder="Orașul tău"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Județ</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="personalForm.state"
                                placeholder="Județul tău"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Cod Poștal</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="personalForm.postal_code"
                                placeholder="Cod poștal"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Țară</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="personalForm.country"
                                placeholder="Țara ta"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Telefon</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="personalForm.phone"
                                placeholder="Număr de telefon"
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
                            <p v-show="personalForm.recentlySuccessful" class="text-sm text-amber-400/80 flex items-center font-cinzel">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Modificările au fost salvate
                            </p>
                        </Transition>

                        <Button
                            class="relative overflow-hidden bg-transparent border border-amber-500/50 text-amber-200 hover:text-amber-100 px-8 py-3 rounded-full hover:bg-amber-500/10 transition-all font-cinzel tracking-wider group"
                        >
                            <span class="relative z-10">SALVEAZĂ ADRESA</span>
                            <span class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        </Button>
                    </div>
                </form>
            </div>

            <!-- Company Address Form -->
            <div class="backdrop-blur-sm border border-amber-900/20 rounded-xl p-8 md:p-10">
                <div class="mb-10 text-center">
                    <div class="flex items-center justify-center mb-6">
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                        <span class="mx-6 font-cinzel text-amber-400 text-xl tracking-widest px-4">
                            ADRESĂ DE COMPANIE
                        </span>
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                    </div>
                    <p class="text-amber-300/60 text-sm">Completează doar dacă dorești facturare pe companie</p>
                </div>

                <form @submit.prevent="submitCompany" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Denumire Companie</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="companyForm.company_name"
                                placeholder="Numele companiei"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">CUI/CIF</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="companyForm.tax_id"
                                placeholder="Cod de identificare"
                            />
                        </div>

                        <div class="md:col-span-2">
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Stradă</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="companyForm.street"
                                placeholder="Introdu adresa companiei"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Oraș</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="companyForm.city"
                                placeholder="Orașul companiei"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Județ</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="companyForm.state"
                                placeholder="Județul companiei"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Cod Poștal</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="companyForm.postal_code"
                                placeholder="Cod poștal"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Țară</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="companyForm.country"
                                placeholder="Țara companiei"
                            />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Telefon</Label>
                            <input
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="companyForm.phone"
                                placeholder="Număr de telefon"
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
                            <p v-show="companyForm.recentlySuccessful" class="text-sm text-amber-400/80 flex items-center font-cinzel">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Modificările au fost salvate
                            </p>
                        </Transition>

                        <Button
                            class="relative overflow-hidden bg-transparent border border-amber-500/50 text-amber-200 hover:text-amber-100 px-8 py-3 rounded-full hover:bg-amber-500/10 transition-all font-cinzel tracking-wider group"
                        >
                            <span class="relative z-10">SALVEAZĂ ADRESA</span>
                            <span class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        </Button>
                    </div>
                </form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<style scoped>
/* Custom input focus effect */
input:focus {
    outline: none;
    box-shadow: 0 1px 0 0 rgba(217, 119, 6, 0.5);
}

/* Smooth transitions for form elements */
input {
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}
</style>
