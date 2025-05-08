<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

interface Props {
    token: string;
    email: string;
}

const props = defineProps<Props>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <AuthLayout title="Resetare parolă" description="Te rugăm să introduci noua ta parolă mai jos">
        <Head title="Resetare parolă" />

        <form @submit.prevent="submit">
            <div class="grid gap-6">
                <div class="grid gap-2" data-aos="fade-in" data-aos-delay="300">
                    <input
                        id="email"
                        type="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="email@exemplu.com"
                        class="bg-gray-950 py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                    />
                    <InputError class="font-cinzel" :message="form.errors.email" />
                </div>

                <div class="grid gap-2" data-aos="fade-in" data-aos-delay="400">
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

                <div class="grid gap-2" data-aos="fade-in" data-aos-delay="500">
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
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <button
                    type="submit"
                    data-aos="fade-in"
                    data-aos-delay="600"
                    class="mt-8 w-full font-cinzel hover:cursor-pointer bg-amber-500 hover:bg-amber-600 text-black font-bold py-3 px-6 uppercase tracking-wider transition-colors duration-300 flex items-center justify-center gap-2"
                    tabindex="5"
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    <span v-if="!form.processing">Resetează parola</span>
                    <span v-else class="opacity-70">Se încarcă...</span>
                </button>
            </div>
        </form>
    </AuthLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&display=swap');

.font-cinzel {
    font-family: 'Cinzel', serif;
}
</style>

