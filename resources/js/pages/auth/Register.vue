<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { Checkbox } from '@/components/ui/checkbox';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    newsletter: false,
    tos: false
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    });
};
</script>

<template>
    <AuthBase title="Creează un cont" description="Introdu detaliile tale mai jos pentru a-ți crea contul">
        <Head title="Înregistrare" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2" data-aos="fade-in" data-aos-delay="300">
                    <input
                        class="bg-gray-950 py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                        id="name" type="text" required autofocus :tabindex="1" autocomplete="name" v-model="form.name"
                        placeholder="Nume complet" />
                    <InputError class="font-cinzel" :message="form.errors.name" />
                </div>

                <div class="grid gap-2" data-aos="fade-in" data-aos-delay="400">
                    <input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email"
                           class="bg-gray-950 py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                           placeholder="email@example.com" />
                    <InputError class="font-cinzel" :message="form.errors.email" />
                </div>

                <div class="grid gap-2" data-aos="fade-in" data-aos-delay="500">
                    <input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Parolă"
                        class="bg-gray-950 py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                    />
                    <InputError class="font-cinzel" :message="form.errors.password" />
                </div>

                <div class="grid gap-2" data-aos="fade-in" data-aos-delay="600">
                    <input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirmă parola"
                        class="bg-gray-950 py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                    />
                    <InputError class="font-cinzel" :message="form.errors.password_confirmation" />
                </div>

                <div class="flex flex-col gap-4 mt-4" data-aos="fade-in" data-aos-delay="650">
                    <Label for="tos" class="flex items-center space-x-3 font-cinzel">
                        <Checkbox id="tos" v-model="form.tos" :tabindex="5" required />
                        <span>
                            Sunt de acord cu
                            <TextLink href="/termeni-si-conditii" class="underline underline-offset-4">
                                termenii și condițiile
                            </TextLink>
                        </span>
                    </Label>
                    <InputError class="font-cinzel" :message="form.errors.tos" />


                    <Label for="newsletter" class="flex items-center space-x-3 font-cinzel">
                        <Checkbox id="newsletter" v-model="form.newsletter" :tabindex="6" />
                        <span>Doresc să primesc noutăți și oferte pe email</span>
                    </Label>
                </div>


                <button
                    type="submit"
                    data-aos="fade-in"
                    data-aos-delay="700"
                    class="mt-8 w-full font-cinzel hover:cursor-pointer bg-amber-500 hover:bg-amber-600 text-black font-bold py-3 px-6 uppercase tracking-wider transition-colors duration-300 flex items-center justify-center gap-2"
                    tabindex="5"
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    <span v-if="!form.processing">Creează cont</span>
                    <span v-else class="opacity-70">Se încarcă...</span>
                </button>

            </div>


            <div class="text-center text-sm text-muted-foreground font-cinzel">
                Ai deja un cont?
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">Autentifică-te
                </TextLink>
            </div>
        </form>
    </AuthBase>
</template>
