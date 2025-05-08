<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};
</script>

<template>
    <AuthLayout title="Verificare email" description="Te rugăm să îți verifici adresa de email făcând clic pe linkul pe care ți l-am trimis prin email.">
        <Head title="Verificare email" />

        <div v-if="status === 'verification-link-sent'" class="mb-4 text-center text-sm font-medium text-green-600">
            Un nou link de verificare a fost trimis la adresa de email pe care ai furnizat-o la înregistrare.
        </div>

        <form @submit.prevent="submit" class="space-y-6 text-center">
            <button
                type="submit"
                data-aos="fade-in"
                data-aos-delay="800"
                class="mt-8 w-full hover:cursor-pointer bg-amber-500 hover:bg-amber-600 text-black font-bold font-cinzel py-3 px-6 uppercase tracking-wider transition-colors duration-300 flex items-center justify-center gap-2"
                :tabindex="4"
                :disabled="form.processing"
            >
                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                <span v-if="!form.processing">Verifiă email</span>
                <span v-else class="opacity-70">Se încarcă...</span>
            </button>

            <TextLink :href="route('logout')" method="post" as="button" class="mx-auto block text-sm font-cinzel"> Deconectare </TextLink>
        </form>
    </AuthLayout>
</template>
