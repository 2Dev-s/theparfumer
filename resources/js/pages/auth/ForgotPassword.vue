<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <AuthLayout title="Ai uitat parola" description="Introdu adresa ta de email pentru a primi un link de resetare a parolei">
        <Head title="Ai uitat parola" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600 font-cinzel">
            {{ status }}
        </div>

        <div class="space-y-6">
            <form @submit.prevent="submit" data-aos="fade-in" data-aos-delay="200">
                <div class="grid gap-2">
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
                <button
                    type="submit"
                    data-aos="fade-in"
                    data-aos-delay="400"
                    class="mt-8 w-full hover:cursor-pointer bg-amber-500 hover:bg-amber-600 text-black font-bold font-cinzel py-3 px-6 uppercase tracking-wider transition-colors duration-300 flex items-center justify-center gap-2"
                    :tabindex="4"
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    <span v-if="!form.processing">Trimite link pentru resetarea parolei</span>
                    <span v-else class="opacity-70">Se încarcă...</span>
                </button>
            </form>

            <div class="space-x-1 text-center text-sm text-muted-foreground font-cinzel" data-aos="fade-in" data-aos-delay="500">
                <span>Sau, întoarce-te la</span>
                <TextLink :href="route('login')">logare</TextLink>
            </div>

        </div>
    </AuthLayout>
</template>
