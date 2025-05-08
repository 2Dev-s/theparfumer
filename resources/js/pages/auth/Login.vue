<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthBase title="Logare cont" description="Introdu datele de logare">
        <Head title="Logare" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
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
                        :tabindex="2"
                        autocomplete="current-password"
                        v-model="form.password"
                        placeholder="Parolă"
                        class="bg-gray-950 py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                    />
                    <InputError class="font-cinzel" :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between" data-aos="fade-in" data-aos-delay="600">
                    <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm font-cinzel" :tabindex="5">
                        Ai uitat parola?
                    </TextLink>
                </div>

                <div class="flex items-center justify-between" data-aos="fade-in" data-aos-delay="700">
                    <Label for="remember" class="flex items-center space-x-3 font-cinzel">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
                        <span>Ține-mă minte</span>
                    </Label>
                </div>

                <button
                    type="submit"
                    data-aos="fade-in"
                    data-aos-delay="800"
                    class="mt-8 w-full hover:cursor-pointer bg-amber-500 hover:bg-amber-600 text-black font-bold font-cinzel py-3 px-6 uppercase tracking-wider transition-colors duration-300 flex items-center justify-center gap-2"
                    :tabindex="4"
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    <span v-if="!form.processing">Autentificare</span>
                    <span v-else class="opacity-70">Se încarcă...</span>
                </button>
            </div>

            <div class="text-center text-sm text-muted-foreground font-cinzel">
                Nu ai un cont?
                <TextLink :href="route('register')" :tabindex="5">Înregistrează-te</TextLink>
            </div>

        </form>
    </AuthBase>
</template>
