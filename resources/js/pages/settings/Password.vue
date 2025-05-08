<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { type BreadcrumbItem } from '@/types';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Setări parolă',
        href: '/settings/password',
    },
];

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: (errors: any) => {
            if (errors.password) {
                form.reset('password', 'password_confirmation');
                if (passwordInput.value instanceof HTMLInputElement) {
                    passwordInput.value.focus();
                }
            }

            if (errors.current_password) {
                form.reset('current_password');
                if (currentPasswordInput.value instanceof HTMLInputElement) {
                    currentPasswordInput.value.focus();
                }
            }
        },
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Setări parolă" />

        <SettingsLayout>
            <!-- Antet Luxos -->
            <div class="relative overflow-hidden bg-black/90 mb-12 rounded-xl" data-aos="fade-up">
                <div class="absolute inset-0 z-0 opacity-20">
                    <div class="absolute inset-0 bg-[url('https://img.freepik.com/free-vector/luxury-perfume-logo-concept_23-2148476347.jpg')] bg-cover bg-center"></div>
                </div>
                <div class="relative z-10 p-8 md:p-12">
                    <h1 class="font-cinzel text-3xl md:text-4xl text-amber-200 text-center">Setări de Securitate</h1>
                    <div class="flex items-center justify-center my-6">
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                        <span class="mx-6 font-cinzel text-amber-500/80 tracking-widest text-sm">PROTECȚIE EXCLUSIVĂ</span>
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                    </div>
                    <p class="text-amber-200/80 text-center max-w-2xl mx-auto">
                        Asigură-ți contul exclusiv cu o parolă puternică și unică
                    </p>
                </div>
            </div>

            <!-- Container Formă Luxos -->
            <div class="backdrop-blur-sm border border-amber-900/20 rounded-xl p-6 md:p-8" data-aos="fade-down">
                <form @submit.prevent="updatePassword" class="space-y-8">
                    <!-- Parola Curentă -->
                    <div class="space-y-2">
                        <Label class="font-cinzel text-amber-300/80 tracking-wider" for="current_password">
                            Parola curentă
                            <span class="text-xs text-amber-500/60 ml-2">(obligatoriu)</span>
                        </Label>
                        <input
                            id="current_password"
                            ref="currentPasswordInput"
                            v-model="form.current_password"
                            type="password"
                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                            autocomplete="current-password"
                            placeholder="Introdu parola curentă"
                        />
                        <InputError class="text-amber-500 mt-1" :message="form.errors.current_password" />
                    </div>

                    <!-- Parolă Nouă -->
                    <div class="space-y-2">
                        <Label class="font-cinzel text-amber-300/80 tracking-wider" for="password">
                            Parolă nouă
                            <span class="text-xs text-amber-500/60 ml-2">(minim 8 caractere)</span>
                        </Label>
                        <input
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                            autocomplete="new-password"
                            placeholder="Creează o parolă nouă"
                        />
                        <InputError class="text-amber-500 mt-1" :message="form.errors.password" />
                    </div>

                    <!-- Confirmă Parola -->
                    <div class="space-y-2">
                        <Label class="font-cinzel text-amber-300/80 tracking-wider" for="password_confirmation">
                            Confirmă parola
                        </Label>
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                            autocomplete="new-password"
                            placeholder="Confirmă parola nouă"
                        />
                        <InputError class="text-amber-500 mt-1" :message="form.errors.password_confirmation" />
                    </div>

                    <!-- Buton de Trimitere -->
                    <div class="flex items-center justify-between pt-6">
                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="text-sm text-amber-400/80 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Parola a fost actualizată
                            </p>
                        </Transition>

                        <Button
                            :disabled="form.processing"
                            class="relative overflow-hidden bg-transparent border border-amber-500/50 text-amber-200 hover:text-amber-100 px-8 py-3 rounded-full hover:bg-amber-500/10 transition-all font-cinzel tracking-wider group"
                        >
                            <span class="relative z-10">ACTUALIZEAZĂ SECURITATEA</span>
                            <span class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        </Button>
                    </div>
                </form>

                <!-- Sfat de Securitate -->
                <div class="mt-10 p-4 bg-amber-900/10 border border-amber-800/30 rounded-lg">
                    <div class="flex items-start">
                        <div class="bg-amber-500/10 p-2 rounded-full mt-0.5">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="font-cinzel text-amber-200 text-sm">Recomandare de Securitate</h3>
                            <p class="text-xs text-amber-500/80 mt-1">
                                Pentru securitate maximă, folosește o combinație unică de litere, cifre și caractere speciale.
                                Ia în considerare utilizarea unui manager de parole pentru a genera și stoca parole complexe.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<style scoped>
input:focus {
    outline: none;
    box-shadow: 0 1px 0 0 rgba(217, 119, 6, 0.5);
}

input {
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}
</style>
