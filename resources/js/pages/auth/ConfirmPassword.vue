<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <AuthLayout title="Confirm your password" description="This is a secure area of the application. Please confirm your password before continuing.">
        <Head title="Confirm password" />

        <form @submit.prevent="submit" data-aos="fade-in" data-aos-delay="300">
            <div class="space-y-6">
                <div class="grid gap-2">
                    <input
                        id="password"
                        type="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        v-model="form.password"
                        placeholder="Parolă"
                        class="bg-gray-950 py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                    />

                    <InputError class="font-cinzel" :message="form.errors.password" />
                </div>

                <button
                    type="submit"
                    data-aos="fade-in"
                    data-aos-delay="500"
                    class="mt-8 w-full font-cinzel hover:cursor-pointer bg-amber-500 hover:bg-amber-600 text-black font-bold py-3 px-6 uppercase tracking-wider transition-colors duration-300 flex items-center justify-center gap-2"
                    tabindex="5"
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    <span v-if="!form.processing">Confirmă parola</span>
                    <span v-else class="opacity-70">Se încarcă...</span>
                </button>

            </div>
        </form>
    </AuthLayout>
</template>
